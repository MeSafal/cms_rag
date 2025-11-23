@include(frontendpath() . '.partials.header')
@include(frontendpath() . '.pages.content-single', [
    'item' => $content,
])
@include(frontendpath() . '.partials.footer')
