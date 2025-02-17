<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class WeatherAlertNotification extends Notification
{
    use Queueable;
    protected array $weatherData;

    public function __construct(array $weatherData)
    {
        $this->weatherData = $weatherData;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Weather Alert')
            ->line("High precipitation: {$this->weatherData['precipitation']}mm")
            ->line("High UV Index: {$this->weatherData['uv_index']}")
            ->action('Check Weather', url('/'));
    }
}
