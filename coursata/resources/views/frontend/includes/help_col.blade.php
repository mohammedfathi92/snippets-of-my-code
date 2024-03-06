   <div class="box_style_2">
                        <i class="icon_set_1_icon-57"></i>
                        <h4>هل تحتاج <span>مساعدة؟</span></h4>
                        @if(Settings::get("help_phone"))
                        <a href="tel://{{ Settings::get("help_phone") }}" class="phone">{{ Settings::get("help_phone") }}</a>
                        @endif
                        <a href="mailto:{{Settings::get("help_email")?:"info@example.com"}}" style="color:#111">{{Settings::get("help_email")?'<small>'.Settings::get("help_email").'</small>':"info@example.com"}}</a>
                      
                    </div>