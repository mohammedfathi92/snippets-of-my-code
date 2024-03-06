@extends('voyager::master')
@section('page_title', __('title.contract.sponsor_edit'))
@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">

                {!! Form::open(['route'=>['contracts.sponsor_update',$contract->id]]) !!}
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-edit"></i> تعديل الكفلاء للعقد رقم [{{ $contract->id }}]</h3>
                        </div>
                        <div class="box-body ">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>الكفيل الأول</label>
                                        <select name="sponsor_id" class="form-control select2">
                                            <option value="">--  اختر --</option>
                                            @foreach($sponsors as $sponsor)
                                                <option value="{{$sponsor->id}}" @if($sponsor->id == $contract->sponsor_id) selected @endif>
                                                    {{$sponsor->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>الكفيل الثاني</label>
                                        <select name="sponsor_two_id" class="form-control select2">
                                            <option value="">-- اختر --</option>
                                            @foreach($sponsors as $sponsor)
                                            <option value="{{$sponsor->id}}" @if($sponsor->id == $contract->sponsor_two_id) selected @endif>
                                                {{$sponsor->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br clear="both"/>
                            </div>
                            <div class="col-md-12" style="text-align: center" style="margin-bottom: 20px;">
                                <input type="submit" class="btn blue-hoki btn-lg f_left" style="margin-left:10px;"
                                       value="حفظ التغييرات"/>
                                <a href="{{route('contracts.show',$contract->id)}}" class="btn btn-warning btn-lg f_left">العودة إلى العقد</a>
                            </div>
                            <br clear="both"/>
                        </div>
                    </div>
                    <br clear="both"/>
                {!! Form::close() !!}
        </div>
        <br clear="both"/>
    </div>

@endsection


@section('javascript')


@endsection