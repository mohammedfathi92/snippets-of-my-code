
@if($errors->count())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-hidden="true"
            >&times;
            </button>

            {!! $error !!}

        </div>
    @endforeach
@endif

@if(session()->has('message'))
    @php
        $type='danger';
    switch(session('alert-type','danger')){
        case 'error':
        case 'danger':
        $type='danger';
        break;
        case 'info':
        $type='info';
        break;
        case 'warning':
        $type='warning';
        break;
        default:
        $type='danger';

    }
    @endphp
    <div class="alert alert-{{ $type }}  alert-important">

        <button type="button"
                class="close"
                data-dismiss="alert"
                aria-hidden="true"
        >&times;
        </button>

        {!! session('message') !!}
    </div>
@endif
