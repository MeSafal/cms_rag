@if($item= $items[0]?? null)
<div id="content" class="site-content">
    <div class="main">
        <div class="container">
            <div id="primary" class="primary content-area">
                <article class="post-5338 page type-page status-publish hentry">
                    <div class="entry-content">
                        <div data-elementor-type="wp-page" data-elementor-id="5338" class="elementor elementor-5338">
                            <section
                                class="elementor-section elementor-top-section elementor-element elementor-element-65c0fbf2 pt-animation-medium-offset elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-invisible"
                                data-id="65c0fbf2" data-element_type="section"
                                data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;}">
                                <div class="elementor-container elementor-column-gap-no">
                                    <div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-23088d37"
                                        data-id="23088d37" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-451c9d25 elementor-widget elementor-widget-image"
                                                data-id="451c9d25" data-element_type="widget"
                                                data-widget_type="image.default">
                                                <div class="elementor-widget-container">
                                                    <img loading="lazy" decoding="async" width="665" height="1024"
                                                        src="{{asset(explode(',', $item->thumb)[0])}}"
                                                        class="attachment-large size-large wp-image-4762" alt=""
                                                        sizes="(max-width: 665px) 100vw, 665px" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-26911f01 elementor-hidden-tablet elementor-hidden-mobile"
                                        data-id="26911f01" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-1ba7ddfa full-height elementor-widget elementor-widget-pt_vertical_divider"
                                                data-id="1ba7ddfa" data-element_type="widget"
                                                data-widget_type="pt_vertical_divider.default">
                                                <div class="elementor-widget-container">

                                                    <div class="pt-vertical-divider divider-grass">
                                                        <div class="pt-vd-icon icon-start"> <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 31.06 29.67">
                                                                <path
                                                                    d="M36.53,21.85,31.78,18s-7.5.83-9.68,16.39C22.1,34.34,25.7,21.66,36.53,21.85Z"
                                                                    transform="translate(-5.47 -4.66)"></path>
                                                                <path class="cls-1"
                                                                    d="M5.47,21.85,10.22,18s7.5.83,9.68,16.39C19.9,34.34,16.3,21.66,5.47,21.85Z"
                                                                    transform="translate(-5.47 -4.66)"></path>
                                                                <polygon class="cls-1"
                                                                    points="15.53 0 18.66 6.56 15.53 22.16 12.39 6.56 15.53 0">
                                                                </polygon>
                                                            </svg> </div>
                                                        <div class="pt-vd-line"></div>
                                                        <div class="pt-vd-icon icon-end"> <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 31.06 29.67">
                                                                <path
                                                                    d="M36.53,21.85,31.78,18s-7.5.83-9.68,16.39C22.1,34.34,25.7,21.66,36.53,21.85Z"
                                                                    transform="translate(-5.47 -4.66)"></path>
                                                                <path class="cls-1"
                                                                    d="M5.47,21.85,10.22,18s7.5.83,9.68,16.39C19.9,34.34,16.3,21.66,5.47,21.85Z"
                                                                    transform="translate(-5.47 -4.66)"></path>
                                                                <polygon class="cls-1"
                                                                    points="15.53 0 18.66 6.56 15.53 22.16 12.39 6.56 15.53 0">
                                                                </polygon>
                                                            </svg> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-259b3b86"
                                        data-id="259b3b86" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-2ae0d564 elementor-widget elementor-widget-pt_title"
                                                data-id="2ae0d564" data-element_type="widget"
                                                data-widget_type="pt_title.default">
                                                <div class="elementor-widget-container">

                                                    <div class="pt-title-wrap text-center-mobile">
                                                        <div class="pt-subtitle-wrap"><span class="pt-subtitle">{{$item->subtitle}}</span>
                                                        </div>
                                                        <h5 class="pt-title">
                                                           {{$item->title}} </h5>
                                                        <div class="pt-title-text">
                                                            {!!Str::words($item->description, 20, ' .....')!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="elementor-element elementor-element-27a76a23 elementor-widget__width-auto elementor-view-default elementor-widget elementor-widget-icon"
                                                data-id="27a76a23" data-element_type="widget"
                                                data-widget_type="icon.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-icon-wrapper">
                                                        <a class="elementor-icon" href="https://www.twitter.com/"
                                                            target="_blank">
                                                            <i aria-hidden="true" class="fab fa-twitter"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-61a1bc3c elementor-widget__width-auto elementor-view-default elementor-widget elementor-widget-icon"
                                                data-id="61a1bc3c" data-element_type="widget"
                                                data-widget_type="icon.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-icon-wrapper">
                                                        <a class="elementor-icon" href="https://www.facebook.com/">
                                                            <i aria-hidden="true" class="fab fa-facebook-f"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-183d335a elementor-widget__width-auto elementor-view-default elementor-widget elementor-widget-icon"
                                                data-id="183d335a" data-element_type="widget"
                                                data-widget_type="icon.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-icon-wrapper">
                                                        <a class="elementor-icon" href="https://www.instagram.com/"
                                                            target="_blank">
                                                            <i aria-hidden="true" class="fab fa-instagram"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-254f0959 elementor-widget__width-auto elementor-view-default elementor-widget elementor-widget-icon"
                                                data-id="254f0959" data-element_type="widget"
                                                data-widget_type="icon.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-icon-wrapper">
                                                        <a class="elementor-icon" href="https://www.youtube.com/"
                                                            target="_blank">
                                                            <i aria-hidden="true" class="fab fa-youtube"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-18a63463 elementor-widget__width-auto elementor-view-default elementor-widget elementor-widget-icon"
                                                data-id="18a63463" data-element_type="widget"
                                                data-widget_type="icon.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-icon-wrapper">
                                                        <a class="elementor-icon" href="https://www.pinterest.com/"
                                                            target="_blank">
                                                            <i aria-hidden="true" class="fab fa-pinterest"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="elementor-element elementor-element-66571ae8 elementor-mobile-align-center elementor-widget elementor-widget-pt_button"
                                                data-id="66571ae8" data-element_type="widget"
                                                data-widget_type="pt_button.default">
                                                <div class="elementor-widget-container">
                                                    <a href="{{route('home')}}"
                                                        class="elementor-button-link button" role="button">
                                                        <span class="pt-btn-text">Get In Touch</span>
                                                    </a>
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
