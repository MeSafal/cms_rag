
@if ($item = $items[0]?? null)

    <body data-rsssl=1
        class="page-template page page-id-5338 wp-custom-logo wp-embed-responsive theme-patiotime woocommerce-no-js elementor-default elementor-kit-8 elementor-page elementor-page-5338 page-template-template-wide-content page-template-template-wide-content-php pt-template-wide light-color site-layout-fullwidth pt-form-underline">
        <div id="page">

            <div id="content" class="site-content">

                <div class="main">
                    <div class="container">
                        <div id="primary" class="primary content-area">
                            <article class="post-5338 page type-page status-publish hentry">
                                <div class="entry-content">
                                    <div data-elementor-type="wp-page" data-elementor-id="5338"
                                        class="elementor elementor-5338">
                                        <section
                                            class="elementor-section elementor-top-section elementor-element elementor-element-2c543d5d pt-section-content-fullwidth pt_scroll_y_120 pt-parallax-on-scroll elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                            data-id="2c543d5d" data-element_type="section"
                                            data-settings="{&quot;background_background&quot;:&quot;classic&quot;}"
                                            data-pt-parallax-y="120" style="background-image: none;"
                                            data-pt-background-image="{{explode(',', $item->cover)[0]}}">
                                            <div class="elementor-background-overlay"></div>
                                            <div class="elementor-container elementor-column-gap-no">
                                                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-7f930fe5 dark-color"
                                                    data-id="7f930fe5" data-element_type="column">
                                                    <div class="elementor-widget-wrap elementor-element-populated">
                                                        <div class="elementor-element elementor-element-6b067c46 elementor-widget elementor-widget-pt_title"
                                                            data-id="6b067c46" data-element_type="widget"
                                                            data-widget_type="pt_title.default">
                                                            <div class="elementor-widget-container">

                                                                <div class="pt-title-wrap text-center">
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

            </div> <!-- end of #content -->

        </div>
@endif
