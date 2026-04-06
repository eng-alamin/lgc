<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class SchemaHelper
{
    public static function organization()
    {
        return [
            "@context" => "https://schema.org",
            "@type" => "Organization",
            "name" => config('setting.name'),
            "url" => url('/'),
            "logo" => asset(config('setting.logo')),
            "sameAs" => [
                "https://www.facebook.com/Letsgochinaofficial/"
            ]
        ];
    }

    public static function website()
    {
        return [
            "@context" => "https://schema.org",
            "@type" => "WebSite",
            "name" => config('setting.name'),
            "url" => url('/'),
            "potentialAction" => [
                "@type" => "SearchAction",
                "target" => url('/search?q={search_term_string}'),
                "query-input" => "required name=search_term_string"
            ]
        ];
    }

    public static function webpage($title = null)
    {
        return [
            "@context" => "https://schema.org",
            "@type" => "WebPage",
            "name" => $title ?? config('setting.name'),
            "url" => url()->current(),
        ];
    }

    public static function breadcrumb($items = [])
    {
        $list = [];
        foreach ($items as $key => $item) {
            $list[] = [
                "@type" => "ListItem",
                "position" => $key + 1,
                "name" => $item['name'],
                "item" => $item['url']
            ];
        }

        return [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => $list
        ];
    }

    public static function blog($blog)
    {
        return [
            "@context" => "https://schema.org",
            "@type" => "BlogPosting",
            "mainEntityOfPage" => [
                "@type" => "WebPage",
                "@id" => url()->current()
            ],
            "headline" => $blog->title,
            "description" => Str::limit(strip_tags($blog->description), 160),
            "image" => asset($blog->file),
            "author" => [
                "@type" => "Organization",
                "name" => config('setting.name'),
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => config('setting.name'),
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => asset(config('setting.logo'))
                ]
            ],
            "datePublished" => optional($blog->created_at)->toIso8601String(),
            "dateModified" => optional($blog->updated_at)->toIso8601String()
        ];
    }

    public static function faq($faqs = [])
    {
        $data = [];

        foreach ($faqs as $faq) {
            $data[] = [
                "@type" => "Question",
                "name" => $faq['question'],
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => $faq['answer']
                ]
            ];
        }

        return [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => $data
        ];
    }
}