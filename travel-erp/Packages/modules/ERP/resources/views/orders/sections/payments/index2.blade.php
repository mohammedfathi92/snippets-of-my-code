@extends('layouts.master')

@section('css')

<style type="text/css">
    .vs-columns-list {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
}

.vs-one-column-list {
  @if(\Language::isRTL())
  float: right;
  @else
  float: left;
  @endif
  display: block;
  /*text-align: center;*/
  padding: 16px;
}


</style>
    <style type="text/css">
        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            vertical-align: middle;
        }
    </style>
@endsection

@section('title', $title)

@section('actions')


 {!! PackagesForm::link('#'.$dataTable->getTableAttributes()['id'].'_columnsListCollapse','<i class="fa fa-gear"></i>&nbsp;'.__('packages-admin::labels.component.btn_settings'),['class'=>'btn btn-default','data'=>['toggle'=>"collapse"]]) !!}

    @if(!empty($dataTable->filters()))
        {!! PackagesForm::link('#'.$dataTable->getTableAttributes()['id'].'_filtersCollapse','<i class="fa fa-filter"></i>',['class'=>'btn btn-info','data'=>['toggle'=>"collapse"]]) !!}
    @endif
    @unless(isset($hideCreate))
        {!! PackagesForm::link(url($resource_url.'/create'), trans('Packages::labels.create'),['class'=>'btn btn-success']) !!}
    @endunless
     
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">

          @component('components.box',['box_class'=>'box-primary'])
                @if(!empty($dataTable->filters()))
               
                    <div id="{{ $dataTable->getTableAttributes()['id'] }}_filtersCollapse"
                         class="filtersCollapse collapse">
                        <br/>
                        {!! $dataTable->filters() !!}
                        <hr>
                    </div>
                @endif
         {{-- table settings collapse --}}
        <div id="{{ $dataTable->getTableAttributes()['id'] }}_columnsListCollapse"
                         class="collapse" >


            <p><strong>{{__('packages-admin::labels.component.choose_column_to_visible')}}</strong></p> 
            <hr>            
      
           <ul class="vs-columns-list">

            @foreach($dataTable->collection->toArray() as $column)

           @if($column['data'] != 'id')
            @php

            $visible = isset($column['visible'])?$column['visible']:true;

            @endphp
            <li class="vs-one-column-list"><input class="toggle-vis" type="checkbox" name="visible_column" @if($visible) checked="" @endif data-column="{{$loop->index}}">{{$column['title']}}</li> 

            @endif

            @endforeach

        </ul>
             

                
        
         </div>
         {{-- end settings --}}
                <div class="table-responsive m-t-10" style="min-height: 350px;padding-bottom: 20px;">
                    {!! $dataTable->table(['class' => 'table table-hover table-striped table-condensed dataTableBuilder','style'=>'width:100%;']) !!}
                </div>
            @endcomponent


        </div>
    </div>


@endsection

@section('js')
    @include('layouts.crud.filters_script')
    {!! $dataTable->assets() !!}
    {!! $dataTable->scripts() !!}

    <script type="text/javascript">
        $('body').on( 'change','.toggle-vis', function () {
          var table = $('{{'#'.$dataTable->getTableAttribute('id')}}').DataTable();
        // Get the column API object
        var column = table.column( $(this).attr('data-column') );
        // Toggle the visibility
        column.visible( ! column.visible() );
    });
    </script>
@endsection