<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Order;
class ShoppingMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $orders;
    public $orderdetails = [];
    public function __construct(Order $order, $orderdetail)
    {
        //
        $this->orders = $order;
        $this->orderdetails = $orderdetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('nhokanhnho211998@gmail.com','Inspire')
                    ->view('userpages.mail.mail_shopping');
    }
}
