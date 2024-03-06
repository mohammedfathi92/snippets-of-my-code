<?php

namespace Modules\Components\LMS\Models;

use Illuminate\Database\Eloquent\Builder;

class Page extends Content
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'page');
        });
    }

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'lms.models.page';

    protected $table = 'courses';


    protected $attributes = [
        'type' => 'page'
    ];

    protected $fillable = ['title', 'slug', 'meta_keywords',
        'meta_description', 'content', 'published', 'published_at', 'private', 'type', 'author_id', 'template', 'featured_image_link'];
}
