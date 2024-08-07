<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PedidosStatus extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $receptor;
    public $status;
    public $nameProduct;
    public $idUser;
    public function __construct($receptor, $status, $nameProduct, $idUser)
    {
        $this->receptor = $receptor;
        $this->status = $status;
        $this->nameProduct = $nameProduct;
        $this->idUser = $idUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
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
                    ->markdown('mail.status.PedidoStatus',[
                        'url' => url('/seller/compradores' . '/' . $this->idUser),
                        'receptor'=>$this->receptor,
                        'status'=>$this->status,
                        'nameProduct'=>$this->nameProduct,
                    ])
                    ->subject('Status del Pedido')
                    ->cc(['enrique@trademarket.com.mx', 'ruth.abasolo@trademarket.com.mx', 'wendy@trademarket.com.mx'])
                    ->from('adminportales@bhtrademarket.com.mx', 'HHGLOBAL');
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
