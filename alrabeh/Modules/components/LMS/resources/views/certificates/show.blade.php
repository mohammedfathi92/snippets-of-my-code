@extends('layouts.crud.show')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('lms_certificate_show') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @component('components.box')
        <div class="row">
            <div class="col-md-12">
                <div style="margin-bottom: 15px;">
                      <a href="{{route('certificates.edit', $certificate->hashed_id)}}" class="btn btn-success"><i class="fa fa-edit"></i> @lang('LMS::attributes.main.edit')</a>

                      </div>

                <div class="cirtificate_containter">   
       
                <div class="col-lg-12 ">
                    <div class="cer-wrap m-auto demo-box" style="background: url('{{$certificate->image}}');">
                        <div class="cer-content">
                            @if($certificate->hasMedia('lms-certificate-site_logo'))
                            <div class="cer-logo">
                                <img src="{{$certificate->site_logo}}" class="">
                            </div>
                            @endif
                            <br>
                            <div style="margin: 30px 0px;">
                            
                            {!! $certificate->content !!}

                            </div>
                            
                        </div>
                        @if($certificate->hasMedia('lms-certificate-seal'))
                        <div class="signature">
                                <img src="{{$certificate->seal}}" >
                            </div>
                            @endif
                            @if($certificate->hasMedia('lms-certificate-signature'))
                            <div class="signature-right">
                                <br> <img src="{{$certificate->signature}}" >
                            </div>
                            @endif
                        <div class="cer-footer">
                            {!! $certificate->note !!}
                        </div>
                    </div>
                    <style>
                        .cer-wrap{
                            background-size:100% 100% !important;
                            direction: rtl;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            min-height: 625px;
                            min-width: 850px
                        }
                        .cer-content{
                            padding: 110px 0;
                        }
                        .cer-content, .cer-logo{
                            text-align: center;
                        }
                        .certify{
                            margin-top: 10px;
                            font-size: 21px;
                        }
                        .cStd-name, .cSub-name, .cer-degree{
                            font-size: 29px;
                            font-weight: 800;
                            color: #02475f

                        }
                        .cer-degree {
                            margin-bottom: 100px;
                        }
                        .cer-footer{
                            position: absolute;
                            right: 170px;
                            left: 170px;
                            width: calc(100% - 320px);  
                            bottom: 80px;
                            text-align: center;
                            font-size: 13px
                        }.m-0{
                            margin: 0;
                        }
                        .txth-line{
                            margin-top: 0.25rem;
                            margin-bottom: 0.5rem;
                            display: inline-block;
                            width: 100px;
                        }
                        .signature{
                            position: absolute;
                            bottom: 120px;
                            left: 150px;    
                        }
                        .signature-right{
                            position: absolute;
                            bottom: 120px;
                            right: 150px;   
                        }
                    </style>
                </div>
                
          </div>   
        
        


            </div>
        </div>
    @endcomponent
@endsection

