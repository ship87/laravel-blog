<?php

namespace App\Http\Controllers\Client;

use Illuminate\Contracts\Mail\Mailer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Jobs\SendContactEmail;

class ContactController extends Controller
{
    public function create()
    {
        return view(config('app.theme').'client.contact.create');
    }

    public function store(ContactFormRequest $request, Mailer $mail)
    {
        $contact['name'] = $request->get('name');
        $contact['email'] = $request->get('email');
        $contact['msg'] = $request->get('msg');

        SendContactEmail::dispatch($contact)->onQueue('emails')->delay(now()->addMinutes(2));

        $sendMessage = u__('client.thank you for your email');

        return redirect()->route('contact.create')->with(['sendMessage' => $sendMessage]);
    }
}
