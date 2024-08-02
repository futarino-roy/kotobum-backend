<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Channels\LineMessaging;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class SendKotobamuMessage extends Notification implements LineMessageInterface
{
    use Queueable;

    public $message_content;
    public $image_url;
    public $audio_url;

    /**
     * Create a new notification instance.
     */
    public function __construct($message_content, $image_url, $audio_url)
    {
        $this->message_content = $message_content;
        $this->image_url = $image_url;
        $this->audio_url = $audio_url;
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
        return view('line.kotobamu_message', ['user' => $notifiable, 'message_content' => $this->message_content, 'image_url' => $this->image_url, 'audio_url' => $this->audio_url])->render();
    }

    public function reply()
    {
        return false;
    }
}
