@if($items->isNotEmpty())
<div class="blog-area py-120">
    <div class="container">
         <div class="row">
            @foreach ($items as $item)
            <div class="col-md-6 col-lg-4">
                <div class="blog-item">
                    <div class="blog-item-img">
                        <img src="{{asset(explode(',', $item->thumb)[0])}}" alt="Thumb">
                    </div>
                    <div class="blog-item-info">
                        <h4 class="blog-title">
                            <a href="{{dynamicRoute($item)}}">{{$item->title}}</a>
                        </h4>
                        {!!Str::words($item->description, 20, ' .....')!!}
                        <a class="theme-btn" href="{{dynamicRoute($item)}}">{{$item->button?->title}}<i class="far fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
