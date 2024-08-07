<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompraStatus extends Notification
{
    use Queueable;

    public $receptor;
    public $status;
    public $nameProduct;
    public $descriptionProduct;
    public $idCompra;
    public function __construct($receptor, $status, $nameProduct, $descriptionProduct,$idCompra)
    {
        $this->receptor = $receptor;
        $this->status = $status;
        $this->nameProduct = $nameProduct;
        $this->descriptionProduct = $descriptionProduct;
        $this->idCompra = $idCompra;
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
                    ->markdown('mail.status.ConfirmacionCompraStatus',[
                        'url' => url('/mis-compras'),
                        'receptor'=>$this->receptor,
                        'status'=>$this->status,
                        'nameProduct'=>$this->nameProduct,
                        'descriptionProduct'=>$this->descriptionProduct,
                    ])
                    ->subject('Confirmación de compra.')
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
