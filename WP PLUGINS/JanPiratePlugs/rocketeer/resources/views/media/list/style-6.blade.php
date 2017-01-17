@foreach( $media->content->items as $ik => $iv)
    @if(isset($iv->is_ad))
        <div class="list-item-ctr-6" v-show="{{ $ik }} === current_item" transition="listTrans">
            <div class="list-item-header list-item-header-{{ $settings->site_color }}">
                <div class="list-item-title">
                    <button type="button" class="btn btn-{{ $settings->site_color }} pull-left" v-on:click="prevItem()"
                            v-bind:disabled="current_item === 0"><i class="fa fa-angle-left"></i> {{ trans('media.prev') }}</button>
                    <button type="button" class="btn btn-{{ $settings->site_color }} pull-right" v-on:click="nextItem()"
                            v-bind:disabled="current_item === {{ count($media->content->items) }}-1">{{ trans('media.next') }} <i class="fa fa-angle-right"></i></button>
                </div>
            </div>
            {!! $settings->list_ad !!}
        </div>
    @else
        <div class="list-item-ctr-6" v-show="{{ $ik }} === current_item" transition="listTrans">
            <div class="list-item-header list-item-header-{{ $settings->site_color }}">
                <div class="list-item-title">
                    <button type="button" class="btn btn-{{ $settings->site_color }} pull-left" v-on:click="prevItem()"
                            v-bind:disabled="current_item === 0"><i class="fa fa-angle-left"></i> {{ trans('media.prev') }}</button>
                    <button type="button" class="btn btn-{{ $settings->site_color }} pull-right" v-on:click="nextItem()"
                            v-bind:disabled="current_item === {{ count($media->content->items) }}-1">{{ trans('media.next') }} <i class="fa fa-angle-right"></i></button>
                    <div class="list-item-title-text text-center">{{ $ik+1 }}. {{ $iv->title }}</div>
                </div>
            </div>
            @if($iv->media_type == 1)
                @if(count($iv->images) > 1)
                    <div id="list-carousel-{{ $ik }}" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            @foreach($iv->images as $imgk => $imgv)
                                <div class="item @if($imgk ===0) active @endif">
                                    <img src="{{ jasko_component( '/uploads/' . $imgv ) }}">
                                </div>
                            @endforeach
                        </div>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#list-carousel-{{ $ik }}" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        </a>
                        <a class="right carousel-control" href="#list-carousel-{{ $ik }}" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        </a>
                    </div>
                @else
                    <img src="{{ jasko_component( '/uploads/' . $iv->images[0] ) }}" class="img-responsive">
                @endif
            @elseif($iv->media_type == 2)
                {!! $iv->embed_code !!}
            @elseif($iv->media_type == 3)
                <blockquote class="media_blockquote">
                    <i class="fa fa-quote-left fa-2x"></i>
                    <i class="fa fa-quote-right fa-2x"></i>
                    <p>{{ $iv->quote }}</p>
                    <small>{{ $iv->quote_src }}</small>
                </blockquote>
            @endif
            <p>{{ $iv->desc }}</p>
        </div>
    @endif
@endforeach