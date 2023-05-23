<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderEmailNotification extends Notification
{
    use Queueable;
    protected $usuario;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($usuario)
    {
        $this->usuario = $usuario;
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
        $env = env('APP_URL');
        return (new MailMessage)

        ->subject('usuario creado')
        ->line('Fecha: ' . $this->usuario->created_at)
        ->line('Usuario: ' . $this->usuario->nombre)
        ->line('Email: ' . $this->usuario->email)
        ->line('Estado: ' . $this->usuario->estado);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
