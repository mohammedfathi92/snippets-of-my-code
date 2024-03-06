<?php


return [
     'main' => [
        'status_options' => [
        1 => 'active',
        0 => 'in active',
    ]
    ],
    'category' => [
        'name'          => 'Name',
        'slug'          => 'Slug',
        'access_plans'  => 'Subscription plans required to access category articles',
        'courses_count' => 'Courses Count',
        'parent'        => 'Parent Category',
    ],
    'course'   => [
        'name'                => 'Name',
        'slug'                => 'Slug',
        'access_plans'        => 'Subscription plans required to access Course Content',
        'lessons_count'       => 'Courses Count',
        'categories'          => 'Categories',
        'title'               => 'Title',
        'published'           => 'Published',
        'published_at'        => 'Published At',
        'content'             => 'Content',
        'meta_keywords'       => 'Meta keywords',
        'meta_description'    => 'Meta description',
        'tags'                => 'Tags',
        'private'             => 'private',
        'clear'               => 'Clear featured image',
        'featured_image'      => 'Featured Image',
        'featured_image_link' => 'Place a link here',
        'template'            => 'Template',
        'sections'            => ['title' => "Section Title", 'title_placeholder' => "Press Enter to add a new section"],
        'settings'            => [
            'title'             => "Course Settings",
            'tabs'              =>
                ['general'    => 'General',
                 'assessment' => "Assessment",
                 'pricing'    => 'Pricing'
                ],
            'duration'          => "Course Duration",
            'max_students'      => "Maximum Students",
            'enrolled_students' => "Enrolled Students",
            'duration_unit'     => "Duration Unit",
            'duration_units'    => [
                'week'    => "Week",
                'day'     => "Day",
                'hour'    => "Hour",
                'minutes' => "Minutes",
            ],

        ],

    ],
    'tag'      => [
        'name'          => 'Name',
        'slug'          => 'Slug',
        'courses_count' => 'Courses Count',
    ]
];