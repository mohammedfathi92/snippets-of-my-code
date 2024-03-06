@extends('voyager::master')
@section('page_title', __('title.contract.finish'))

@section('page_header')
    <h1><i class="fa fa-list-ul"></i> <span> مخالصة العقد </span> <a href="{{route('contracts.create',1)}}"
                                                                     class="btn btn-danger my_btn_left"
                                                                     onclick="$('#add_panal').toggle();">
            <i class="fa fa-plus-circle"> اضافه عقد تقسيط </i>
        </a></h1>
@endsection
@section('content')
    <section class="content">
        @include('include.message')
        <div class="row">
            <div class="col-md-12">
                {{Form::open(['route'=>['contracts.finished_store',$contract->id]])}}
                <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-credit-card"></i> مخالصة العقد
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title="">
                            </a>
                            <a href="javascript:;" class="remove" data-original-title="" title="">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body ">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label> العميل</label>
                                <label class="form-control" style="background:#eee;">{{$contract->client->name}} <a
                                            href="{{route('clients.show',$contract->client->id)}}"><i
                                                class="fa fa-link"></i></a></label>
                            </div>
                            <div class="col-md-6">
                                <label> المستثمر</label>
                                <label class="form-control" style="background:#eee;">{{$contract->investor->name}}
                                    <a href="{{route('investors.show',$contract->investor->id)}}"><i
                                                class="fa fa-link"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>المتبقي</label>
                                <input disabled="" type="number" tabindex="1" name="rest" value="{{$contract_remain}}"
                                       class="form-control">
                                <input type="hidden" id="remain" value="{{$contract_remain}}">
                            </div>
                            <div class="col-md-3">
                                <label>المبلغ المراد سداده</label>
                                <input name="amount" type="number" id="amount" onkeyup="countDiscount(this.value);"
                                       value="{{$contract_remain}}"
                                       placeholder="" class="form-control {{ $errors->has('amount') ? 'has-error' : '' }}">
                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <label>الخصم</label>
                                <input readonly="" type="number" name="discount" id="discount" value="0" placeholder=""
                                       class="form-control {{ $errors->has('discount') ? 'has-error' : '' }}">
                                @if ($errors->has('discount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('discount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>الحساب</label>
                                <select class="form-control select2" style="border:1px solid #aaa;" tabindex="2" name="account_id">
                                    <option value="" selected> --اختر الحساب -- </option>
                                    @foreach($investor_account as $account)
                                    <option value="{{$account->id}}" >{{$account->account_name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>الوصف: </label>
                                <textarea name="note" id="statment" class="form-control"
                                          placeholder="أكتب إذا كانت لديك ملاحظة إضافية ، أتركه فارغاً في حالة عدم وجود ملاحطة!"></textarea>
                            </div>
                        </div>
                        <br clear="both"/>
                    </div>
                </div>
            </div>
            <br clear="both"/>
            <div class="col-md-12 ">
                <button type="submit" class="btn  blue-hoki btn-lg btn-lg f_left">
                    <span>  مخالصة العقد</span>
                </button>
            </div>
            <br clear="both"/>
            {{Form::close()}}
        </div>


        </div> <br clear="both"/>

    </section>

@endsection


@section('javascript')
    <script type="text/javascript">
        function countDiscount(value) {
            var remain = $('#remain').val();
            var discount = Number(remain) - Number(value);

            $('#discount').val(discount);
        }

    </script>
@endsection