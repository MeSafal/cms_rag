<div class="main">
    <div class="container">
        <div id="primary" class="primary content-area">
            <div data-elementor-type="wp-page" data-elementor-id="5123" class=" elementor-5123 elementor elementor-5778">
                @foreach ($items as $service)
                    @php
                        $thumbs = explode(',', $service->thumb);
                        $thumb1 = $thumbs[0] ?? null;
                        $thumb2 = $thumbs[1] ?? $thumb1;
                    @endphp
                    @if ($loop->odd)
                        <section
                            class="elementor-section elementor-top-section elementor-element elementor-element-243dfa32 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                            data-id="243dfa32" data-element_type="section"
                            data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                            <div class="elementor-container elementor-column-gap-no">
                                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-1d23aec0"
                                    data-id="1d23aec0" data-element_type="column">
                                    <div class="elementor-widget-wrap elementor-element-populated">
                                        <section
                                            class="elementor-section elementor-inner-section elementor-element elementor-element-6fb639e4 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                            data-id="6fb639e4" data-element_type="section">
                                            <div class="elementor-container elementor-column-gap-no">
                                                <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-1d5b65c"
                                                    data-id="1d5b65c" data-element_type="column"
                                                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                    <div class="elementor-widget-wrap elementor-element-populated">
                                                        <div class="elementor-element elementor-element-2b59727b pt-animation-medium-offset elementor-invisible elementor-widget elementor-widget-image"
                                                            data-id="2b59727b" data-element_type="widget"
                                                            data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:300}"
                                                            data-widget_type="image.default">
                                                            <div class="elementor-widget-container">
                                                                <img loading="lazy" decoding="async" width="370"
                                                                    height="555" src="{{ asset($thumb1) }}"
                                                                    class="attachment-370x9999 size-370x9999 wp-image-3836"
                                                                    alt="" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-511f6490"
                                                    data-id="511f6490" data-element_type="column">
                                                    <div class="elementor-widget-wrap elementor-element-populated">
                                                        <div class="elementor-element elementor-element-696fb9c pt-animation-medium-offset elementor-invisible elementor-widget elementor-widget-image"
                                                            data-id="696fb9c" data-element_type="widget"
                                                            data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100}"
                                                            data-widget_type="image.default">
                                                            <div class="elementor-widget-container">
                                                                <img loading="lazy" decoding="async" width="550" style="max-height: 550px !important; max-width: 400px !important; object-fit: cover;"
                                                                    height="687" src="{{ asset($thumb2) }}"
                                                                    class="attachment-550x9999 size-550x9999 wp-image-250"
                                                                    alt="" />
                                                            </div>
                                                        </div>
                                                        <div class="elementor-element elementor-element-5949e9c2 elementor-hidden-mobile elementor-widget elementor-widget-spacer"
                                                            data-id="5949e9c2" data-element_type="widget"
                                                            data-widget_type="spacer.default">
                                                            <div class="elementor-widget-container">
                                                                <div class="elementor-spacer">
                                                                    <div class="elementor-spacer-inner">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-6119e228"
                                    data-id="6119e228" data-element_type="column">
                                    <div class="elementor-widget-wrap elementor-element-populated">
                                        <div class="elementor-element elementor-element-2f5f0c04 elementor-widget elementor-widget-pt_title"
                                            data-id="2f5f0c04" data-element_type="widget"
                                            data-widget_type="pt_title.default">
                                            <div class="elementor-widget-container">

                                                <div class="pt-title-wrap">
                                                    <div class="pt-subtitle-wrap"><span
                                                            class="pt-subtitle style-bordered">{{ $service->subtitle }}</span>
                                                    </div>
                                                    <h5 class="pt-title">
                                                        {{ $service->title }} </h5>
                                                    <div class="pt-title-text">
                                                        {!! Str::words($service->description, 50, ' ....') !!}
                                                    </div>
                                                    <div class="pt-title-btn">
                                                        <a class="button elementor-button-link" role="button"
                                                            href="meet-our-chefs/index.html">
                                                            <span class="pt-btn-text">Learn More</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @else
                        <section
                            class="elementor-section elementor-top-section elementor-element elementor-element-3f2ba378 elementor-reverse-tablet elementor-reverse-mobile elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                            data-id="3f2ba378" data-element_type="section"
                            data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                            <div class="elementor-container elementor-column-gap-no">
                                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-7e08f1e7"
                                    data-id="7e08f1e7" data-element_type="column">
                                    <div class="elementor-widget-wrap elementor-element-populated">
                                        <div class="elementor-element elementor-element-43369cd0 elementor-widget elementor-widget-pt_title"
                                            data-id="43369cd0" data-element_type="widget"
                                            data-widget_type="pt_title.default">
                                            <div class="elementor-widget-container">

                                                <div class="pt-title-wrap text-right text-left-tablet">
                                                    <div class="pt-subtitle-wrap"><span
                                                            class="pt-subtitle style-bordered">{{$service->subtitle}}</span></div>
                                                    <h5 class="pt-title">
                                                        {{$service->title}}</h5>
                                                    <div class="pt-title-text">
                                                       {!!Str::words($service->description, 50, ' ....')!!}
                                                    </div>
                                                    <div class="pt-title-btn">
                                                        <a class="button elementor-button-link" role="button"
                                                            href="javascript:void(0)" target="_blank">
                                                            <span class="pt-btn-text">Learn More</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-21fec8cd"
                                    data-id="21fec8cd" data-element_type="column">
                                    <div class="elementor-widget-wrap elementor-element-populated">
                                        <div class="elementor-element elementor-element-4f074ad7 pt-animation-medium-offset elementor-invisible elementor-widget elementor-widget-pt_gallery"
                                            data-id="4f074ad7" data-element_type="widget"
                                            data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:300}"
                                            data-widget_type="pt_gallery.default">
                                            <div class="elementor-widget-container">

                                                <div class="pt-gallery gap-5 gallery-grid grid-col-2 align-middle-v">
                                                    <div class="pt-gallery-wrap">
                                                        <div class="pt-gallery-item"><img loading="lazy"
                                                                decoding="async" width="370" height="555"
                                                                src="{{asset($thumb1)}}"
                                                                class="attachment-370x9999 size-370x9999 wp-image-3845"
                                                                alt=""
                                                                sizes="(max-width: 370px) 100vw, 370px" />
                                                        </div>
                                                        <div class="pt-gallery-item"><img loading="lazy" style="height: 450px !important; width: 100% !important; object-fit: cover;"
                                                                decoding="async" width="370" height="500"
                                                                src="{{asset($thumb2)}}"
                                                                class="attachment-370x9999 size-370x9999 wp-image-307"
                                                                alt="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
