<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Overtrue\EasySms\Support\Config;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Config\Repository as ConfigRepository;
use App\Models\VerificationCode as VerificationCodeModel;

class VerificationCode extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The notification verification code model.
     *
     * @var \App\Models\VerificationCode
     */
    protected $model;

    /**
     * Create the verification notification instance.
     *
     * @param \App\Models\VerificationCode $model
     * @author Bob<bob@bobcoder.cc>
     */
    public function __construct(VerificationCodeModel $model)
    {
        $this->model = $model;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param \App\Models\VerificationCode $notifiable
     * @return array
     */
    public function via(VerificationCodeModel $notifiable)
    {
        return [$notifiable->channel];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param VerificationCodeModel $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     * @author Bob<bob@bobcoder.cc>
     */
    public function toMail(VerificationCodeModel $notifiable)
    {
        return (new MailMessage)
            ->from(config('mail.username'), config('app.name'))
            ->markdown('mails.varification_code', [
            'model' => $notifiable,
            'user' => $notifiable->user,
        ]);
    }

    /**
     * Get the SMS representation of the norification.
     *
     * @param \App\Models\VerificationCode $notifiable
     * @param Config $config
     * @return Messages\VerificationCodeMessage [type]
     * @author Bob<bob@bobcoder.cc>
     */
    public function toSms(VerificationCodeModel $notifiable, Config $config)
    {
        return new Messages\VerificationCodeMessage(
            new ConfigRepository($config->get('channels.code')),
            (int) $notifiable->code
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->model->toArray();
    }
}
