<?php

namespace App\Services;

use App\Mail\DefaultMail;
use Illuminate\Support\Facades\Mail;

class SendMailService
{
    /**
     * Iterate over the array of messages and send e-mail.
     *
     * @param $data
     */
    public function send($data)
    {
        foreach($data['messages'] as $message) {
            Mail::to($message['recipient'])->send(new DefaultMail($message));
        }
    }
}
