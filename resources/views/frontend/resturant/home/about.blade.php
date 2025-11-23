

@if (isset($items))
    @foreach ($items as $index => $article)
        @php
            $thumbs = explode(',', $article->thumb);
            $thumb1 = $thumbs[0] ?? null;
            $thumb2 = $thumbs[1] ?? $thumb1;
        @endphp
        <div data-elementor-type="wp-page" data-elementor-id="5123" class=" elementor-5123 elementor">
            <section
                class="elementor-section elementor-top-section elementor-element elementor-element-7d9747f1 pt-section-content-fullwidth elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                data-id="7d9747f1" data-element_type="section"
                data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="elementor-container elementor-column-gap-no">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-30728311"
                        data-id="30728311" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <section
                                class="elementor-section elementor-inner-section elementor-element elementor-element-4862f11e elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="4862f11e" data-element_type="section">
                                <div class="elementor-container elementor-column-gap-no">
                                    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-78c402b6"
                                        data-id="78c402b6" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-6bceb7c1 elementor-widget elementor-widget-pt_title"
                                                data-id="6bceb7c1" data-element_type="widget"
                                                data-widget_type="pt_title.default">
                                                <div class="elementor-widget-container">

                                                    <div class="pt-title-wrap">
                                                        <div class="pt-subtitle-wrap"><span
                                                                class="pt-subtitle style-bordered">{{ $article->subtitle }}</span>
                                                        </div>
                                                        <h3 class="pt-title">
                                                            {{ $article->title }} </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section
                                class="elementor-section elementor-inner-section elementor-element elementor-element-7506e0f6 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="7506e0f6" data-element_type="section">
                                <div class="elementor-container elementor-column-gap-no">
                                    <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-150cff78"
                                        data-id="150cff78" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-10de5c2f elementor-widget elementor-widget-pt_title"
                                                data-id="10de5c2f" data-element_type="widget"
                                                data-widget_type="pt_title.default">
                                                <div class="elementor-widget-container">

                                                    <div class="pt-title-wrap">
                                                        <div class="pt-title-text">
                                                            {!! Str::words($article['description'], 50, ' ...') !!}
                                                        </div>

                                                        {{-- @if ($button)
                                                            <div class="pt-title-btn">
                                                                <a class="button elementor-button-link" role="button"
                                                                    href="{{ url($button['url']) }}" target="{{$button['target'] }}">
                                                                    <span
                                                                        class="pt-btn-text">{{ $button['title'] }}</span>
                                                                </a>
                                                            </div>
                                                            @else
                                                            <div class="pt-title-btn">
                                                                <a class="button elementor-button-link" role="button"
                                                                    href="{{ url('#') }}">
                                                                    <span
                                                                        class="pt-btn-text">Read More</span>
                                                                </a>
                                                            </div>
                                                        @endif --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-12197f98"
                                        data-id="12197f98" data-element_type="column">
                                        <div class="elementor-widget-wrap">
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section
                                class="elementor-section elementor-inner-section elementor-element elementor-element-2c0f2f6a elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="2c0f2f6a" data-element_type="section">
                                <div class="elementor-container elementor-column-gap-no">
                                    <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-97fe8d8"
                                        data-id="97fe8d8" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-35b16ad9 pt-animation-medium-offset elementor-invisible elementor-widget elementor-widget-image"
                                                data-id="35b16ad9" data-element_type="widget"
                                                data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:200}"
                                                data-widget_type="image.default">
                                                <div class="elementor-widget-container">
                                                    <img class="thumb-1" loading="lazy" decoding="async"
                                                        src="{{ asset($thumb1) }}"
                                                        class="attachment-780x9999 size-780x9999 wp-image-1724"
                                                        alt="" sizes="(max-width: 780px) 100vw, 780px" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-31032e08"
                                        data-id="31032e08" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-670f7e8f elementor-widget__width-auto elementor-absolute elementor-hidden-mobile pt-animation-medium-offset elementor-invisible elementor-widget elementor-widget-image"
                                                data-id="670f7e8f" data-element_type="widget"
                                                data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100}"
                                                data-widget_type="image.default">
                                                <div class="elementor-widget-container">
                                                    <img loading="lazy" decoding="async" class="thumb-2"
                                                        src="{{ asset($thumb2) }}"
                                                        class="attachment-550x9999 size-550x9999 wp-image-109"
                                                        alt="" sizes="(max-width: 550px) 100vw, 550px" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endforeach
@endif
