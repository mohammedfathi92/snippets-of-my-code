@extends('voyager::master')

@section('content')

    <div class="page-container">

        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="col-md-12">

                


                    <div class="portlet box blue-hoki">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-search"></i>بيانات المستثمر
                            </div>
                            <div class="tools">
                                <a href="javascript:" class="collapse" data-original-title="" title="">
                                </a>
                                <a href="javascript:" class="remove" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#info" data-toggle="tab">معلومات عامة</a></li>
                                <li class=""><a href="#sales" data-toggle="tab">العقود</a></li>
                                <li class=""><a href="#balance" data-toggle="tab">الرصيد والحسابات</a></li>
                                <li class=""><a href="#oper" data-toggle="tab">حركة الحساب</a></li>
                                <li class=""><a href="#TheStores" data-toggle="tab">المخزون</a></li>
                                <li class=""><a href="#TheNotes" data-toggle="tab">الملاحظات</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="info">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>المستثمر</label>
                                            <label class="form-control"
                                                   style="background:#eee;">{{ $investor->name  }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>الأسم الرسمي</label>
                                            <label class="form-control"
                                                   style="background:#eee;"> {{$investor->profile->formal_name}} </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>الهوية الوطنية/الإقامة</label>
                                            <label class="form-control"
                                                   style="background:#eee;">{{$investor->profile->national_id}} </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>تاريخ الإصدار</label>
                                            <label class="form-control"
                                                   style="background:#eee;">{{$investor->profile->release_date}} </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>المصدر</label>
                                            <label class="form-control"
                                                   style="background:#eee;">{{$investor->profile->release_place}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>الجنسية</label>
                                            <label class="form-control"
                                                   style="background:#eee;">{{$investor->profile->nationality}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>العنوان</label>
                                            <label class="form-control"
                                                   style="background:#eee;">{{$investor->profile->address}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>رقم الجوال </label>
                                            <input type="phone" disabled class="form-control phone"
                                                   value="{{$investor->profile->mobile}}"
                                                   id="phone1"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>رقم الهاتف </label>
                                            <input type="phone" disabled class="form-control phone"
                                                   value="{{$investor->profile->phone}}"
                                                   id="phone2"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>العمل</label>
                                            <label class="form-control"
                                                   style="background:#eee;">{{$investor->profile->work}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>رقم هاتف العمل</label>
                                            <input type="phone" disabled class="form-control phone"
                                                   value="{{$investor->profile->work_phone}}"
                                                   id="phonework"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>البريد الإلكتروني</label>
                                            <label class="form-control"
                                                   style="background:#eee;">{{$investor->email}}</label>
                                        </div>
                                    </div>
                                    <br clear="both"/>
                                </div>
                                <div class="tab-pane fade" id="sales">
                                    <table style="margin-bottom:0px;" id="SalesTable"
                                           class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th id="id">م</th>
                                            <th id="full_name_person">العميل</th>
                                            <th id="type">العقد</th>
                                            <th id="status">حالة العقد</th>
                                            <th id="price">قيمة العقد</th>
                                            <th id="date">التاريخ</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane fade " id="balance">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th>الحساب</th>
                                            <th>الرصيد</th>
                                        </tr>
                                        <tr>
                                            <td>الصندوق</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <th style="text-align:left;">الإجمالي</th>
                                            <th>0.00</th>
                                        </tr>
                                    </table>
                                </div>

                                <div class="tab-pane fade  " id="oper">
                                    <table style="margin-bottom:0px;" id="PaymentsTables"
                                           class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th id="id">م</th>
                                            <th id="date_g_operation">التاريخ</th>
                                            <th id="type">نوعها</th>
                                            <th id="amount">المبلغ</th>
                                            <th id="bank">الحساب</th>
                                            <th id="statment">البيان</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($investor->financial_transaction as $transaction)
                                            <tr>
                                                <td>{{$transaction->id}}</td>
                                                <td>{{$transaction->created_at->toFormattedDateString()}}</td>
                                                <td>{{$transaction->type}}</td>
                                                <td>{{$transaction->price}}</td>
                                                <td>الصندوق</td>
                                                <td>{{$transaction->notes}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade " id="TheStores">
                                    <table id="StoresTable" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th id="name">السلعة</th>
                                            <th id="quantity">الكمية</th>
                                            <th id="price">سعر شراء الوحدة</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($investor->product_payments as $product_payment)
                                        <tr>
                                            <td>{{$product_payment->product->name}}</td>
                                            <td>{{$product_payment->quantity}}</td>
                                            <td>{{$product_payment->price}}</td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade " id="TheNotes">
                                    <div id="notes"></div>
                                    <table id="NotesTable" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th id="note">الملاحظة</th>
                                            <th id="name">الكاتب</th>
                                            <th id="time">الوقت</th>
                                            <th id="parent">الإجراء</th>
                                        </tr>
                                        </thead>
                                    </table>
                                    <center id="loader" style="display:none;margin-top:50px;">
                                        <i class="fa fa-spinner fa-spin fa-5x"></i><br/>
                                        جاري التحميل
                                    </center>
                                    <br clear="both"/>
                                    <div class="f_left">
                                        <a href="javascript::void(0);" id="showNote"
                                           onclick="$('#addNote').toggle();$('#hideNote').show();$(this).hide();"
                                           class=" btn-md f_left btn btn-fit-height   blue-hoki "><i
                                                    class="fa fa-plus "></i> ملاحظة جديدة</a>
                                        <a href="javascript::void(0);"
                                           onclick="$('#showNote').show();$(this).hide();$('#addNote').toggle();"
                                           id="hideNote"
                                           style="display:none;color:red;font-weight:bold;font-size:18px;text-decoration:none;">X</a>
                                    </div>
                                    <div id="addNote" style="display:none;">
                                        <div class="form-group">
                                            <label>إضافة ملاحظة</label>
                                            <textarea id="notebody" class="form-control required"
                                                      placeholder="لإضافة ملاحظة لهذا العقد."></textarea>
                                        </div>
                                        <button type="button" id="note_submit"
                                                onclick="$('#loader').show();SaveNote('https://u51657.dhman.io/127/127',$('#notebody').val(),'p','50953','zUN7gq4O2ED7dXbn2LJEBvLx6G7J7mvYC3NLWfcw');setTimeout(function() {$('#NotesTable').DataTable().ajax.reload();},1);"
                                                class="  btn-md f_left btn btn-fit-height   blue-hoki  ">حفظ الملاحظة
                                        </button>
                                    </div>
                                    <br clear="both"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br clear="both"/>

                </div>
                <br clear="both"/>
            </div>
        </div>
    </div>

@endsection


