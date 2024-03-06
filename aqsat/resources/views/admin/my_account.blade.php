@extends('voyager::master')

@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="col-md-12">
                <div class="theme-panel">
                    <div class="toggler tooltips" data-container="body" data-placement="rigth" data-html="true"
                         data-original-title="لتعديل إعدادات البرنامج" style="display: block;">
                        <i class="icon-settings"></i>
                    </div>
                </div>
                <div class="theme-panel" style="margin-left:50px!important;">
                    <div class="toggler tooltips" data-container="body" data-placement="rigth" data-html="true"
                         data-original-title="تذاكر الدعم الفني" style="display: block;">
                        <i class=" icon-support"></i>
                    </div>
                    </a>
                </div>
                <h3 class="no_print page-title"><i class="fa fa-user page_title_icon"></i> حسابي الشخصي
                    <small>تغيير بياناتك الشخصية</small>
                </h3>
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="https://u51657.dhman.io/home">الرئيسية</a>
                            <i class="fa fa-angle-left"></i>
                        </li>
                        <li><a href="https://u51657.dhman.io/129">الإعدادات<i class="fa fa-angle-left"></i></a></li>
                        <li><i class="fa fa-user "></i> حسابي الشخصي</li>
                    </ul>
                </div>


                @include('include.message')
                {!! Form::open(['route'=>['update.info',Auth()->id()],'method'=>'post']) !!}
                <div class="col-md-6">
                    <div class="portlet box blue-hoki no_print">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-info"></i> البيانات العامة
                            </div>
                            <div class="tools">
                                <a href="javascript:" class="collapse" data-original-title="" title="">
                                </a>
                                <a href="javascript:" class="remove" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>الأسم الأول</label>
                                    <input type="text" tabindex="1" name="full_name" value="{{Auth()->user()->name}}"
                                           placeholder="" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label>البريد الإلكتروني</label>
                                    <input type="text" tabindex="2" name="email"
                                           value="{{Auth()->user()->email}}" placeholder="" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label>رقم الجوال</label>
                                    <input type="text" tabindex="3" name="mobile"
                                           value="{{Auth()->user()->profile->mobile}}"
                                           placeholder="" class="form-control">
                                    <br clear="both"/>
                                    <input type="hidden" name="section" value="main"/>
                                    <input type="submit" class="btn  blue-hoki f_left" value="حفظ التغييرات  "/>
                                    <br clear="both"/>
                                </div>
                                <br clear="both"/>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="col-md-6">

                    {!! Form::open(['route'=>['update.password',Auth()->id()],'method'=>'post']) !!}
                    <div class="portlet box blue-hoki no_print">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-info"></i>تغيير كلمة المرور
                            </div>
                            <div class="tools">
                                <a href="javascript:" class="collapse" data-original-title="" title="">
                                </a>
                                <a href="javascript:" class="remove" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="form-group">
                                <h4>نصائح عامة لإختيار كلمة المرور آمنة</h4>
                                <ul>
                                    <li>أن تكون أكثر من 6 خانات</li>
                                    <li>أن تحتوي على حروف كبيرة وصغيرة وأرقام وكذلك رموز مثل @#$%</li>
                                    <li>أن تغييرها بشكل مستمر (كل ثلاث أشهر )</li>
                                </ul>
                                <div class="col-md-12">
                                    <label>كلمة المرور الحالية</label>
                                    <input type="password" name="current_password" class="form-control"
                                           placeholder="كلمة المرور الحالية">
                                </div>
                                <div class="col-md-12">
                                    <label>كلمة المرور</label>
                                    <input type="password" name="password" class="form-control"
                                           placeholder="كلمة المرور الجديدة">
                                </div>
                                <div class="col-md-12">
                                    <label>تأكيد كلمة المرور</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                           placeholder="تأكيد كلمة المرور الجديدة">
                                    <br clear="both"/>
                                    <input type="hidden" name="section" value="password"/>
                                    <input type="submit" class="btn  blue-hoki f_left"
                                           value="تغيير كلمة المرور"/>
                                    <br clear="both"/>
                                </div>
                                <br clear="both"/>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <br clear="both"/>
    </div>

@endsection