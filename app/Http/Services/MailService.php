<?php

namespace App\Http\Services;

use App\Mail\Email;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendWelcomeMail($to, $name)
    {
        $data = [
            'title' => 'Welcome to Our Platform',
            'name' => $name,
            'message' => 'Thank you for registering. Please verify your email to activate your account.',
            'verification_link' => 'http://example.com/verify?token=your-verification-token',
        ];

        $mail = new Email($data, 'mails.welcome');
        Mail::to($to)->send($mail);
    }

    public function sendResetPasswordMail($to, $name, $token)
    {
        $data = [
            'title' => 'Reset Your Password',
            'name' => $name,
            'message' => 'Click the link below to reset your password:',
            'reset_link' => url('/reset-password?token=' . $token),
        ];

        $mail = new Email($data, 'mails.reset-password');
        Mail::to($to)->send($mail);
    }
}
