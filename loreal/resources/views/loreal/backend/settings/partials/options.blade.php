<style type="text/css">
    .select-section button {
        padding: 6px 12px !important;
    }

    .select-section .form-group {
        margin-bottom: 0;
    }
</style>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <h4>{{$data->label}}</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="alert alert-info">
  <strong>Note!</strong> {!! $data->notes !!}.
</div>
    </div>
</div>
{!! Form::open(['url' => route('loreal_settings.store_options', ['id'=> $data->id, 'key'=> $data->code]), 'method' => 'PUT']) !!}
   

<div class="select-section {{ $class = str_random().'_setting' }}">
    <table id="values-table" width="100%" class="table table-striped table-responsive">
        <thead>
        <tr>
            <th width="50%">Key</th>
            <th width="50%">Value [Label]</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach($options as $option_key => $option_value)
            <tr id="tr_{{ $loop->index }}" data-index="{{ $loop->index }}">
                <td>
                    <div class="form-group">
                        <input name="{{ "options[$loop->index][key]" }}" type="text"
                               value="{{ $option_key }}" class="form-control"/>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input name="{{ "options[$loop->index][value]" }}" type="text"
                               value="{{ $option_value }}" class="form-control"/>
                    </div>
                </td>
                <td>
                    <a href="javascript:;" class="btn btn-danger btn-sm remove-value" style="margin:0;"
                            data-index="{{ $loop->index }}"><i
                                class="voyager-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    <a  href="javascript:;" class="btn btn-success btn-sm" id="add-value"><i
                class="voyager-plus"></i>
    </a>
    <span class="help-block">
                         
                        </span>
</div>


<div class="row">
    <div class="col-md-12 col-lg-12">
        <button class="btn btn-primary" type="submit"> Update Settings</button>
    </div>
</div>

{!! Form::close() !!}

<script type="text/javascript">
    $(function () {
        if ($("#values-table").length > 0) {
            $('#add-value').on('click', function () {
                var index = $('#values-table tr:last').data('index');
                if (isNaN(index)) {
                    index = 0;
                } else {
                    index++;
                }
                $('#values-table tr:last').after('<tr id="tr_' + index + '" data-index="' + index + '"><td><div class="form-group">' +
                    '<input name="options[' + index + '][key]" type="text"' +
                    'value="" class="form-control"/></div></td><td><div class="form-group">' +
                    '<input name="options[' + index + '][value]" type="text"' +
                    'value="" class="form-control"/></div></td>' +
                    '<td><div class="form-group"><a a  href="javascript:;" class="btn btn-danger btn-sm remove-value" style="margin:0;" data-index="' + index + '">'
                    + '<i class="voyager-trash"></i></a></div></td>' +
                    '</tr>');
            });

            $('body').on('click', '.remove-value', function () {
                var index = $(this).data('index');
                $("#tr_" + index).remove();
            });
        }
    });

    
</script>
