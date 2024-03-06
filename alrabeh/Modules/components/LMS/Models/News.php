<?php
/**
 * Created by PhpStorm.
 * User: iMak
 * Date: 11/19/17
 * Time: 8:41 AM
 */

namespace Modules\Components\LMS\Models;

use Illuminate\Database\Eloquent\Builder;

class News extends Content
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'news');
        });
    }


    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'lms.models.news';

    protected $table = 'courses';

    protected $attributes = [
        'type' => 'news'
    ];

    protected $fillable = ['title', 'slug', 'meta_keywords',
        'meta_description', 'content', 'published', 'published_at', 'private', 'type', 'author_id', 'template', 'featured_image_link'];


}