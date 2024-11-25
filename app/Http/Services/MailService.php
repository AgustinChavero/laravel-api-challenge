<?php

namespace App\Http\Services;

use App\Mail\Email;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function successMail($to, $name)
    {
        $data = [
            'title' => 'Bienvenido a nuestra plataforma',
            'name' => $name,
            'message' => 'Gracias por registrarte. Por favor, verifica tu correo electrónico para activar tu cuenta.',
            'verification_link' => 'http://example.com/verify?token=your-verification-token'
        ];

        $mail = new Email($data, 'mails.welcome');
        Mail::to($to)->send($mail);
    }
}
