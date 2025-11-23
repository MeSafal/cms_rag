
<div id="content" class="site-content">

    <div class="main">
        <div class="container">
            <div id="primary" class="primary content-area">
                <article class="post-5338 page type-page status-publish hentry">
                    <div class="entry-content">
                        <div data-elementor-type="wp-page" data-elementor-id="5338" class="elementor elementor-5338">
                            <section
                                class="elementor-section elementor-top-section elementor-element elementor-element-1c3e2fbb elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="1c3e2fbb" data-element_type="section">
                                <div class="elementor-container elementor-column-gap-no">
                                    @foreach ($items as $item)
                                    <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-12858c04 pt-animation-medium-offset elementor-invisible"
                                        data-id="12858c04" data-element_type="column"
                                        data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;}">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-2b33f3e9 elementor-widget elementor-widget-pt_team"
                                                data-id="2b33f3e9" data-element_type="widget"
                                                data-widget_type="pt_team.default">
                                                <div class="elementor-widget-container">
                                                    <div class="pt-team">
                                                        <div class="pt-team-photo">
                                                            <img loading="lazy" decoding="async" width="800"
                                                                height="1000" src="{{asset(explode(',', $item->thumb)[0])}}"
                                                                class="attachment-full size-full wp-image-4770" alt="{{$item->title}}" sizes="(max-width: 800px) 100vw, 800px" />
                                                        </div>
                                                        <div class="pt-team-info"> <span
                                                                class="pt-subtitle pt-team-position">{{$item->subtitle}}</span>
                                                            <h5 class="pt-title pt-team-name">
                                                                {{$item->title}} </h5>
                                                            {!!Str::words($item->description, 20, ' ......')!!}
                                                            {{-- <div class="pt-team-social">
                                                                <ul class="social-nav menu">
                                                                    <li> <a href="https://facebook.com/"
                                                                            target="_blank">Facebook </a> </li>
                                                                    <li> <a href="https://twitter.com/"
                                                                            target="_blank">Twitter </a> </li>
                                                                    <li> <a href="https://instagram.com/"
                                                                            target="_blank">Instagram </a> </li>
                                                                </ul>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                </div>
                            </section>
                        </div>
                    </div><!-- .post-entry -->
                </article>
            </div>
        </div>
    </div>
</div>
