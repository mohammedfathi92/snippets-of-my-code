@extends('layouts.crud.create_edit')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('order_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

          @include('ERP::orders.components.steps', ['order' => $order, 'current_step' => 2])

          {!! Form::model($order, ['url' => url($resource_url.'/'.$order->hashed_id.'/guests'),'method'=>'POST','files'=>true,'class'=>'ajax-form']) !!}


            @component('components.box',['box_title'=>trans('ERP::attributes.order.tabs.guests')])

            <div class="table-responsive">
        <table id="values-table" width="100%" class="table table-striped">
            <thead>
            <tr>
                <th>@lang('ERP::attributes.order.name')</th>
                <th>@lang('ERP::attributes.order.gender')</th>
                <th>@lang('ERP::attributes.order.age_level')</th>
                <th>@lang('ERP::attributes.main.birth_date')</th>
                <th>@lang('ERP::attributes.order.passport')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            	<tr></tr>
            @php
            $name = 'guests';
           
            @endphp
                 
            	@if($guests->count())
            @foreach($guests as $row)
            @php
            $mainLoop = $loop->index;
           
            @endphp
            
                <tr id="tr_{{ $loop->index }}" data-index="{{ $loop->index }}">

                    <td>
                        <div class="form-group">
                            <input name="{{ $name."[$loop->index][name]" }}" type="text"
                                   value="{{ $row->name }}" class="form-control"/>
                        </div>
                    </td>
                    <td>
              <div class="form-group required-field">
              <select class="form-control with-select2" name="{{ $name."[$loop->index][gender]" }}">

              @foreach(__('ERP::attributes.main.male_female') as $key => $value)
              <option value="{{$key}}" @if($key == $row->gender) selected="" @endif>{{$value}}</option>
              @endforeach
            </select>


                 </div>
                    </td>
                    <td>

            <div class="form-group required-field">
              <select class="form-control with-select2" name="{{ $name."[$loop->index][age_level]" }}">
              @foreach(__('ERP::attributes.main.age_level_options') as $key => $value)
              <option value="{{$key}}" @if($key == $row->age_level) selected="" @endif>{{$value}}</option>
              @endforeach
              </select>

            </div>

                    </td>
                                                      <td>
                        <div class="form-group">
                            <input name="{{ $name."[$loop->index][birth_date]" }}" type="text"
                                   value="{{ $row->birth_date }}" class="form-control datepicker"/>
                        </div>

                    </td>  

                                  <td>
                        <div class="form-group">
                            <input name="{{ $name."[$loop->index][passport_num]" }}" type="text"
                                   value="{{ $row->passport_num }}" class="form-control"/>
                        </div>

                    </td>      

                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;"
                                data-index="{{ $loop->index }}"><i
                                    class="fa fa-remove"></i>
                        </button>
                    </td>
                </tr>

            @endforeach
            @endif
            </tbody>
        </table>
    </div>
                    <div class="row">
                    <div class="col-md-12">

        <button type="button" class="btn btn-success btn-sm add-new-value"><i
                class="fa fa-plus"></i> {{__('ERP::attributes.order.add_new_guest')}}
    </button>

</div>
</div>

            @endcomponent

                

                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::formButtons() !!}
                    </div>
                </div>
               

            

     {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('js')

<script type="text/javascript">


            $('body').on('click', '.add-new-value', function () {
                var index = $('#values-table tr:last').data('index');
                if (isNaN(index)) {
                    index = 0;
                } else {
                    index++;
                }
              $('#values-table tr:last').after('<tr id="tr_' + index + '" data-index="' + index + '"><td><div class="form-group">' +
                    '<input name="{{ $name }}[' + index + '][name]" type="text"' +
                    'value="" class="form-control"/></div></td><td>'+ '<div class="form-group required-field"><select class="form-control with-select2" name="{{ $name }}[' + index + '][gender]">@foreach(__('ERP::attributes.main.male_female') as $key => $value)'+'<option value="{{$key}}">{{$value}}</option>@endforeach</select></div></td><td><div class="form-group required-field"><select class="form-control with-select2" name="{{ $name }}[' + index + '][age_level]">@foreach(__('ERP::attributes.main.age_level_options') as $key => $value)'+'<option value="{{$key}}">{{$value}}</option>@endforeach</select></div></td><td>'+ '<div class="form-group required-field"><input name="{{ $name }}[' + index + '][birth_date]" type="text"' +
                    'value="" class="form-control datepicker-2"/></div>'+'</td><td><div class="form-group">' +
                    '<input name="{{ $name }}[' + index + '][passport_num]" type="text"' +
                    'value="" class="form-control"/></div></td>' +
                    '<td><div class="form-group"><button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;" data-index="' + index + '">'
                    + '<i class="fa fa-remove"></i></button></div></td>' +
                    '</tr>');
                            $('.with-select2').select2();

                     $('.datepicker-2').datetimepicker({
                         format: 'YYYY-MM-DD',
                      });
            });


            $(document).on('click', '.remove-value', function () {
                var index = $(this).data('index');
                $("#tr_" + index).remove();
            });
       
  

</script>

@endsection