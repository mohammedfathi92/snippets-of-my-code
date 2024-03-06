<?php

return [


    'main' => 'الصفحة الرئيسية',

//investor
    'investor' => [
        'create' => ' صفحة انشاء مستثمر جديد',
        'index' => ' صفحة ادارة المستثمريين ',
        'edit' => ' صفحة التعديل على المستثمر ',
        'show' => ' صفحة عرض المستثمر ',
        'deposit' => ' صفحة عملية الايداع ',
        'pull' => ' صفحة عملية السحب ',
        'pull_company' => ' صفحة اداره المصروفات ',
        'trancfer' => ' صفحة عملية التحويل من مستثمر الى اخر ',
    ],

    'client' => [
        'create' => ' صفحة انشاء عميل جديد',
        'index' => ' صفحة ادارة العملاء ',
        'edit' => ' صفحة التعديل على العميل ',
        'show' => ' صفحة عرض العميل ',
    ],

    'store' => [
        'buy_product' => ' صفحة شراء سلعه جديده',
        'index' => ' صفحة ادارة مخزون المستثمرين ',
        'show' => ' صفحة عرض السلعة ',
    ],

    'financial' => [
        'index' => ' صفحة ادارة المعاملات الماليه ',
        'show' => ' صفحة عرض المعاملات الماليه ',
    ],

    'contract' => [
        'create' => ' صفحة انشاء عقد جديد',
        'review' => ' صفحة مراجعه العقد ',
        'show' => ' صفحة عرض العقد ',

        'sponsor_edit' => ' صفحة تعديل الكفيل ',
        'premium_edit_date' => ' صفحة تعديل تاريخ القسط ',
        'premium_edit' => ' صفحة تعديل الاقساط ',
        'collection' => ' صفحة السداد والتحصيل ',
        'finish' => ' صفحة مخالصه العقد ',

        'current' => ' صفحة العقود الساريه ',
        'late' => ' صفحة العقود المتاخره ',
        'conflict' => ' صفحة العقود المتعثره ',
        'profits' => ' صفحة ارباح العقود ',
        'pure' => ' صفحة العقود الخالصه ',
        'premiums' => ' صفحة الاقساط والدفعات ',
        'profit' => ' صفحة عمولة العقد ',
        'fees' => ' صفحة الرسوم الاداريه ',
        'issue' => ' صفحة العقود ذات قضيه  ',
        'recreate' => ' صفحة اعاده انشاء العقد  ',
        'premium_late'=>'صفحة الاقساط المتاخره'

    ],



    'collection' => [
        'late_premiums' => ' صفحة الملاحظات والاقساط المتاخره ',
        'index' => ' صفحة ملاحظات التحصيل ',
        'show' => ' صفحة عرض الملاحظات ',
    ],

    'products' => [
        'index' => ' صفحة عرض المنتجات ',
    ],

    'categories' => [
        'index' => ' صفحة عرض التصنيفات ',
    ],

    'logs' => [
        'title' => ' صفحة عرض جميع الاكشن فى الموقع ',
    ],

    'bank_accounts' => [
        'title' => ' صفحة عرض جميع الحسابات البنكيه ',
        'company' => ' صفحة عرض جميع حسابات الشركه ',
    ],

    'groups' => [
        'title' => ' صفحة عرض جميع المجموعات فى الموقع ',
    ],

    'target' => [
        'title' => ' صفحة عرض جميع البنود فى الموقع ',
    ],


    //logs action
    'activities' => [
        'create_contract' => 'انشاء عقد جديد',
        'update_contract' => 'تعديل عقد',
        'delete_contract' => 'حذف عقد',
        'update_template' => 'تعديل نموذج طباعة',
        'update_contract_group'=>'تعديل مجموعه العقد',
        'update_contract_sponsor'=>'تعديل الكفيل فى العقد',
        'update_contract_fees'=>'تعديل الرسوم الاداريه فى العقد',
        'update_contract_profit'=>'تعديل العموله فى العقد',
        'premium_pay'=>'دفع قسط',
        'premium_update'=>'تعديل قسط',
        'create_contract_conflict'=> 'اضافه للعقود المتعثره',
        'create_contract_finish'=>'مخالصة عقد',
        'create_contract_issue'=> 'اضافه للعقود ذات القضية',
        'create_contract_note'=>'اضافة ملاحظه للعقد',



        'create_category'=> ' انشاء تصنيف جديد',
        'update_category' => 'تعديل تصنيف',
        'delete_category' => 'حذف تصنيف',

        'create_product'=> ' انشاء منتج جديد',
        'update_product' => 'تعديل منتج',
        'delete_product' => 'حذف منتج',

        'create_investor'=> ' انشاء مستثمر جديد',
        'update_investor' => 'تعديل مستثمر',
        'delete_investor' => 'حذف مستثمر',
        'create_deposit'=>'عمليه ايداع',
        'create_pull'=>'عمليه سحب',
        'create_transfer'=>' عمليه تحويل',
        'create_note'=> 'تسجيل ملاحظة',

        'create_collection'=> ' انشاء ملاحظه سداد وتحصيل ',

        'create_user'=> ' انشاء عضو جديد',
        'update_user' => 'تعديل عضو',
        'delete_user' => 'حذف عضو',

        'create_client'=> ' انشاء عضو عميل',
        'update_client' => 'تعديل عميل',
        'delete_client' => 'حذف عميل',


        'create_company_account'=> ' انشاء حساب بنكى جديد',
        'update_company_account' => 'تعديل حساب',
        'delete_create_company_account' => 'حذف حساب',

        'create_group'=> ' انشاء مجموعه جديد',
        'update_group' => 'تعديل مجموعه',
        'delete_group' => 'حذف مجموعه',

        'investor_buy_product'=>'شراء سلعه',
        'delete_investor_product'=>'حذف سلع المستثمر',


        'create_target'=>'انشاء بند جديد',








    ],


];
