<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Event extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia;

    protected $fillable = ['title', 'slug', 'location', 'event_date', 'description', 'user_id'];

    public function getSlugOptions(): SlugOptions {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function user() { return $this->belongsTo(User::class); }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('event_images'); 
    }
    protected $casts = [
    'event_date' => 'datetime',
];

    
}
