@if($items->isNotEmpty())
    @foreach ($items as $item)
        <div class="site-breadcrumb" style="background: url({{ asset(explode(',', $item->cover)[0]) }})">
            <div class="container">
                <h2 class="breadcrumb-title">{{ $item->title }}</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">{{ $item->title }}</li>
                </ul>
            </div>
        </div>
    @endforeach
@endif
