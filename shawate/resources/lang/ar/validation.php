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
    'active_url'           => 'حقل :attribute لا يحتوي على رابط صحيح',
    'after'                => 'حقل :attribute لابد أن يحتوي تاريخ بعد :date.',
    'alpha'                => 'حقل :attribute لابد أن يحوي حروفاً فقط',
    'alpha_dash'           => 'حقل :attribute يمكن أن يحتوي على حروف، أرقام، والشرطة الوسطة "-"',
    'alpha_num'            => ' الحقل :attribute يمكن أن يحتوي حروفاً وأرقاماً فقط.',
    'array'                => 'الحقل :attribute لابد أن يكون مصفوفة.',
    'before'               => 'الحقل :attribute لابد أن يحتوي على تاريخ قبل :date .',
    'between'              => [
        'numeric' => 'الحقل :attribute لابد أن يحوي رقماً بين :min و :max.',
        'file'    => 'الحقل :attribute لابد أن يحتوي على ملف حجمه بين :min و :max .',
        'string'  => 'الحقل :attribute لابد أن يحتوي على عدد حروف بين :min و :max حرفاً.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'الحقل :attribute لابد أن يحتوي قيمة صحة أو خطأ فقط',
    'confirmed'            => 'تأكيد حقل :attribute غير مطابق.',
    'date'                 => 'حقل :attribute لا يحتوي تاريخاً صحيحاً.',
    'date_format'          => 'حقل :attribute لا يحتوي على تاريخ يطابق التنسيق :format.',
    'different'            => 'قيم الحقل :attribute و :other لابد أن تكون مختلفتين.',
    'digits'               => 'حقل :attribute لابد أن يحتوي :digits رقماً.',
    'digits_between'       => 'حقل :attribute لابد أن يحتوي أرقاماً بين :min و :max رقماً.',
    'dimensions'           => 'حقل :attribute لا يحتوي ابعاداً صحيحة.',
    'distinct'             => 'حقل :attribute حتوي على قيم متكررة.',
    'email'                => 'حقل :attribute لابد أن يحتوي على بريد إلكتروني صحيح.',
    'exists'               => 'قيمة الحقل :attribute غير موجودة.',
    'file'                 => 'الحقل :attribute لابد أن تحتوي على ملف.',
    'filled'               => 'حقل :attribute مطلوب.',
    'image'                => 'حقل :attribute لابد أن يحتوي على صورة.',
    'in'                   => 'قيمة الحقل :attribute غير صحيحة.',
    'in_array'             => 'قيمة الحقل :attribute غير موجودة في :other.',
    'integer'              => 'قمة الحقل :attribute لابد أن تكون رقماً صحيحاً.',
    'ip'                   => 'حقل :attribute لابد أن يحتوي على رقم آي بي IP صحيح',
    'json'                 => 'حقل :attribute لابد أن يحتوي على نص بتنسيق JSON صحيح',
    'max'                  => [
        'numeric' => 'حقل :attribute لابد أن يحتوي على قيمة أقل من :max',
        'file'    => 'حجم الملف في حقل :attribute لابد ألا يزيد عن :max كيلو بايت.',
        'string'  => 'لابد ألا تزيد عدد الحروف في حقل :attribute عن :max حرفاً.',
        'array'   => 'عدد العناصر في حقل :attribute لابد ألا تزيد عن :max عنصر.',
    ],
    'mimes'                => 'حقل :attribute لابد أن يحتوي على ملف بأحد هذه الأنواع :values فقط',
    'mimetypes'            => 'حقل :attribute لابد أن يحتوي على ملف بأحد هذه الأنواع :values فقط',
    'min'                  => [
        'numeric' => 'حقل :attribute لابد ألا يقل عن :min.',
        'file'    => ' حجم الملف في حقل :attribute لابد ألا يقل عن :min كيلو بايت',
        'string'  => 'حقل :attribute لابد أن يحتوي على عدد حروف أكثر من :min حرفاً',
        'array'   => 'حقل :attribute لابد أن يحتوي على :min عنصراً على الأقل.',
    ],
    'not_in'               => 'قمة الحقل :attribute غير صحيحة .',
    'numeric'              => 'حقل :attribute لابد أن يحتوي على رقماً',
    'present'              => 'لابد من تعبئة حقل :attribute ',
    'regex'                => 'تنسيق قمة الحقل :attribute غير صحيح',
    'required'             => 'لابد من إدخال قيمة الحقل :attribute .',
    'required_if'          => 'لابد من إدخال قيمة الحقل :attribute عندما يكون قيمة الحقل :other :value.',
    'required_unless'      => 'حقل :attribute إجباري إلا إذا كان حقل :other يحتوي أحد هذه القيم :values ',
    'required_with'        => 'حقل :attribute مطلوب في حالة إدخال قيمة حقل :other .',
    'required_with_all'    => 'حقل :attribute مطلوب في حالة إدخال قيمة :values .',
    'required_without'     => 'حقل :attribute إجبارياً لأنه لم يتم إدخال قيمة :values.',
    'required_without_all' => 'حقل :attribute لأنه لم يتم إدخال أياً من :values.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'حجم قيم الحقل :attribute لابد أن تكون :size',
        'file'    => 'حجم ملف الحقل :attribute لابد أن تكون :size كيلو بايت',
        'string'  => 'عدد الحروف في حقل :attribute لابد أن تكون :size حرفاً',
        'array'   => 'عدد العناصر في حقل :attribute لابد أن تكون :size عنصراً.',
    ],
    'string'               => 'قيمة الحقل :attribute لابد أن تكون نصاً',
    'timezone'             => 'قيمة الحقل :attribute لابد أن تكو توقيت زمني صحيح',
    'unique'               => 'قيمة الحقل :attribute مستخدمة من قبل',
    'uploaded'             => 'فشل في رفع الملف :attribute',
    'url'                  => 'تنسيق قيمة الحقل :attribute غير صحيح',

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
        'name'         => "الاسم بالكامل",
        'email'        => "البريد الإلكتروني",
        'nationality'  => "الجنسية",
        'mobile'       => "رقم الموبايل",
        'country'      => "دولة الوجهة",
        'date_from'    => "تاريخ الوصول",
        'date_to'      => "تاريخ المغادرة",
        'num_adults'   => "عدد البالغين",
        'num_childes'  => "عدد الأطفال",
        'num_bags'     => "عدد الشنط",
        'num_rooms'    => " عدد الغرف",
        'package_type' => "نوع العرض السياحي",
        'hotel_level'  => "مستوى الفنادق",
        'notes'        => "ملاحظات",
        'recaptcha'    => "كود أو صورة التحقق غير صحيحة",
    ],

];
