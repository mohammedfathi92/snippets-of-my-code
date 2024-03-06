<?php

return [
    'models' => [
        'page' => [
            'presenter' => \Modules\Components\CMS\Transformers\PagePresenter::class,
            'resource_url' => 'cms/pages',
            'translatable' => ['content']
        ],
        'post' => [
            'presenter' => \Modules\Components\CMS\Transformers\PostPresenter::class,
            'resource_url' => 'cms/posts',
        ],
        'category' => [
            'presenter' => \Modules\Components\CMS\Transformers\CategoryPresenter::class,
            'resource_url' => 'cms/categories',
        ],
        'news' => [
            'presenter' => \Modules\Components\CMS\Transformers\NewsPresenter::class,
            'resource_url' => 'cms/news',
        ],
    ],
    'frontend' => [
        'page_limit' => 10,
    ]
];
