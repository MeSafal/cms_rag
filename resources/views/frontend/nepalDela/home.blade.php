@foreach ($children as $child)
    @include(frontendPath() . '.' . $child->name, [
        'items' => $data[$child->id] ?? collect(),
        'title' => $child->title,
        'subtitle' => $child->subtitle,
        'content' => $content ?? null,
    ])
@endforeach
    