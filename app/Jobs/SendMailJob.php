<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
     * The instance of the mail sending service.
     *
     * @var
     */
    private $service;

    /**
     * Create a new job instance.
     *
     * @param $messages
     * @param $service
     */
    public function __construct($messages, $service)
    {
        $this->messages = $messages;
        $this->service = $service;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->service->send($this->messages);
    }
}
