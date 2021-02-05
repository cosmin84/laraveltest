<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DefaultMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The contents of the e-mail message.
     *
     * @var
     */
    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->subject($this->message['subject'])
            ->view('emails.default')
            ->with([
                'body' => $this->message['body']
            ]);

        if (array_key_exists('attachments', $this->message)) {
            foreach ($this->message['attachments'] as $attachment) {
                $mail->attachData(
                    base64_decode($attachment['encoded_content']),
                    $attachment['filename']
                );
            }
        }

        return $mail;
    }
}
