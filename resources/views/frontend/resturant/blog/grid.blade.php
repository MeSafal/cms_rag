
<div id="content" class="site-content">
    <div class="main">
        <div class="container">
            <div id="primary" class="primary content-area">
                <article class="post-1753 page type-page status-publish hentry">
                    <div class="entry-content">
                        <div data-elementor-type="wp-page" data-elementor-id="1753" class="elementor elementor-1753">
                            <section style=" padding-top: 80px; padding-bottom: 80px;"
                                class="elementor-section elementor-top-section elementor-element elementor-element-c17b3a4 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="c17b3a4" data-element_type="section">
                                <div class="elementor-container elementor-column-gap-no">
                                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-0ffecd2"
                                        data-id="0ffecd2" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-69de1f4 elementor-widget elementor-widget-pt_blog"
                                                data-id="69de1f4" data-element_type="widget"
                                                data-widget_type="pt_blog.default">
                                                <div class="elementor-widget-container">
                                                    <div class="posts layout-grid column-2 img-ratio-3-2"
                                                        data-settings='{"query":{"paged":1,"posts_per_page":"10","ignore_sticky_posts":true},"settings":{"layout":"grid","columns":"2","post_meta":"a:4:{i:0;s:7:\"excerpt\";i:1;s:13:\"read_more_btn\";i:2;s:8:\"category\";i:3;s:4:\"date\";}","page_layout":"","pagination":"","archive_page":"elementor"}}'>
                                                        <div class="posts-wrapper">
                                                            @foreach ($items as $item)
                                                            <article
                                                                class="post-1715 post type-post status-publish format-gallery has-post-thumbnail hentry category-recipes tag-chefs-secret tag-food post_format-post-format-gallery">
                                                                <div class="featured-img">
                                                                    <a
                                                                        href="{{route('home')}}"><img
                                                                            loading="lazy" decoding="async" width="780"
                                                                            height="1030"
                                                                            src="{{asset(explode(',', $item->thumb)[0])}}"
                                                                            class="attachment-patiotime_780x9999 size-patiotime_780x9999 wp-post-image image-layout-grid-column-2"
                                                                            alt="{{$item->title}}" sizes="(max-width: 780px) 100vw, 780px" /></a>
                                                                    <div
                                                                        class="overlay-label format-label format-gallery">
                                                                        <span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="post-content">
                                                                    <header class="post-header">
                                                                        <div class="meta-wrap">
                                                                            <div class="meta">
                                                                                {{-- <div class="meta-item time">
                                                                                    <a
                                                                                        href="../blog/2022/03/16/smoked-salmon-tart/index.html">
                                                                                        <time class="published"
                                                                                            datetime="2022-03-16T06:27:51+00:00">March
                                                                                            16, 2022</time>
                                                                                    </a>
                                                                                </div> --}}
                                                                            </div>
                                                                            <div class="cat-links"><a
                                                                                    href="{{route('home')}}"
                                                                                    rel="tag">{{$item->subtitle}}</a></div>
                                                                        </div>
                                                                        <h2 class="post-title">
                                                                            <a
                                                                                href="{{route('home')}}">{{$item->title}}</a>
                                                                        </h2>
                                                                    </header>
                                                                    <div class="post-excerpt">
                                                                        {!!Str::words($item->description, 20, ' ...')!!}
                                                                    </div>
                                                                    <footer class="post-footer">
                                                                        <div class="more-btn">
                                                                            <a class="read-more-btn button pt-btn-underline"
                                                                                href="{{route('home')}}"><span>Read
                                                                                    More</span></a>
                                                                        </div>
                                                                    </footer>
                                                                </div>
                                                            </article>
                                                            @endforeach
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
                </article>
            </div>
        </div>
    </div>
</div>
