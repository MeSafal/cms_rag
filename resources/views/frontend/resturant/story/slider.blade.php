@php
    $item = $items[0];
@endphp
<body data-rsssl=1
    class="page-template page page-id-4725 wp-custom-logo wp-embed-responsive theme-patiotime woocommerce-no-js elementor-default elementor-kit-8 elementor-page elementor-page-4725 page-template-template-wide-content page-template-template-wide-content-php pt-template-wide light-color site-layout-fullwidth pt-form-underline">
    <div id="page">

    <div id="content" class="site-content">

        <div class="main">
            <div class="container">
                <div id="primary" class="primary content-area">
                    <article class="post-4725 page type-page status-publish hentry">
                        <div class="entry-content">
                            <div data-elementor-type="wp-page" data-elementor-id="4725"
                                class="elementor elementor-4725">
                                <section
                                    class="elementor-section elementor-top-section elementor-element elementor-element-375b9dba pt-section-content-fullwidth pt_scroll_y_120 pt-parallax-on-scroll elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                    data-id="375b9dba" data-element_type="section"
                                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}"
                                    data-pt-parallax-y="120" style="background-image: none;"
                                    data-pt-background-image="{{asset($item->cover)}}">
                                    <div class="elementor-background-overlay"></div>
                                    <div class="elementor-container elementor-column-gap-no">
                                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-32e56380 dark-color"
                                            data-id="32e56380" data-element_type="column">
                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                <div class="elementor-element elementor-element-41b7ac8f elementor-widget elementor-widget-pt_title"
                                                    data-id="41b7ac8f" data-element_type="widget"
                                                    data-widget_type="pt_title.default">
                                                    <div class="elementor-widget-container">

                                                        <div class="pt-title-wrap text-center">
                                                            <div class="pt-subtitle-wrap"><span
                                                                    class="pt-subtitle color-white style-bordered">{{$item->subtitle}}</span></div>
                                                            <h1 class="pt-title">
                                                                {{$item->title}} </h1>
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
    </div>
</div>
