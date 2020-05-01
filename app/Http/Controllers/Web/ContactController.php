<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\MessageContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('web.pages.contact.index');

    }

    public function sendMail(Request $request)
    {
        
        
        $request->validate([
            'g-recaptcha-response' => 'required'
        ]);
        
        if($request->validate=true){
            Mail::to("ventas@mimercado.delivery")->send(new MessageContact($request));
            return redirect()->back()->with('message', "Su mensaje se ha enviado con exito.");
        }
    }
}
