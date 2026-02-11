<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $setting = Setting::first();
        // dd($setting);
        if($setting){
            $google = json_decode($setting->google);
            $facebook = json_decode($setting->facebook);
            $smtp = json_decode($setting->smtp);
            $notification = json_decode($setting->notification);
            $protection = json_decode($setting->protection);
            $meta = json_decode($setting->meta);
            $other = json_decode($setting->other);
            $settingdata = [
                'name'                      => $setting->name,
                'detail'                    => $setting->detail,
                'email'                     => $setting->email,
                'phone'                     => $setting->phone,
                'fax'                       => $setting->fax,
                'logo'                      => $setting->logo,
                'favicon'                   => $setting->favicon,
                'address'                   => $setting->address,
                'time'                      => $setting->time,
                'website'                   => $setting->website,
                'social'                    => $setting->social,

                'to_mail'                   => $smtp->to_email,
                'cc_mail'                    => $smtp->cc_email,

                'auth_bg_image'             => $setting->auth_bg_image,
                'auth_fg_image'             => $setting->auth_fg_image,
                'auth_title'                => $setting->auth_title,
                'auth_detail'               => $setting->auth_detail,

                'google_client_id'          => $google->client_id,
                'google_client_secret'      => $google->client_secret,
                'google_callback_url'       => $google->callback_url,

                'facebook_client_id'        => $facebook->client_id,
                'facebook_client_secret'    => $facebook->client_secret,
                'facebook_callback_url'     => $facebook->callback_url,

                'protection_password'       => $protection->password,
                'protection_lifetime'       => $protection->lifetime,

                'meta' => [
                    'title'             => $meta->title,
                    'description'       => $meta->description,
                    'keyword'           => $meta->keyword,
                ],

                'other' => [
                    'whatsapp' => $other->whatsapp,
                    'notification_id' => $other->notification_id,
                    'google_maps_api_key' => $other->google_maps_api_key,
                ],
            ];

            $smtpdata = [
                'transport'     => 'smtp',
                'url'           => env('MAIL_URL'),
                'host'          => $smtp->host,
                'port'          => $smtp->port,
                'encryption'    => $smtp->encryption,
                'username'      =>  $smtp->username,
                'password'      => $smtp->password,
                'timeout'       => null,
                'local_domain'  => env('MAIL_EHLO_DOMAIN'),
            ];

            $fromdata = [
                'address'         => $smtp->email,
                'name'            => $smtp->name,
            ];

            $backupdata = [
                'to' => $smtp->to_email,
                'from' => [
                    'address' => $smtp->email,
                    'name' => $smtp->name,
                ],
            ];

            Config::set('setting', $settingdata);
            Config::set('mail.mailers.smtp', $smtpdata);
            Config::set('mail.from', $fromdata);
            Config::set('backup.notifications.mail', $backupdata);
        }

        // dd($settingdata);
        // dd(config('setting'));
        // dd(config('backup.notifications.mail.to'));

    }
}
