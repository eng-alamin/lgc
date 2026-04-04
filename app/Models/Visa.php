<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Visa extends Model
{
    protected $guarded = [];

    public function getSeoAttribute()
    {
        return [
            'title' => $this->title ?? config('app.name'),
            'description' => Str::limit($this->subtitle ?? config('setting.detail'),160),
            'image' => $this->file ? (Str::startsWith($this->file, 'http') ? $this->file : asset($this->file)) : asset(config('setting.logo')),
            'url' => url()->current(),
            'type' => 'article',
            'published_at' => optional($this->created_at)->toAtomString(),
            'author' => $this->author ?? config('app.name'),
        ];
    }
}
