<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShoppingsStatus extends Notification
{
    use Queueable;

    public $receptor;
    public $status;
    public $nameProduct;

    public function __construct($receptor, $status, $nameProduct)
    {
        $this->receptor = $receptor;
        $this->status = $status;
        $this->nameProduct = $nameProduct;
    }

   
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->markdown('mail.shoppingstatus.ShoppingsStatus',[
                        'receptor'=>$this->receptor,
                        'status'=>$this->status,
                        'nameProduct'=>$this->nameProduct,
                    ])
                    ->subject('Status de la orden')
                    ->from('admin.cotizador@trademarket.com.mx', 'HHGLOBAL');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
