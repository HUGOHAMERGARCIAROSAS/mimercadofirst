<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\src\Util\Constants;
use GuzzleHttp\Exception\ClientException;
use Laravel\Socialite\Two\InvalidStateException;
use League\OAuth1\Client\Credentials\CredentialsException;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Log;

class SocialAuthController extends Controller
{
    protected $providers = [
        Constants::PROVIDER_FACEBOOK,
        Constants::PROVIDER_GOOGLE_PLUS,
    ];

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider = null)
    {
        if (!$this->isProviderAllowed($provider)) {
            return $this->sendFailedResponse("{$provider} no es compatible actualmente.");
        }

        try {

            if ($provider == Constants::PROVIDER_GOOGLE_PLUS) {
                return Socialite::with($provider)->setScopes(['openid', 'email',])->redirect();
            }

            return Socialite::with($provider)->redirect();

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->sendFailedResponse();
        }
    }

    public function handleProviderCallback($provider = null)
    {
        try {
            $user = Socialite::with($provider)->stateless()->user();
        } catch (GuzzleHttp\Exception\ClientException $e) {
            Log::error($e->getMessage());
            return $this->sendFailedResponse();
        } catch (InvalidStateException $e) {
            Log::error($e->getMessage());
            return $this->sendFailedResponse();
        } catch (ClientException $e) {
            Log::error($e->getMessage());
            return $this->sendFailedResponse();
        } catch (CredentialsException $e) {
            Log::error($e->getMessage());
            return $this->sendFailedResponse();
        }

        return empty($user->email)
            ? $this->sendFailedResponse('No se puede iniciar sesión, habilité la dirección de correo electrónico o intente con otro proveedor para iniciar sesión.')
            : $this->loginOrCreateAccount($user, $provider);
    }

    public function completeProfile()
    {
        $user = User::find(auth()->user()->id);

        if ($user->hasCompleteProfile()) {
            return redirect()->route('web.checkout.index');
        }

        return view("web.pages.auth.complete_profile");
    }

    public function updateProfile(Request $request)
    {
        $userId = auth()->id();

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'acepto' => 'required',
        ], [
            'document.unique' => 'El campo DNI ya ha sido tomado.',
            'acepto.required' => 'No ha aceptado los terminos y condiciones.',
        ], [
            'phone' => 'teléfono',
        ]);

        try {
            $user = User::find($userId);
            $user->update([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return redirect()->route('web.checkout.index');
    }

    private function loginOrCreateAccount($providerUser, $provider)
    {
        $email = $providerUser->getEmail();
        $providerId = $providerUser->getId();

        $user = User::where('provider_id', $providerId)
            ->where('email', $email)
            ->first();

        if ($user) {
            auth()->login($user, true);
            return redirect()->route('web.checkout.index');
        }

        $user = User::where('email', $email)
            ->first();

        if ($user) {
            $user->update([
                'provider' => $provider,
                'provider_id' => $providerUser->getId(),
            ]);
            auth()->login($user, true);
            return redirect()->route('web.checkout.index');
        }

        $user = User::create([
            'name' => $providerUser->getName() ?: 'Usuario MiMercado',
            'phone' => '',
            'email' => $providerUser->getEmail(),
            'password' => '',
            'provider' => $provider,
            'provider_id' => $providerUser->getId(),
        ]);

        auth()->login($user, true);
        return redirect()->intended(route('client.complete-profile'));
    }

    private function sendFailedResponse($message = null)
    {
        return redirect()->route('login')
            ->withErrors($message ?: 'La operación no se pudo completar.');
    }

    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }

}
