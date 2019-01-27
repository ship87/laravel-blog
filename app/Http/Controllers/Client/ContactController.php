<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Contracts\Mail\Mailer;

use App\Http\Controllers\Controller;
use App\Mail\ContactEmail;
use App\Http\Requests\ContactFormRequest;

use App\Models\Metatag;

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

        $mail->to(config('mail.noreply_address'))->send(new ContactEmail($contact));

        $sendMessage = 'Thank you for your email';

        return redirect()->route('contact.create')->with(['sendMessage' => $sendMessage]);
    }
}
