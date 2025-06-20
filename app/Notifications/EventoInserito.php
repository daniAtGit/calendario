<?php

namespace App\Notifications;

use App\Models\Evento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventoInserito extends Notification
{
    use Queueable;

    public $evento;

    /**
     * Create a new notification instance.
     */
    public function __construct(Evento $evento)
    {
        $this->evento = $evento;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('Nuovo evento'))
            ->greeting('Ciao ' . $notifiable->nome)
            ->line('E\' stato inserito un nuovo evento per il giorno: ' . $this->evento->start->format('d/m/Y'))
            ->line('Descrizione:')
            ->line($this->evento->descrizione)
            ->action('Vedi', url('/'))
            ->salutation('by mycalendario');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
