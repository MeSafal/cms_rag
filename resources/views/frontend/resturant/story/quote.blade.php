@if ($items)
<div id="content" class="site-content">
    <div class="main">
        <div class="container">
            <div id="primary" class="primary content-area">
                <article class="post-4725 page type-page status-publish hentry">
                    <div class="entry-content">
                        <div data-elementor-type="wp-page" data-elementor-id="4725" class="elementor elementor-4725">
                            <section
                                class="elementor-section elementor-top-section elementor-element elementor-element-759db46a elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="759db46a" data-element_type="section">
                                <div class="elementor-container elementor-column-gap-no">
                                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-312d3bbd"
                                        data-id="312d3bbd" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-75f1a756 elementor-widget elementor-widget-pt_title"
                                                data-id="75f1a756" data-element_type="widget"
                                                data-widget_type="pt_title.default">
                                                <div class="elementor-widget-container">

                                                    <div class="pt-title-wrap text-center">
                                                        <div class="pt-subtitle-wrap"><span class="pt-subtitle">{{$items[0]->title}} {!!$items[0]->description!!}</span></div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
@endif
