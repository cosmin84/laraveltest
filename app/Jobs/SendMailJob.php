<?php

namespace App\Jobs;

use App\Mail\DefaultMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The array with the available messages to be sent.
     *
     * @var
     */
    private $messages;

    /**
     * Create a new job instance.
     *
     * @param $messages
     */
    public function __construct($messages)
    {
        $this->messages = $messages;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->messages['messages'] as $message) {
            Mail::to($message['recipient'])->send(new DefaultMail($message));
        }
    }
}
