<?php

namespace Modules\Newsletter\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Newsletter extends Mailable
{
    use Queueable, SerializesModels;


    private $posts;
    private $customMessage;
    private $contentType;
    private $bulk_email_type;
    private $base_url;
    private $user_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($posts, $customMessage, $contentType, $bulk_email_type, $base_url, $user_id)
    {
        $this->posts            = $posts;
        $this->customMessage    = $customMessage;
        $this->contentType      = $contentType;
        $this->bulk_email_type  = $bulk_email_type;
        $this->base_url         = $base_url;
        $this->user_id         = $user_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.newsletter', [
            'posts'           => $this->posts,
            'customMessage'   => $this->customMessage,
            'contentType'     => $this->contentType,
            'bulk_email_type' => $this->bulk_email_type,
            'base_url'        => $this->base_url,
            'user_id'        => $this->user_id,
        ]);
    }
}
