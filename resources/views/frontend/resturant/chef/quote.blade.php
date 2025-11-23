@php
    $item = $items[0] ?? null;
@endphp
@if($item)
<div id="content" class="site-content">

    <div class="main">
        <div class="container">
            <div id="primary" class="primary content-area">
                <article class="post-5338 page type-page status-publish hentry">
                    <div class="entry-content">
                        <div data-elementor-type="wp-page" data-elementor-id="5338" class="elementor elementor-5338">
                            <section
                                class="elementor-section elementor-top-section elementor-element elementor-element-6685b189 pt-section-content-fullwidth pt_scroll_y_120 pt-parallax-on-scroll elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="6685b189" data-element_type="section"
                                data-settings="{&quot;background_background&quot;:&quot;classic&quot;}"
                                data-pt-parallax-y="120" style="background-image: none;"
                                data-pt-background-image="{{asset(explode(',', $item->cover)[0])}}">
                                <div class="elementor-background-overlay"></div>
                                <div class="elementor-container elementor-column-gap-no">
                                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-70fbfc4b dark-color"
                                        data-id="70fbfc4b" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-3468c815 elementor-invisible elementor-widget elementor-widget-pt_testimonials"
                                                data-id="3468c815" data-element_type="widget"
                                                data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:200}"
                                                data-widget_type="pt_testimonials.default">
                                                <div class="elementor-widget-container">

                                                    <div class="pt-testimonials testimonial-style-1 text-center testimonials-slider"
                                                        data-column="1" data-autoplay="off" data-autoplay-speed="5000"
                                                        data-show-arrows="on" data-show-dots="on">
                                                        <div class="pt-ts-wrap">
                                                            <div class="pt-ts-item">
                                                                <div class="pt-testimonial">
                                                                    {!!$item->description!!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div><!-- .post-entry -->
                </article>
            </div>
        </div>
    </div>

</div> <!-- end of #content -->

@endif
