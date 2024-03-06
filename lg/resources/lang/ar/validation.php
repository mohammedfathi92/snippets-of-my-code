<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'لابد من الموافقة على :attribute',
    'active_url'           => 'حقل :attribute لا يحوي رابطاً صحياً',
    'after'                => 'حقل :attribute لابد أن يحوي تاريخ بعد :date .',
    'alpha'                => 'حقل :attribute لابد أن يحوي حروفاً فقط',
    'alpha_dash'           => 'حقل :attribute يمكن أن يحوي حروفاً، أرقاماً وشرطة وسطية (-) فقط.',
    'alpha_num'            => 'حقل :attribute يمكن أن يحوي حروفاً وأرقاماً فقط.',
    'array'                => 'حقل :attribute لابد أن يحوي على أكثر من عنصر.',
    'before'               => 'حقل :attribute لابد أن يحوي تاريخاً قبل :date.',
    'between'              => [
        'numeric' => 'قيمة حقل :attribute لابد أن تكون رقم بين :min و :max.',
        'file'    => 'حجم ملف :attribute لابد أن يكون بين :min و :max كيلوبايت .',
        'string'  => 'عدد حروف حقل :attribute لابد أن تكون بين :min و :max.',
        'array'   => 'عدد عناصر حقل :attribute لابد أن تكون بين :min و :max',
    ],
    'boolean'              => 'حقل :attribute لابد أن تكون قيمته نعم أو لا.',
    'confirmed'            => 'تأكيد :attribute غير صحيح',
    'date'                 => 'حقل :attribute لا يحوي تاريخاً صحياً.',
    'date_format'          => ' قيمة حقل :attribute لا يطابق التنسيق :format.',
    'different'            => 'قيمة حقل :attribute لابد أن تكون مختلفة عن :other.',
    'digits'               => 'قيمة حقل :attribute لابد أن تكون أحد هذه الأرقام :digits.',
    'digits_between'       => 'حقل :attribute لابد أن يكون رقماً بين :min و :max.',
    'dimensions'           => 'أبعاد الصورة في حقل :attribute غير صحيحة.',
    'distinct'             => 'حقل :attribute يحتوي على قيمة متكررة.',
    'email'                => 'حقل :attribute لابد أن يحوي بريد إلكتروني صحيح.',
    'exists'               => 'قيمة حقل :attribute موجودة من قبل ',
    'file'                 => 'حقل :attribute لابد أن يحوي ملف ',
    'filled'               => 'لابد من ادخال قيمة حقل :attribute.',
    'image'                => 'قيمة حقل :attribute لابد أن تكون صورة.',
    'in'                   => 'تم إختيار قيمة غير صحيحة في حقل :attribute',
    'in_array'             => 'قيمة حقل :attribute غير موجودة في :other.',
    'integer'              => 'قيمة حقل :attribute لابد أن تكون رقماً صحيحاً.',
    'ip'                   => 'حقل :attribute لابد أن يحوي رقم IP صحيح.',
    'json'                 => 'قيمة حقل :attribute لابد أن تكون نص JSON صحيح.',
    'max'                  => [
        'numeric' => 'قيمة حقل :attribute لابد أن تكون أقل من :max',
        'file'    => 'حجم الملف الموجود في :attribute لابد ألا يزيد عن :max كيلو بايت.',
        'string'  => 'عدد حروف حقل :attribute لابد ألا تزيد عن :max حرف.',
        'array'   => 'حقل :attribute لابد ألا يحتوي على أكثر من :max عنصر .',
    ],
    'mimes'                => 'حقل :attribute لابد أن يحوي على ملف من هذه الأنواع: :values فقط.',
    'min'                  => [
        'numeric' => 'قمية حقل :attribute لابد أن تكون :min على الأقل ',
        'file'    => 'حجم الملف المرفوع في :attribute لابد أن يكون :min كيلو بايت على الأقل.',
        'string'  => 'عدد الحروف في حقل :attribute لابد أن تكون :min على الأقل.',
        'array'   => 'حقل :attribute لابد أن يحتوي على :min عنصر على الأقل ',
    ],
    'not_in'               => 'تم اختيار قيمة غير صحيحة في حقل :attribute.',
    'numeric'              => 'قيمة حقل :attribute لابد أن تكون رقماً.',
    'present'              => 'حقل :attribute لابد أن يحوي على نسبة مئوية.',
    'regex'                => 'تنسيق قيمة حقل :attribute غير صحيح.',
    'required'             => 'حقل :attribute مطلوب.',
    'required_if'          => 'حقل :attribute مطلوب في عندما يكون يقمة حقل :other :value',
    'required_unless'      => 'حقل :attribute مطلوب إلا عندما يكون قيمة حقل :other أحد هذه القيم :values',
    'required_with'        => 'حقل :attribute مطلوب عندما تكون القيم :values نسب مئوية',
    'required_with_all'    => 'حقل :attribute مطلوب عندما تكون القيم :values نسب مئوية',
    'required_without'     => 'حقل :attribute مطلوب عندما لا تكون القيم :values نسب مئوية',
    'required_without_all' => 'حقل :attribute مطلوب عندما لا تكون القيم :values نسب مئوية',
    'same'                 => 'قيمة حقل :attribute لابد أن تكون نفس قيمة حقل :other.',
    'size'                 => [
        'numeric' => 'قيمة الحجم في حقل :attribute لابد أن تكون :size.',
        'file'    => 'حجم الملف في حقل ::attribute لابد أن تكون :size كيلو بايت',
        'string'  => 'عدد الحروف في حقل :attribute لابد أن تكون :size.',
        'array'   => 'حقل :attribute لابد أن يحتوي على :size عنصر.',
    ],
    'string'               => 'قيمة حقل :attribute لابد أن تكون نصاً.',
    'timezone'             => 'قيمة حقل :attribute لابد أن تكون قيمة زمنية صحيحة.',
    'unique'               => ':attribute مسجل من قبل.',
    'url'                  => 'تنسيق :attribute غير صحيح',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name'=>"الاسم",
        'email'=>"البريد الإلكتروني",
        'password'=>"كلمة المرور",
        'password_confirmation'=>"تأكيد كلمة المرور",
        'address'=>"العنوان",
        'permission'=>"الصلاحيات",
        'company'=>"الشركة",
        'annual_sales'=>"المبيعات السنوية",
        'phone'=>"الهاتف",
        'mobile'=>"الموبايل",
        'about'=>"تفاصيل أكثر",
        'client'=>"اسم العميل",
        'info'=>"بيانات الصفقة",
        'deliver_at'=>"تاريخ التسليم"
    ],

];
