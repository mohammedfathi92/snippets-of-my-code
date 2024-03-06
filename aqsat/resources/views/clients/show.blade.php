@extends('voyager::master')

@section('page_title', __('title.client.show'))

@section('content')

@section('page_header')
    <h1><i class="fa fa-money"></i>بيانات العميل</h1>
@endsection


<section class="content">
    @include('include.message')
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-user"></i>{{$client->name}}</h3>
                </div>
                <div class="box-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#info" data-toggle="tab">معلومات عامة</a></li>
                        <li class=""><a href="#sales" data-toggle="tab">العقود</a></li>
                        <li class=""><a href="#oper" data-toggle="tab">المعاملات المالية</a></li>
                        <li class=""><a href="#bank_accounts" data-toggle="tab">حسابات العميل البنكية</a></li>
                        <li class=""><a href="#TheNotes" data-toggle="tab">الملاحظات</a></li>
                    </ul>
                    <div class="tab-content">
                        {{--client_info--}}
                        <div class="tab-pane fade active in" id="info">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>اسم العميل</label>
                                    <label class="form-control" style="background:#eee;">{{$client->name}}</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>الهوية الوطنية / الإقامة</label>
                                    <label class="form-control" style="background:#eee;">
                                        {{$client->profile->national_id}}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>تاريخ الإصدار</label>
                                    <label class="form-control"
                                           style="background:#eee;">{{$client->profile->release_date}} </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>المصدر</label>
                                    <label class="form-control"
                                           style="background:#eee;">{{$client->profile->release_place}}</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>رقم الجوال</label>
                                    <input type="phone" disabled class="form-control phone"
                                           value="{{$client->profile->mobile}}" id="phone1"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>رقم الهاتف</label>
                                    <input type="phone" disabled class="form-control phone"
                                           value="{{$client->profile->phone}}" id="phone2"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>العنوان</label>
                                    <label class="form-control"
                                           style="background:#eee;">{{$client->profile->address}}</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>العمل</label>
                                    <label class="form-control"
                                           style="background:#eee;">{{$client->profile->work}}</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                        <span> رقم هاتف العمل</span>
                                    </label>
                                    <input type="phone" disabled class="form-control phone" id="phonework"
                                           value="{{$client->profile->work_phone}}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الجنسية</label>
                                    <label class="form-control"
                                           style="background:#eee;">{{$client->profile->nationality}}</label>
                                </div>
                            </div>
                            {{--<div class="col-md-4">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>البريد الإلكتروني</label>--}}
                                    {{--<label class="form-control" style="background:#eee;"> {{$client->email}} </label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الجنس</label>
                                    <label class="form-control" style="background:#eee;">
                                        {{$client->profile->gender ? "ذكر":"انثى"}}
                                    </label>
                                </div>
                            </div>
                            {{--<div class="col-md-12">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>ملاحظات إضافية</label>--}}
                                    {{--<textarea disabled="disabled" tabindex="14" name="note"--}}
                                              {{--placeholder="أكتب أي ملاحظة إضافية" class="form-control"--}}
                                              {{--style="background:#eee;"> {{$client->profile->notes}} </textarea>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <br clear="both"/>
                        </div>
                        {{--client_contracts--}}
                        <div class="tab-pane fade" id="sales">
                            <div class="table-scrollable">
                                <table style="margin-bottom:0px;" id="SalesTable"
                                       class="table table-striped table-bordered table-hover aqTable">
                                    <thead>
                                    <tr>
                                        <th id="id">#</th>
                                        <th id="seller">المستثمر</th>
                                        <th id="type">العقد</th>
                                        <th id="status">حالة العقد</th>
                                        <th id="price">قيمة العقد</th>
                                        <th id="date">التاريخ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($client->client_contracts as $contract)
                                        <tr>
                                            <td>{{$contract->id}}</td>
                                            <td>{{$contract->investor->name}}</td>
                                            <td>{{$contract->contract_type == 1? 'تقسيط':'اجل'}}</td>
                                            <td>
                                                @if($contract->kind == null)
                                                    <span> سارى </span>
                                                @elseif($contract->kind == 2)
                                                    <span> خالص </span>
                                                @elseif($contract->kind == 3)
                                                    <span> متعثر </span>
                                                @elseif($contract->kind == 4)
                                                    <span> متاخر بالسداد </span>
                                                @endif
                                            </td>
                                            <td>{{$contract->contract_value + $contract->first_payment}}</td>
                                            <td>{{date('Y-m-d',strtotime($contract->contract_date))}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{--client_financial--}}
                        <div class="tab-pane fade  " id="oper">
                            <div class="table-scrollable">
                                <table style="margin-bottom:0px;" id="PaymentsTables"
                                       class="table table-striped table-bordered table-hover aqTable">
                                    <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>البيان</th>
                                        <th>المبلغ</th>
                                        <th>التاريخ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($client->client_contracts as $contract)
                                        @foreach($contract->financial_transactions as $transaction)
                                            <tr>
                                                <td>{{$transaction->id}}</td>
                                                <td>{{$transaction->notes}}</td>
                                                <td>{{$transaction->price}}</td>
                                                <td>{{$transaction->created_at}}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- clients_accounts --}}
                        <div class="tab-pane fade  " id="bank_accounts">

                            {!! Form::open(['route'=>'bank_accounts.store']) !!}
                            <div class="col-md-12" id="addBank" style="display:none">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">العميل/الحساب الإستثماري</label>
                                        <select class="form-control select2" style="border:1px solid #aaa;"
                                                name="user_id">
                                            <option value="">--أختر العميل --</option>
                                            @foreach($clients as $client)
                                                <option value="{{$client->id}}">{{$client->name}}</option>
                                            @endforeach
                                            <input type="hidden" name="type" value="client">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>اسم الحساب <i class="required">*</i></label>
                                        <input type="text" name="account_name" class="form-control"
                                               autocomplete="off"
                                               placeholder="الصندوق/الكاش/حساب الراجحي/الأهلي /الجزيرة"
                                               value="{{old('account_name')}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label>اسم صاحب الحساب <i class="required">*</i></label>
                                        <input type="text" name="user_name" class="form-control" autocomplete="off"
                                               placeholder="المالك للحساب"
                                               value="{{old('user_name')}}">
                                    </div>
                                    <div class="col-md-12">
                                        <label>رقم الحساب</label>
                                        <input type="number" name="account_number" class="form-control" min="0"
                                               autocomplete="off" placeholder="رقم الحساب "
                                               value="{{old('account_number')}}">
                                    </div>
                                    <br clear="both">
                                </div>

                                <div class="f_left">
                                    <input type="submit" class="btn blue-hoki" value="إضافة الحساب"/>
                                </div>
                            </div>
                            {!! Form::close() !!}

                            <div class="f_left">
                                <a href="javascript::void(0);" id="showBank"
                                   onclick="$('#addBank').toggle();$('#hideBank').show();$(this).hide();"
                                   class=" btn-md f_left btn btn-fit-height   blue-hoki "><i
                                            class="fa fa-plus "></i> حساب جديد</a>
                                <a href="javascript::void(0);"
                                   onclick="$('#showBank').show();$(this).hide();$('#addBank').toggle();"
                                   id="hideBank"
                                   style="display:none;color:red;font-weight:bold;font-size:18px;text-decoration:none;">X</a>
                            </div>
                            <br clear="both"/>

                            <div class="box box-primary box-solid">
                                <h3 class="box-title"><i class="fa fa-list-alt"></i> قائمه الحسابات البنكية</h3>
                                <div class="box-body">
                                    <table id="aqTable" class="table table-bordered table-hover display"
                                           cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th id="name">الحساب</th>
                                            <th id="name">رقم الحساب</th>
                                            <th id="name">اسم صاحب الحساب</th>
                                            <th id="name">النوع</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($client_accounts as $account)
                                            <tr>
                                                <td>
                                                    @if($account->status == 2)
                                                        <li style="color: #a93f30;" class="fa fa-times-circle-o"></li>
                                                    @else
                                                        <li style="color: green;" class="fa fa-check-circle"></li>
                                                    @endif
                                                    <a href="#" data-toggle="modal"
                                                       data-target="#exampleModal" onclick="EditAccount({{$account->id}});"
                                                       data-whatever="@mdo">{{$account->account_name}}
                                                    </a>
                                                </td>
                                                <td>{{$account->account_number}}</td>
                                                <td>{{$account->user_name}}</td>
                                                <td>{{$account->user_type}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="modal fade" style="z-index: 999999;" id="exampleModal" tabindex="-1"
                                 role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" id="new_data">
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{--client_notes--}}
                        <div class="tab-pane fade " id="TheNotes">

                            {!! Form::open(['route'=>['clients.note_store',$client->id]]) !!}
                            <div class="form-group">
                                <label>إضافة ملاحظة</label>
                                <textarea id="notebody" class="form-control required" name="note"
                                          placeholder="لإضافة ملاحظة لهذا العقد."></textarea>
                            </div>
                            <div style="text-align: center;">
                                <input type="submit" style="margin-bottom: 20px;"
                                       class="tn-md f_left btn btn-fit-height blue-hokib" value="حفظ الملاحظة">
                            </div>
                            {!! Form::close() !!}

                            <table id="NotesTable" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th id="note">الملاحظة</th>
                                    <th id="name">الكاتب</th>
                                    <th id="time">الوقت</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($client_notes as $note)
                                    <tr>
                                        <td>{{$note->note}}</td>
                                        <td>{{$note->user->name}}</td>
                                        <td>{{$note->created_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <br clear="both"/>
                        </div>
                    </div>

                </div>
                <br clear="both"/>
            </div>
        </div>
</section>

@endsection

@section('javascript')
    <script type="text/javascript">

        function EditAccount(id) {
            $.ajax({
                type: 'post',
                url: '/admin/bank_accounts/ajax_edit_account',
                data: {id: id},
                success: function (data) {
                    $('#new_data').html(data);
                }
            });
        }

    </script>
    <script data-cfasync="false" src="/cdn-cgi/scripts/d07b1474/cloudflare-static/email-decode.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            $('#phone1').intlTelInput({nationalMode: true, separateDialCode: true});
            $('#phone2').intlTelInput({nationalMode: true, separateDialCode: true});

            $('#phonework').intlTelInput({nationalMode: true, separateDialCode: true});


            $.extend(true, $.fn.DataTable.TableTools.classes, {
                "buttons": {
                    "normal": "btn  default",
                },
                "collection": {
                    "container": ""
                }
            });

            $('#SalesTable').DataTable({
                "dom": "<'row'><'row'<'col-md-4 col-sm-12'l><'col-md-4 col-sm-12'f><'col-md-4 col-sm-12'T>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable


                "tableTools": {
                    "aButtons": [
                        {
                            "sExtends": "print",
                            "sButtonText": "طباعة",
                            "sInfo": 'لطباعة أضغط على CTRL+P و للإلغاء إضغط على ESC ',

                        }

                    ]
                },

                aaSorting: [[0, 'desc']],

                processing: true,
                serverSide: true,

                "pageLength": 25,
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'الكل']],

                "ajax": "https://u51657.dhman.io/121/610/50767/sales",
                columns: [
                    {data: 'id', name: 'id', searchable: false},
                    {data: 'seller', name: 'seller', searchable: true},
                    {data: 'type', name: 'type', searchable: false},
                    {data: 'status', name: 'status', searchable: false},
                    {data: 'price', name: 'price', searchable: false},
                    {data: 'date', name: 'date', searchable: false},
                ],
                "oLanguage": {
                    "sUrl": "https://u51657.dhman.io/assets/global/scripts/datatables.ar.txt"
                },


            });
            $('#PaymentsTables').DataTable({


                "dom": "<'row'><'row'<'col-md-4 col-sm-12'l><'col-md-4 col-sm-12'f><'col-md-4 col-sm-12'T>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable


                "tableTools": {
                    "aButtons": [
                        {
                            "sExtends": "print",
                            "sButtonText": "طباعة",
                            "sInfo": 'لطباعة أضغط على CTRL+P و للإلغاء إضغط على ESC ',

                        }

                    ]
                },

                aaSorting: [[0, 'desc']],

                processing: true,
                serverSide: true,

                "pageLength": 25,
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'الكل']],

                "ajax": "https://u51657.dhman.io/121/610/50767/payments",

                "oLanguage": {
                    "sUrl": "https://u51657.dhman.io/assets/global/scripts/datatables.ar.txt"
                },

                columns: [
                    {data: 'id_operation_com', name: 'id_operation_com', searchable: false},
                    {data: 'note_operation', name: 'note_operation', searchable: false},
                    {data: 'money_operation', name: 'money_operation', searchable: false},

                    {data: 'date', name: 'date', searchable: false},

                ],

            });
            $('#BankAccounts').DataTable({
                "dom": '<"col-md-6"l>r<"col-md-6"> tpi',
                "tableTools": {
                    "aButtons": [
                        {
                            "sExtends": "print",
                            "sButtonText": "طباعة",
                            "sInfo": 'لطباعة أضغط على CTRL+P و للإلغاء إضغط على ESC ',

                        }

                    ]
                },
                columns: [
                    {data: 'name', name: 'name', searchable: false}
                ],


                processing: true,
                serverSide: true,

                "pageLength": 25,
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'الكل']],

                "ajax": "https://u51657.dhman.io/121/610/50767/bankaccounts",

                "oLanguage": {
                    "sUrl": "https://u51657.dhman.io/assets/global/scripts/datatables.ar.txt"
                },


            });
            var NotesTable = $('#NotesTable').DataTable({
                "dom": '<"col-md-6"l>r<"col-md-6"f> tpi',

                aaSorting: [[0, 'desc']],
                processing: true,
                serverSide: true,
                "pageLength": 25,
                "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
                columns: [
                    {data: 'note', name: 'note'},
                    {data: 'name', name: 'name', searchable: false},
                    {data: 'time', name: 'time', searchable: false},
                    {data: 'parent', name: 'parent', orderable: false, searchable: false}
                ],
                "ajax": "https://u51657.dhman.io/121/610/50767/notes",

                "oLanguage": {
                    "sUrl": "https://u51657.dhman.io/assets/global/scripts/datatables.ar.txt"
                }//language


            });


            var Sms_Table = $('#Sms_Table').DataTable({
                "dom": '<"col-md-6"l>r<"col-md-6"f> tpi',

                aaSorting: [[0, 'desc']],
                processing: true,
                serverSide: true,
                "pageLength": 25,
                "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],

                "ajax": "https://u51657.dhman.io/121/610/50767/SMS",
                columns: [
                    {data: 'message', name: 'message', searchable: false},
                    {data: 'date', name: 'date', searchable: false},
                ],
                "oLanguage": {
                    "sUrl": "https://u51657.dhman.io/assets/global/scripts/datatables.ar.txt"
                },


            });

        });


    </script>
    <script type="text/javascript">
        $('#RemoveCustomer').click(function () {
            bootbox.confirm({
                message: "هل أنت متأكد من عملية الحذف؟",

                buttons: {
                    confirm: {
                        label: "تأكيد الحذف",
                        className: "btn-danger",
                    },
                    cancel: {
                        label: "إلغاء العملية",
                        className: "btn-red",

                    },

                },
                callback: function (result) {
                    if (result === false) {

                    } else {
                        window.location.href = 'https://u51657.dhman.io/121/410/50767';
                    }
                }
            });

        });
    </script>
@endsection