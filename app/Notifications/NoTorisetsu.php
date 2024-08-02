<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Channels\LineMessaging;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class NoTorisetsu extends Notification implements LineMessageInterface
{
    use Queueable;

    public $replyToken;

    /**
     * Create a new notification instance.
     */
    public function __construct($replyToken)
    {
        $this->replyToken = $replyToken;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [LineMessaging::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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

    public function getLineMessage(User $notifiable)
    {
        return view('line.no_torisetsu', ['replyToken' => $this->replyToken])->render();
    }

    public function reply()
    {
        return $this->replyToken;
    }
}
