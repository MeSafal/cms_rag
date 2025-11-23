@foreach ($children as $child)
    @include(frontendPath() . '.' . $child->name, [
        'items' => $data->get($child->id, collect()),
        'title' => $child->title,
        'subtitle' => $child->subtitle,
    ])
@endforeach
