<?php

return [
    'models' => [
        'product' => [
            'presenter' => \Packages\Modules\Larashop\Transformers\ProductPresenter::class,
            'resource_url' => 'e-commerce/products',
            'default_image' => 'assets/Packages/images/default_product_image.png'
        ],
        'coupon' => [
            'presenter' => \Packages\Modules\Larashop\Transformers\CouponPresenter::class,
            'resource_url' => 'e-commerce/coupons',
        ],
        'shipping' => [
            'presenter' => \Packages\Modules\Larashop\Transformers\ShippingPresenter::class,
            'resource_url' => 'e-commerce/shippings',
        ],
        'order' => [
            'presenter' => \Packages\Modules\Larashop\Transformers\OrderPresenter::class,
            'resource_url' => 'e-commerce/orders',
            'statuses' => 'Larashop::status.order',
            'shipping_statuses' => 'Larashop::status.shipping',
            'payment_statuses' => 'Larashop::status.payment',
        ],
        'shop' => [
            'sort_options' => 'Larashop::status.shop_order',
        ],
        'wishlist' => [
            'presenter' => \Packages\Modules\Larashop\Transformers\WishlistPresenter::class,
            'resource_url' => 'e-commerce/wishlist',
        ],
        'order_item' => [
            'presenter' => \Packages\Modules\Larashop\Transformers\OrderItemPresenter::class,
        ],
        'category' => [
            'presenter' => \Packages\Modules\Larashop\Transformers\CategoryPresenter::class,
            'resource_url' => 'e-commerce/categories',
            'default_image' => 'assets/Packages/images/default_product_image.png'
        ],
        'tag' => [
            'presenter' => \Packages\Modules\Larashop\Transformers\TagPresenter::class,
            'resource_url' => 'e-commerce/tags',
        ],
        'brand' => [
            'presenter' => \Packages\Modules\Larashop\Transformers\BrandPresenter::class,
            'resource_url' => 'e-commerce/brands',
            'default_image' => 'assets/Packages/images/default_product_image.png'
        ],
        'attribute' => [
            'presenter' => \Packages\Modules\Larashop\Transformers\AttributePresenter::class,
            'resource_url' => 'e-commerce/attributes',
        ],
        'sku' => [
            'presenter' => \Packages\Modules\Larashop\Transformers\SKUPresenter::class,
            'resource_route' => 'e-commerce.products.sku.index',
            'default_image' => 'assets/Packages/images/default_product_image.png',
            'inventory_options' => [
                'finite' => 'Larashop::attributes.product.type_options.finite',
                'bucket' => 'Larashop::attributes.product.type_options.bucket',
                'infinite' => 'Larashop::attributes.product.type_options.infinite'
            ],
            'bucket' => [
                'in_stock' => 'Larashop::attributes.product.bucket_options.in_stock',
                'out_of_stock' => 'Larashop::attributes.product.bucket_options.out_of_stock',
                'limited' => 'Larashop::attributes.product.bucket_options.limited',
            ]
        ],
        'sku_property' => [],
    ],
    'settings' => [
        'Company' => [
            'owner' => [
                'label' => 'Larashop::labels.settings.company.owner',
                'type' => 'text',
                'required' => true,
            ],
            'name' => [
                'label' => 'Larashop::labels.settings.company.name',
                'type' => 'text',
                'required' => true,
            ],
            'street1' => [
                'label' => 'Larashop::labels.settings.company.street',
                'type' => 'text',
                'required' => true,
            ],
            'city' => [
                'label' => 'Larashop::labels.settings.company.city',
                'type' => 'text',
                'required' => true,
            ],
            'state' => [
                'label' => 'Larashop::labels.settings.company.state',
                'type' => 'text',
                'required' => true,
            ],
            'zip' => [
                'label' => 'Larashop::labels.settings.company.zip',
                'type' => 'text',
                'required' => true,
            ],
            'country' => [
                'label' => 'Larashop::labels.settings.company.country',
                'type' => 'text',
                'required' => true,
            ],
            'phone' => [
                'label' => 'Larashop::labels.settings.company.phone',
                'type' => 'text',
                'required' => true,
            ],
            'email' => [
                'label' => 'Larashop::labels.settings.company.email',
                'type' => 'text',
                'required' => true,
            ],
        ],
        'Shipping' => [
            'weight_unit' => [
                'label' => 'Larashop::labels.settings.shipping.weight_unit',
                'type' => 'select',
                'options' => [
                    'kg' => 'kg',
                    'g' => 'g',
                    'lb' => 'lbs',
                    'oz' => 'oz'
                ],
                'required' => true,
            ],
            'dimensions_unit' => [
                'label' => 'Larashop::labels.settings.shipping.dimensions_unit',
                'type' => 'select',
                'options' => [
                    'm' => 'm',
                    'cm' => 'cm',
                    'mm' => 'mm',
                    'in' => 'in',
                    'yd' => 'yd'
                ],
                'required' => true,
            ],
            'shippo_live_token' => [
                'label' => 'Larashop::labels.settings.shipping.shippo_live_token',
                'type' => 'text',
                'required' => true,
            ],
            'shippo_test_token' => [
                'label' => 'Larashop::labels.settings.shipping.shippo_test_token',
                'type' => 'text',
                'required' => true,
            ],
            'shippo_sandbox_mode' => [
                'label' => 'Larashop::labels.settings.shipping.shippo_sandbox_mode',
                'type' => 'boolean'
            ],

        ],
        'Tax' => [
            'calculate_tax' => [
                'label' => 'Larashop::labels.settings.tax.calculate_tax',
                'type' => 'boolean',
                'required' => true,
            ]
        ],
        'Rating' => [
            'enable' => [
                'label' => 'Larashop::labels.settings.rating.enable',
                'type' => 'boolean',
                'required' => true,
            ]
        ],
        'Wishlist' => [
            'enable' => [
                'label' => 'Larashop::labels.settings.wishlist.enable',
                'type' => 'boolean',
                'required' => true,
            ]
        ],
        'Appearance' => [
            'page_limit' => [
                'label' => 'Larashop::labels.settings.appearance.page_limit',
                'type' => 'number',
                'required' => false,
            ]
        ],
        'Search' => [
            'title_weight' => [
                'label' => 'Larashop::labels.settings.search.title_weight',
                'type' => 'number',
                'step' => 0.01,
                'required' => false,
            ],
            'content_weight' => [
                'label' => 'Larashop::labels.settings.search.content_weight',
                'type' => 'number',
                'step' => 0.01,
                'required' => false,
            ],
            'enable_wildcards' => [
                'label' => 'Larashop::labels.settings.search.enable_wildcards',
                'type' => 'boolean',
                'required' => true,
            ]
        ],
        'AdditonalCharge' => [
            'additonal_charge_title' => [
                'label' => 'Larashop::labels.settings.additonal_charge.title',
                'type' => 'text',
                'required' => false,
            ],
            'additonal_charge_amount' => [
                'label' => 'Larashop::labels.settings.additonal_charge.amount',
                'type' => 'number',
                'step' => 0.01,
                'required' => false,
            ],
            'additonal_charge_type' => [
                'label' => 'Larashop::labels.settings.additonal_charge.type',
                'type' => 'select',
                'options' => [
                    'fixed' => 'Fixed',
                    'percentage' => 'Percentage',
                ],
                'required' => false,
            ],
            'additonal_charge_gateways' => [
                'label' => 'Larashop::labels.settings.additonal_charge.gateways',
                'type' => 'text',
                'required' => false,
            ],
        ]
    ],
];