<?php

return [
    'models'   => [
        'category' => [
            'presenter'    => \Modules\Components\LMS\Transformers\CategoryPresenter::class,
            'resource_url' => 'lms/categories',
            'default_image' => 'img/no_image.jpg',
        ],
        'plan'  => [
            'presenter'    => \Modules\Components\LMS\Transformers\PlanPresenter::class,
            'resource_url' => 'lms/plans',
            'default_image' => 'img/no_image.jpg',
        ],
        'course'  => [
            'presenter'    => \Modules\Components\LMS\Transformers\CoursePresenter::class,
            'resource_url' => 'lms/courses',
            'default_image' => 'img/no_image.jpg',
        ],
        'lesson'  => [
            'presenter'    => \Modules\Components\LMS\Transformers\LessonPresenter::class,
            'resource_url' => 'lms/lessons',
            'default_image' => 'img/no_image.jpg',
        ],
        'testimonial'  => [
            'presenter'    => \Modules\Components\LMS\Transformers\TestimonialPresenter::class,
            'resource_url' => 'lms/testimonials',
            'default_image' => 'img/no_image.jpg',
        ],
         'question'  => [
            'presenter'    => \Modules\Components\LMS\Transformers\QuestionPresenter::class,
            'resource_url' => 'lms/questions',
            'default_image' => 'img/no_image.jpg',
        ],
        'quiz_question' => [
            'presenter'    => \Modules\Components\LMS\Transformers\QuizQuestionPresenter::class,
            'resource_route' => 'quizzes.questions.index',
            'default_image' => 'assets/corals/images/default_product_image.png',
        ],
         'quiz'  => [
            'presenter'    => \Modules\Components\LMS\Transformers\QuizPresenter::class,
            'resource_url' => 'lms/quizzes',
            'default_image' => 'img/no_image.jpg',
        ],
        'tag'  => [
            'presenter'    => \Modules\Components\LMS\Transformers\TagPresenter::class,
            'resource_url' => 'lms/tags',
        ],

         'invoice'  => [
            'presenter'    => \Modules\Components\LMS\Transformers\InvoicePresenter::class,
            'resource_url' => 'lms/invoices',
        ],

        'coupon_group'  => [
            'presenter'    => \Modules\Components\LMS\Transformers\CouponGroupPresenter::class,
            'resource_url' => 'lms/coupons_groups',
        ],

         'coupon'  => [
            'presenter'    => \Modules\Components\LMS\Transformers\CouponPresenter::class,
            'resource_url' => 'lms/coupons',
        ],

         'subscription'  => [
            'presenter'    => \Modules\Components\LMS\Transformers\SupscriptionPresenter::class,
            'resource_url' => 'lms/subscriptions',
        ],
        'certificate'  => [
            'presenter'    => \Modules\Components\LMS\Transformers\CertificatePresenter::class,
            'resource_url' => 'lms/certificates',
        ],
        'book'  => [
            'presenter'    => \Modules\Components\LMS\Transformers\BookPresenter::class,
            'resource_url' => 'manage/books',
        ],

    ],
    'frontend' => [
        'page_limit' => 10,
    ]
];