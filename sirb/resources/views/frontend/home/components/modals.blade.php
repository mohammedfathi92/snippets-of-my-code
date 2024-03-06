<!-- Modal -->
<div class="modal fade" id="myOfferBannerModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-body" style="padding: 0">
                @if(settings('show_modal_offer_image_'.$locale))

                    <img src="{{Storage::url(settings('show_modal_offer_image_'.$locale))}}"
                         alt="{{settings($locale.'_title')}}" class="img-fluid" style="width:100%; height: 100%;">
                @endif

                @if(settings('show_modal_offer_text_'.$locale))

                    <div>
                        {!! settings('show_modal_offer_text_'.$locale) !!}

                    </div>
                @endif

            </div>

            <div class="modal-footer">
                <div class="col-sm-4 col-md-2">

                    <h4><strong style="color: #224072"> للحجز : </strong></h4>

                </div>
                @if(settings("help_phone"))
                    @php $whatsappNumbers=explode(",",settings("help_phone")) @endphp
                    @if($whatsappNumbers && is_array($whatsappNumbers))
                        <div class="col-sm-12 col-md-10">
                            @foreach($whatsappNumbers as $number)
                                <div class="col-sm-6 col-md-5">
                                    <a href="https://api.whatsapp.com/send?phone={{trim(str_replace('+', '', $number))}}"
                                       class="button btn-small sea-blue"><i class="icon-squares circle"></i> {{$number}}
                                    </a>
                                </div>

                            @endforeach
                        </div>
                    @else
                        <div class="col-sm-4 col-md-4"><a
                                    href="https://api.whatsapp.com/send?phone={{str_replace('+', '', settings('help_phone'))}}"
                                    class="btn btn-success"><i
                                        class="icon-squares circle"></i> {{settings('help_phone')}} </a></div>

                    @endif
                @endif


            </div>


        </div>

    </div>
</div>