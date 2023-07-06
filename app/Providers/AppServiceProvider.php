<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Config;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        VerifyEmail::toMailUsing(function ($notifiable) {
            // $verifyUrl = URL::temporarySignedRoute(
            //     'verification.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey()]
            // );

            $verifyUrl = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );
            // $verifyUrl = $this->verificationUrl($notifiable);
            return (new MailMessage)
                ->subject('Welcome!')
                ->markdown('mail.verify', ['url' => $verifyUrl]);
        });
    }
}
