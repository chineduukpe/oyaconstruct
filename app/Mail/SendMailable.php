<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $senderName,$msg,$sender,$receiver,$receiverName,$subject,$view;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($senderName,$sender,$receiverName,$receiver,$msg,$subject,$view)
    {
        //
        $this->senderName=$senderName;
        $this->msg=$msg;
        $this->sender=$sender;
        $this->receiver=$receiver;
        $this->receiverName=$receiverName;
        $this->subject=$subject;
        $this->view=$view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->sender,$this->senderName)
                    ->view($this->view);
    }
}
