<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::create([
            'type' => 'process',
            'name' => 'Work Process',
            'title' => 'How we do our visa & Immigration processing',
            'description' => 'Lets Go China Visa Consultancy was created to provide uniquely des igned premium services in the world of education and migration. As people are dreaming more.',
            'link' => '#',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Section::create([
            'type' => 'essential',
            'name' => 'Our Essentials',
            'title' => 'Choose Your Required Essentials from our list',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Section::create([
            'type' => 'intro',
            'name' => 'Company Intro',
            'title' => "We help Making your <br> dream into Reality",
            'description' => "Immigway Visa Consultancy was created to provide uniquely des igned premium services in the world of education and migration. As people are dreaming more.",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Section::create([
            'type' => 'about',
            'name' => 'About Our Company',
            'title' => "We help Making your <br> dream into Reality",
            'description' => "Let's Go China Visa Consultancy was created to provide uniquely des igned premium services in the world of education and migration. As people are dreaming more.",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Section::create([
            'type' => 'subscriber',
            'title' => "Subscribe To Let's Go China For All the offers",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Section::create([
            'type' => 'contact',
            'title' => "Write us what you <br> want to Know",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Section::create([
            'type' => 'visa',
            'name' => 'Visa',
            'title' => 'Committed to provide you the best visa services',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Section::create([
            'type' => 'testimonial',
            'name' => 'Testimonial',
            'title' => 'Our Client Have Trusted Us for our work',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Section::create([
            'type' => 'team',
            'name' => 'Team',
            'title' => 'We have the best Team to Fulfill Your Dream',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Section::create([
            'type' => 'choose',
            'name' => 'Why Choose Us',
            'title' => 'We ensure prompt services for visa & Immigration',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Section::create([
            'type' => 'feature',
            'name' => 'Our Features',
            'title' => 'Committed to provide you the best services',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Section::create([
            'type' => 'faq',
            'name' => 'Frequently Asked Questions',
            'title' => 'Questions & Answer',
            'description' => "Let's Go ChinaVisa Consultancy was created to provide uniquely des igned premium services in the world of education and migration. As people are dreaming more",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $data = [
            [
                'value' => 23,
                'text'  => "Trusted Clients",
            ],
            [
                'value' => 50,
                'text'  => "Country Operation",
            ],
            [
                'value' => 23,
                'text'  => "Trusted Clients",
            ],
            [
                'value' => 50,
                'text'  => "Country Operation",
            ],
        ];
        Section::create([
            'type' => 'funfact',
            'json' => json_encode($data),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Section::create([
            'type' => 'blog',
            'name' => 'Latest News',
            'title' => "Our Latest News Gives great glimpse <br> of International Education",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Section::create([
            'type' => 'case',
            'name' => 'Case Studies',
            'title' => "Our Successful Case Studies",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
         Section::create([
            'type' => 'university',
            'name' => 'Top Universities',
            'title' => "Brief Overview of our <br> Amazing journey",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
         Section::create([
            'type' => 'course',
            'name' => 'Top Course',
            'title' => "Brief Overview of our <br> Amazing journey",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
         Section::create([
            'type' => 'footer',
            'title' => "We are shaping your dream future",
            'description' => "Indignation and dislike men who are so beguiled and of pleasure of the moment so blinded",
            'link' => "#",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
