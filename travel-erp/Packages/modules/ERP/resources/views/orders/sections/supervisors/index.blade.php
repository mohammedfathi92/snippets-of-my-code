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

          {!! Form::model($order, ['url' => url($resource_url.'/'.$order->hashed_id.'/supervisors'),'method'=>'POST','files'=>true,'class'=>'ajax-form']) !!}


            @component('components.box',['box_title'=>trans('ERP::attributes.order.tabs.supervisors')])

            <div class="table-responsive">
        <table id="values-table" width="100%" class="table table-striped">
            <thead>
            <tr>
                <th>@lang('ERP::attributes.order.supervisors.staff')</th>
                <th>@lang('ERP::attributes.order.supervisors.permissions')</th>
                <th>@lang('ERP::attributes.order.supervisors.role')</th>

                <th></th>
            </tr>
            </thead>
            <tbody>
            	<tr></tr>
            @php
            $name = 'supervisors';
           
            @endphp
                 
            	@if($supervisors->count())
            @foreach($supervisors as $row)
            @php
            $mainLoop = $loop->index;
           
            @endphp
            
                <tr id="tr_{{ $loop->index }}" data-index="{{ $loop->index }}">

                    <td>
              <div class="form-group required-field">
              <select class="form-control with-select2" name="{{ $name."[$loop->index][user_id]" }}">

              @foreach(\ERP::getStaffList() as $key => $value)
              <option value="{{$key}}" @if($row->user_id == $key) selected="" @endif>{{$value}}</option>
              @endforeach
            </select>


                 </div>
                    </td>
                    <td>
                        @php
                        $selected_permissions = json_decode($row->permissions);
                        $selected_roles = json_decode($row->roles);
                        @endphp
              <div class="form-group required-field">
              <select class="form-control with-select2" name="{{ $name."[$loop->index][permissions][]" }}" multiple="multiple">

              @foreach(__('ERP::attributes.order.supervisors.permissions_list') as $key => $value)
              <option value="{{$key}}" @if(in_array($key,$selected_permissions)) selected="" @endif>{{$value}}</option>
              @endforeach
            </select>


                 </div>
                    </td>
                    <td>

            <div class="form-group required-field">
              <select class="form-control with-select2" name="{{ $name."[$loop->index][roles][]" }}">
              @foreach(__('ERP::attributes.order.supervisors.roles_list') as $key => $value)
              <option value="{{$key}}" @if(in_array($key,$selected_roles)) selected="" @endif>{{$value}}</option>
              @endforeach
              </select>

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
                class="fa fa-plus"></i> {{__('ERP::attributes.order.supervisors.add_new_supervisor')}}
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
              $('#values-table tr:last').after('<tr id="tr_' + index + '" data-index="' + index + '">'+ '<td><div class="form-group required-field"><select class="form-control with-select2" name="{{ $name }}[' + index + '][user_id]">@foreach(\ERP::getStaffList() as $key => $value)'+'<option value="{{$key}}">{{$value}}</option>@endforeach</select></div></td><td><div class="form-group required-field"><select class="form-control with-select2" multiple="multiple" name="{{ $name }}[' + index + '][permissions][]">@foreach(__('ERP::attributes.order.supervisors.permissions_list') as $key => $value)'+'<option value="{{$key}}">{{$value}}</option>@endforeach</select></div></td><td>'+ '<div class="form-group required-field"><select class="form-control with-select2" name="{{ $name }}[' + index + '][roles][]">@foreach(__('ERP::attributes.order.supervisors.roles_list') as $key => $value)'+'<option value="{{$key}}">{{$value}}</option>@endforeach</select></div></td>'+
                    '<td><div class="form-group"><button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;" data-index="' + index + '">'
                    + '<i class="fa fa-remove"></i></button></div></td>' +
                    '</tr>');
              $('.with-select2').select2();

            });


            $(document).on('click', '.remove-value', function () {
                var index = $(this).data('index');
                $("#tr_" + index).remove();
            });
       
  

</script>

@endsection