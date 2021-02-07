<?php

namespace App\Services;

use App\Http\Resources\MessageResource;
use App\Jobs\SendMailJob;
use App\Models\Message;

class MailService
{
    /**
     * Dispatch a new job for sending e-mails.
     *
     * @param $messages
     */
    public function send($messages)
    {
        dispatch(new SendMailJob($messages));
    }

    /**
     * Fetch all sent e-mails.
     */
    public function list()
    {
        return MessageResource::collection(Message::all());
    }
}
