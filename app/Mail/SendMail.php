<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $products;
    protected $cost;
    protected $order_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($products, $cost, $order_id)
    {
        $this->products = $products;
        $this->cost = $cost;
        $this->order_id = $order_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail')->with([
            'cost' => $this->cost,
            'products' => $this->products,
            'order_id' => $this->order_id
        ])->subject('Изменился статус заказа');
    }
}
