<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $setting = $this->findSetting('site.title');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager.seeders.settings.site.title'),
                'value'        => __('voyager.seeders.settings.site.title'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
                'group'        => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.description');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager.seeders.settings.site.description'),
                'value'        => __('voyager.seeders.settings.site.description'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 2,
                'group'        => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.logo');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager.seeders.settings.site.logo'),
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 3,
                'group'        => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.google_analytics_tracking_id');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager.seeders.settings.site.google_analytics_tracking_id'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 4,
                'group'        => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('admin.bg_image');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager.seeders.settings.admin.background_image'),
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 5,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.title');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager.seeders.settings.admin.title'),
                'value'        => 'Voyager',
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.description');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager.seeders.settings.admin.description'),
                'value'        => __('voyager.seeders.settings.admin.description_value'),
                'details'      => '',
                'type'         => 'text',
                'order'        => 2,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.loader');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager.seeders.settings.admin.loader'),
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 3,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.icon_image');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager.seeders.settings.admin.icon_image'),
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 4,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.google_analytics_client_id');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager.seeders.settings.admin.google_analytics_client_id'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
                'group'        => 'Admin',
            ])->save();
        }


        //Add settings

         $setting = $this->findSetting('admin.email');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "البريد الإلكتروني",
                'value'        => 'info@example.com',
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
                'group'        => 'SiteInfo',
            ])->save();
        }

         $setting = $this->findSetting('admin.phone');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "رقم الهاتف",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 2,
                'group'        => 'SiteInfo',
            ])->save();
        }
         $setting = $this->findSetting('admin.mobile');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "رقم الجوال",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 3,
                'group'        => 'SiteInfo',
            ])->save();
        }

         $setting = $this->findSetting('admin.whatsapp');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "رقم الواتساب",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 4,
                'group'        => 'SiteInfo',
            ])->save();
        }

         $setting = $this->findSetting('admin.facebook');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "حساب الفيسبوك",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 5,
                'group'        => 'SiteInfo',
            ])->save();
        }

         $setting = $this->findSetting('admin.twitter');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "حساب تويتر",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 6,
                'group'        => 'SiteInfo',
            ])->save();
        }

         $setting = $this->findSetting('admin.instagram');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "حساب انستقرام",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 7,
                'group'        => 'SiteInfo',
            ])->save();
        }

         $setting = $this->findSetting('admin.snapchat');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "حساب سناب شات",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
                'group'        => 'SiteInfo',
            ])->save();
        }

         $setting = $this->findSetting('admin.youtube');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "قناة اليوتيوب",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 9,
                'group'        => 'SiteInfo',
            ])->save();
        }

         $setting = $this->findSetting('admin.googleplus');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "حساب جوجل بلس",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 10,
                'group'        => 'SiteInfo',
            ])->save();
        }

         $setting = $this->findSetting('admin.country');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "الدولة",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 11,
                'group'        => 'SiteInfo',
            ])->save();
        }

         $setting = $this->findSetting('admin.city');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "المدينة",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 12,
                'group'        => 'SiteInfo',
            ])->save();
        }

         $setting = $this->findSetting('admin.address');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "عنوان الشركة",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 13,
                'group'        => 'SiteInfo',
            ])->save();
        }

//advanced settings
         $setting = $this->findSetting('admin.profit_percent');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "نسبة الربح الإفتراضية في تسجيل عقد جديد (قيمة إفتراضية)",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 14,
                'group'        => 'Admin',
            ])->save();
        }

         $setting = $this->findSetting('admin.buy_product');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => " شراء السلعة (قيمة إفتراضية)",
                'value'        => '',
                'details'      => '{
                    "default": "pull_account",
                    "options": {
                        "pull_account":"سحب من الرصيد",
                        "deposit_money": "إيداع المبلغ كامل (تجاهل الرصيد)"
                        
                    }
                }',
                'type'         => 'radio_btn',
                'order'        => 15,
                'group'        => 'Admin',
            ])->save();
        }
//Premiums
         $setting = $this->findSetting('admin.pay_day');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "يوم حلول القسط (0= نفس يوم العقد , أو من 1 إلى 29) (قيمة إفتراضية)",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.Premiums_num');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "عدد الأقساط (قيمة إفتراضية)",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }
        $setting = $this->findSetting('admin.Premiums_type');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "نوع القسط (قيمة إفتراضية)",
                'value'        => '',
                'details'      => '{
                    "default": "month",
                    "options": {
                        "day":"يومي",
                        "week": "إسبوعي",
                        "month": "إسبوعي",
                        "q_year": "إسبوعي",
                        "h_year": "إسبوعي",
                        "year": "إسبوعي"        
                    }
                }',
                'type'         => 'select_dropdown',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }
        $setting = $this->findSetting('admin.mark_as_delay');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "بعد كم يوم يحسب القسط متأخراً ",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }

        //term contracts
        $setting = $this->findSetting('admin.term_contract_time');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "بعد كم شهر يحل الآجل (قيمة إفتراضية)",
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }
        $setting = $this->findSetting('admin.Premiums_schedule');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "جدولة الأقساط (عرض تاريخ الإستحقاق بأكثر من تقويم)",
                'value'        => '',
                'details'      => '{
                    "default": "melady",
                    "options": {
                        "melady":"الميلادي",
                        "hijry": "الهجري"        
                    }
                }',
                'type'         => 'select_multiple',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }
        $setting = $this->findSetting('admin.fees_status');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "الرسوم الإدارية: الحالة",
                'value'        => '',
                'details'      => '{
                    "default": "0",
                    "options": {
                        "0":"تعطيل",
                        "1": "تفعيل"        
                    }
                }',
                'type'         => 'radio_btn',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }
        $setting = $this->findSetting('admin.pull_fees_after_contract_created');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "الرسوم الإدارية: سحب الرسوم مباشرةً بعد إنشاء العقد",
                'value'        => '',
                'details'      => '{
                    "default": "0",
                    "options": {
                        "0":"لا",
                        "1": "نعم"        
                    }
                }',
                'type'         => 'radio_btn',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }
        $setting = $this->findSetting('admin.fees_value');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "الرسوم الإدارية: القيمة الإفتراضية",
                'value'        => '',
                'details'      => '',
                'type'         => 'number',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }
        $setting = $this->findSetting('admin.can_edit_fees');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "الرسوم الإدارية: إمكانية التعديل",
                'value'        => '',
                'details'      => '{
                    "default": "0",
                    "options": {
                        "0":"تعطيل",
                        "1": "تفعيل"        
                    }
                }',
                'type'         => 'radio_btn',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }
        $setting = $this->findSetting('admin.contract_comm_status');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "عمولة العقد: الحالة",
                'value'        => '',
                'details'      => '{
                    "default": "1",
                    "options": {
                        "0":"تعطيل",
                        "1":"تفعيل"        
                    }
                }',
                'type'         => 'select_dropdown',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.contract_comm_status');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "عمولة العقد: الحالة",
                'value'        => '',
                'details'      => '{
                    "default": "2",
                    "options": {
                        "0":"مبلغ ثابت",
                        "1":"نسبة من اجمالي العقد",
                        "2": "نسبة من ارباح العقد"        
                    }
                }',
                'type'         => 'select_dropdown',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }
        $setting = $this->findSetting('admin.contract_comm_value');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "عمولة العقد: القيمة أو النسبة ",
                'value'        => '',
                'details'      => '',
                'type'         => 'number',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }
        $setting = $this->findSetting('admin.contract_comm_edit');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "عمولة العقد: إمكانية التعديل ",
                'value'        => '',
                'details'      => '{
                    "default": "1",
                    "options": {
                        "0":"تعطيل",
                        "1":"تفعيل"        
                    }
                }',
                'type'         => 'radio_btn',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }
        $setting = $this->findSetting('admin.contract_comm_pay');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "عمولة العقد: سداد تلقائي بعد عملية السداد ",
                'value'        => '',
                'details'      => '{
                    "default": "1",
                    "options": {
                        "1":"نعم",
                        "0":"لا"        
                    }
                }',
                'type'         => 'radio_btn',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }

         $setting = $this->findSetting('admin.rand_number');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "عمولة العقد: جبر الكسور ",
                'value'        => '',
                'details'      => '{
                    "default": "1",
                    "options": {
                        "1":"الكسور تجبر إلى أقرب عدد صحيح ",
                        "0":"لا تُجبر "        
                    }
                }',
                'type'         => 'text',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }
        $setting = $this->findSetting('admin.email');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "عمولة العقد: سحب من رصيد المستثمر مباشرة ",
                'value'        => '',
                'details'      => '{
                    "default": "0",
                    "options": {
                        "1":"نعم",
                        "0":"لا"        
                    }
                }',
                'type'         => 'radio_btn',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }
        $setting = $this->findSetting('admin.investors_pull_way');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "المستثمرين: سحب من رصيد المستثمر بالسالب",
                'value'        => '',
                'details'      => '{
                    "default": "0",
                    "options": {
                        "1":"نعم",
                        "0":"لا"        
                    }
                }',
                'type'         => 'radio_btn',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }
        $setting = $this->findSetting('admin.lawyer_fees');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => "صياغة العقود: رسوم المحاماة ",
                'value'        => '',
                'details'      => '',
                'type'         => 'number',
                'order'        => 16,
                'group'        => 'Admin',
            ])->save();
        }
        
    }

    /**
     * [setting description].
     *
     * @param [type] $key [description]
     *
     * @return [type] [description]
     */
    protected function findSetting($key)
    {
        return Setting::firstOrNew(['key' => $key]);
    }
}
