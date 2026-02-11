<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'name' => "Let's Go China",
            'detail' => 'Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'email' => 'contact@letsgochinaofficial.com',
            'phone' => '01795041057',
            'fax' => '01795041057',
            'logo' => '/storage/default/logo/logo.png',
            'favicon' => '/storage/default/favicon/favicon.png',
            'address' => 'House#02; Road#03, Nikunja#2, Dhaka, Bangladesh',
            'time' => 'Mon-Sat : 08:00-20:00',
            'website' => 'https://www.letsgochinaofficial.com',
            'social' => json_encode([
                'facebook'  => 'https://www.facebook.com',
                'youtube'   => 'https://www.youtube.com',
                'x'         => 'https://www.x.com',
                'linkedin'  => 'https://www.linkedin.com',
            ]),

            'auth_bg_image' => 'assets/backend/media/misc/auth-screens.png',
            'auth_fg_image' => 'assets/backend/media/misc/auth-bg.png',
            'auth_title'    => 'Fast, Efficient and Productive',
            'auth_detail'   => 'In this kind of post, the blogger introduces a person they’ve interviewed and provides some background information about the interviewee and their work following this is a transcript of the interview.',

            'socialite' => json_encode(["google", "facebook", "apple"]),
            'google'    => json_encode([
                'client_id'     => '823253114392-97kihfmtcfrig0doqe3b6nht2kne2jf1.apps.googleusercontent.com',
                'client_secret' => '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',
                'callback_url'  => 'http://monarchysolutions/auth/redirect/google',
            ]),
            'facebook'  => json_encode([
                'client_id'     => '640827321479735',
                'client_secret' => '4b3cd5a44f99a5b8d334c4225bc7274a',
                'callback_url'  => 'http://monarchysolutions/auth/redirect/google',
            ]),

            'smtp' => json_encode([
                'host' => 'smtp.gmail.com',
                'port' => 587,
                'username' => 'mailergoooo@gmail.com',
                'password' => 'jnhr dvjz vzig lpsx',
                'encryption' => 'tls',
                'name' => "Let's Go China",
                'email' => 'hello@letsgochinaofficial.com',
                'to_email' => 'mrweb2455@gmail.com',
                'cc_email' => 'alamin16244@gmail.com',
            ]),

            'protection' => json_encode([
                'password' => 'passpp1,passpp2',
                'lifetime' => '604800',
            ]),

            'meta' => json_encode([
                'title'             => "Let's Go China",
                'description'       => "Let's Go China",
                'keyword'           => "Let's Go China",
            ]),

            'other' => json_encode([
                'whatsapp' => '8801795041057',
                'notification_id' => '1',
                'google_maps_api_key' => 'AIzaSyCwj6Y2m5inA60H-z5chMZUmrOsnzZUNO8',
            ]),

        ]);
    }
}
