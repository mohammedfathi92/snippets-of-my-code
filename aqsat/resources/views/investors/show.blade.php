@extends('voyager::master')

@section('page_title', __('title.investor.show'))

@section('page_header')
    <h1><i class="fa fa-eye"></i> بيانات المستثمر </h1>
@endsection

@section('content')


    <!-- Main content -->
    <section class="content">

        @include('include.message')
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        @if($investor->avatar)
                            <img class="profile-user-img img-responsive img-circle" src="/images/avatar.png"
                                 alt="{{ $investor->name.'-avatar'  }}">
                        @else
                            <img class="profile-user-img img-responsive img-circle" src="/images/avatar.png"
                                 alt="{{ $investor->name. '-avatar'  }}">
                        @endif

                        <h3 class="profile-username text-center">{{ $investor->name  }}</h3>

                        <p class="text-muted text-center">{{$investor->profile->work}}</p>


                        <a href="{{route('investors.edit', ['id' => $investor->id])}}"
                           class="btn btn-primary btn-block"><b>تعديل بيانات الحساب</b></a>
                        @if( $investor->id != 1)
                            <a href="{{route('investors.delete', ['id' => $investor->id])}}"
                               class="btn btn-danger btn-block"><b>حذف حساب المستخدم</b></a>
                        @endif
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


            </div>
            <!-- /.col -->
            <div class="col-md-9">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#info" data-toggle="tab">معلومات عامة</a></li>
                        <li class=""><a href="#sales" data-toggle="tab">العقود</a></li>
                        <li class=""><a href="#premium_late_pay" data-toggle="tab">العملاء والملاحظات</a></li>
                        <li class=""><a href="#balance" data-toggle="tab">الرصيد والحسابات</a></li>
                        <li class=""><a href="#oper" data-toggle="tab">حركة الحساب</a></li>
                        <li class=""><a href="#TheStores" data-toggle="tab">المخزون</a></li>
                        <li class=""><a href="#TheNotes" data-toggle="tab">الملاحظات</a></li>
                    </ul>

                    <div class="tab-content">
                        {{--investor_info--}}
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
                        {{--investor_contracts--}}
                        <div class="tab-pane fade " id="sales">
                            <table style="margin-bottom:0px;" id="SalesTable"
                                   class="table table-striped table-bordered table-hover aqTable">
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
                                <tbody>
                                @foreach($investor_contracts as $contract)
                                    <tr>
                                        <td>{{$contract->contract_num}}</td>
                                        <td>{{$contract->client->name}}</td>
                                        <td>{{$contract->contract_type == 1?'تقسيط':'اجل'}}</td>
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
                        {{--investor_premium_late_pay--}}
                        <div class="tab-pane fade" id="premium_late_pay">
                            <table style="margin-bottom:0px;" id="aqTable"
                                   class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th> م</th>
                                    <th>العميل</th>
                                    <th> الاقساط المتاخره</th>
                                    <th> حالة اخر مكالمة</th>
                                    <th> تاريخ اخر مكالمة</th>
                                    <th> عرض الملاحظات</th>
                                </tr>
                                </thead>
                            <tbody>
@foreach($users->get() as  $inc=>$user)

                                        @php
                                            $num = 0;
                                           $lateContracts =  $user->client_contracts->where('kind', 4)->where('investor_id', $investor->id);
                                        @endphp
                                        @foreach($lateContracts as $contract)
                                            @php
                                                $num += $contract->contract_premium->where('status',3)->count();
                                            @endphp

                                        @endforeach

                                        @if($num != 0)
                                            <tr>
                                                <td>{{$user->id}}</td>
                                                <td>{{$user->name}}</td>
                                           {{--  <td>

                                                    @php
                                    $lContractNum = [];
                                         foreach ($lateContracts as $lContract) {
                                         $lContractNum[] = "<a target='_blank' href=".route('contracts.show',$lContract->id)."> #".$lContract->contract_num."</a>";
                                                                  }
                                           @endphp
                                              {!! implode(",",$lContractNum) !!}
                                                </td> --}}
                                                <td>{{$num}}</td>
                                            @php
                                                $last_call = $user->collections()->orderBy('created_at', 'decs')->first()
                                            @endphp
                                            <td>
                                                @if($last_call)
                                                    @if($last_call->call_status == 1)
                                                        <span>لم يتم الرد</span>
                                                    @elseif($last_call->call_status == 2)
                                                        <span>مغلق الجوال</span>
                                                    @elseif($last_call->call_status == 3)
                                                        <span>مؤجل</span>
                                                    @elseif($last_call->call_status == 4)
                                                        <span>تم الرد</span>
                                                    @elseif($last_call->call_status == 5)
                                                        <span>اخرى</span>
                                                    @endif
                                                @else
                                                    - - -
                                                @endif
                                            </td>
                                            <td>
                                                @if($last_call)
                                                    {{ date('Y-m-d',strtotime($last_call->created_at))}},
                                                    {{$last_call->created_at->diffForHumans()}}
                                                @else
                                                    - - -
                                                @endif
                                            </td>
                                            <td>
                                       <div class="row" >
                                                    <div class="btn-group">
                  <button type="button" class="btn btn-info">اختر رقم العقد</button>
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                  @foreach ($lateContracts as $lContract) 
                    <li><a href="{{ route('collections.late_client_premiums', ['contract_id'=> $lContract->id, 'user_id' => $lContract->client_id]) }}" style="text-align:right; text-decoration: none;" target="_blank">رقم {{ $lContract->contract_num }} </a></li>
                     
    
                    @endforeach
                  </ul>
                </div>
                <div>
                                               
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach






                                {{--@foreach($investor_contracts as $contract)--}}
                                    {{--@foreach($contract->contract_premium->where('status',3) as $premium)--}}
                                        {{--<tr>--}}
                                            {{--<td>{{$premium->id}}</td>--}}
                                            {{--<td>{{$premium->contract->client->name}}</td>--}}
                                            {{--<td>{{$contract->id}}</td>--}}
                                            {{--<td>{{\Carbon\Carbon::parse($premium->date_type_mi)->format('Y-m-d') }}</td>--}}
                                            {{--<td>{{$premium->amount}}</td>--}}
                                            {{--<td>{{$premium->payment}}</td>--}}
                                            {{--<td>{{$premium->call_status == 1? 'مؤجل' : 'غير مؤجل'}}</td>--}}
                                        {{--</tr>--}}
                                    {{--@endforeach--}}
                                {{--@endforeach--}}
                                </tbody>
                            </table>
                        </div>
                        {{--investor_accounts--}}
                        <div class="tab-pane fade " id="balance">
                            <table class="table table-striped table-bordered table-hover">

                                <thead>
                                <tr>
                                    <th>الحساب</th>
                                    <th>الرصيد</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($investor_accounts as $account)
                                    <tr>
                                        <td>{{$account->account_name}}</td>
                                        <td>{{$account->account_value}}</td>
                                    </tr>
                                @endforeach
                                </tbody>


                                <tr>
                                    <th style="text-align:left;">الإجمالي</th>
                                    <th>{{$investor_accounts->sum('account_value')}}</th>
                                </tr>
                            </table>
                        </div>
                        {{--investor_financial_accounts--}}
                        <div class="tab-pane fade  " id="oper">
                            <table style="margin-bottom:0px;" id="PaymentsTables"
                                   class="table aqTable table-striped table-bordered table-hover">
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
                                        <td>{{__('main.'.$transaction->type)}}</td>
                                        <td>{{$transaction->price}}</td>
                                        <td>{{$transaction->company_account->account_name}}</td>
                                        <td>{{$transaction->notes}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{--investor_store--}}
                        <div class="tab-pane fade " id="TheStores">
                            <table id="StoresTable" class="table aqTable table-striped table-bordered table-hover">
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
                        {{--investor_notes--}}
                        <div class="tab-pane fade " id="TheNotes">

                            {!! Form::open(['route'=>['investors.note_store',$investor->id]]) !!}
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
                                @foreach($investor_notes as $note)
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
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->

@endsection