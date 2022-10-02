<?php

namespace Taskday\Notifications;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification as IlluminateNotification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class Notification extends IlluminateNotification implements ShouldQueue
{
    use Queueable;
    use InteractsWithSockets;

    protected PendingNotification $pendingNotification;

    public function __construct(PendingNotification $pendingNotification)
    {
        $this->pendingNotification = $pendingNotification;
    }

    public static function make()
    {
        return new PendingNotification();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast', WebPushChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->view('taskday::emails.notification', [
                "title" => $this->pendingNotification()->title,
                "body" => $this->pendingNotification()->body,
            ])
            ->action($this->pendingNotification()->actionLabel, $this->pendingNotification()->actionUrl);
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
            'title' => $this->pendingNotification()->title,
            'body' => $this->pendingNotification()->body,
            'user' => $notifiable,
            'url' => $this->pendingNotification()->actionUrl,
            'action' => [
                'label' => $this->pendingNotification()->actionLabel,
                'url' => $this->pendingNotification()->actionUrl,
            ]
        ];
    }


    /**
     * Return the web push notification message.
     *
     * @param  mixed  $notifiable
     * @return WebPushMessage
     */
    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage())
            ->body($this->pendingNotification()->body)
            ->title($this->pendingNotification()->title)
            ->action($this->pendingNotification()->actionLabel, $this->pendingNotification()->actionUrl)
            ->icon('/faicons/256.png')
            ->options(['TTL' => 1000]);
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }


    /**
     * Return the current pending notification.
     */
    public function pendingNotification(): PendingNotification
    {
        return $this->pendingNotification;
    }
}
