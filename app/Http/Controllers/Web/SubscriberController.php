<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSubscriberRequest;
use App\src\Repositories\SubscriberRepository;
use Exception;
use Log;

class SubscriberController extends Controller
{
    private $subscriberRepository;

    public function __construct(SubscriberRepository $subscriberRepository)
    {
        $this->subscriberRepository = $subscriberRepository;
    }

    public function store(CreateSubscriberRequest $request)
    {
        try {
            $this->subscriberRepository->create($request->only('email'));
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return redirect() - back()->withInput();
        }

        return redirect()->back()->with(['messageSubscriber' => 'Suscripción realizada']);
    }
}
