<?php

namespace App\Services;

use App\Jobs\SendMailJob;

class SendMailService
{
    /**
     * Iterate over the array of messages and send e-mail.
     *
     * @param $messages
     */
    public function send($messages)
    {
        dispatch(new SendMailJob($messages));
    }
}
