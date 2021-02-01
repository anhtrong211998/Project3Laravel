<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $datas;

    public function __construct($datas)
    {
        //
        $this->datas = $datas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->datas['contact_email'],$this->datas['contact_name'])
                    ->replyTo($this->datas['contact_email'], $this->datas['contact_name'])
                    ->subject($this->datas['contact_title'])
                    ->view('userpages.mail.mail_contact');
    }
}
