<?php

namespace App\Listeners;

use App\Models\Message;

class SaveSentMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $subject = $event->message->getSubject();
        $body = $event->message->getBody();
        $recipient = array_keys($event->message->getTo())[0];

        $message = Message::create([
            'subject' => $subject,
            'body' => $body,
            'recipient' => $recipient
        ]);

        if ($message) {
            foreach ($event->message->getChildren() as $child) {
                $attachment = str_replace(
                    'attachment; filename=',
                    null,
                    $child->getHeaders()->get('content-disposition')->getFieldBody()
                );

                $message->attachments()->create([
                    'filepath' => $attachment
                ]);
            }
        }
    }
}
