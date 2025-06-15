<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClassRequestStatusNotification extends Notification
{
    use Queueable;


    public $status;
    public $className;

    public function __construct($status, $className)
    {
        $this->status = $status;
        $this->className = $className;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $subject = "Your class request has been {$this->status}";

        return (new MailMessage)
                    ->subject($subject)
                    ->greeting("Hello {$notifiable->name},")
                    ->line("Your request for class '{$this->className}' has been {$this->status}.")
                    ->action('View Requests', url('/class/requests/view'))
                    ->line('Thank you for using our application');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => "Your request for {$this->className} has been {$this->status}",
            'url' => 'class/requests/view'
        ];
    }
}
