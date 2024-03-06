<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 7/15/18
 * Time: 9:58 AM
 */

namespace Modules\Components\LMS\Transformers;

use Modules\Foundation\Transformers\BaseTransformer;
use Modules\Components\LMS\Models\Book;

class BookTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.book.resource_url');

        parent::__construct();
    }

    /**
     * @param Book $book
     * @return array
     * @throws \Throwable
     */
    public function transform(Book $book)
    {
        return [
            'id'      => $book->id,

            'title'   => str_limit($book->title, 50),
            // 'slug'    => $book->slug,
            'page_num'    =>$book->pages_count,
            'author' => $book->author?$book->author->name:'-',
            'status' => formatStatusAsLabels($book->status > 0?'active': 'inactive'),
            'updated_at' => \Carbon\Carbon::instance($book->updated_at)->diffForHumans(),
            'action' => $this->actions($book)
        ];
    }
}