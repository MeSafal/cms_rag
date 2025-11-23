@php
    use App\Helpers\CMS_FMS;
    $cms = new CMS_FMS();
@endphp

<div class="main">
    <div class="container">
        <div id="primary" class="primary content-area"></div>
        <div data-elementor-type="wp-page" data-elementor-id="5123" class=" elementor-5123 elementor elementor-5778">
            <section
                class="elementor-section elementor-top-section elementor-element elementor-element-7c92bb9e elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                data-id="7c92bb9e" data-element_type="section"
                data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="elementor-container elementor-column-gap-no">
                    @foreach ($items as $item)
                    @php
                        $menus = $cms->getMenuByCategory($item->menuCategories_id);
                    @endphp`
                        <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-7571765b pt-animation-medium-offset elementor-invisible"
                            data-id="7571765b" data-element_type="column"
                            data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;}">
                            <div class="elementor-widget-wrap elementor-element-populated">
                                <div class="elementor-element elementor-element-e685be1 elementor-widget elementor-widget-pt_title"
                                    data-id="e685be1" data-element_type="widget" data-widget_type="pt_title.default">
                                    <div class="elementor-widget-container">

                                        <div class="pt-title-wrap text-center">
                                            <div class="pt-subtitle-wrap"><span class="pt-subtitle">{{$item->subtitle}}</span>
                                            </div>
                                            <h6 class="pt-title">
                                                {{$item->title}} </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-39dd58d4 elementor-widget elementor-widget-pt_food_menu"
                                    data-id="39dd58d4" data-element_type="widget"
                                    data-widget_type="pt_food_menu.default">
                                    <div class="elementor-widget-container">
                                        <div class="pt-food-menu food-menu-style-3">
                                            @foreach ($menus as $menu)
                                            <div class="pt-food-menu-item">
                                                <div class="pt-food-menu-main">
                                                    <div class="pt-food-menu-header">
                                                        <h6 class="pt-food-menu-title"> <span class="title-wrap">{{$menu->title}}</span> </h6>
                                                        <div class="pt-food-menu-lines"></div><span
                                                            class="pt-food-menu-price">{{$menu->price}}</span>
                                                    </div>
                                                    <p class="pt-food-menu-details">{{$menu->subtitle}}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            <section
                class="elementor-section elementor-top-section elementor-element elementor-element-d3ab6c8 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                data-id="d3ab6c8" data-element_type="section">
                <div class="elementor-container elementor-column-gap-no">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-376ec81c elementor-invisible"
                        data-id="376ec81c" data-element_type="column"
                        data-settings="{&quot;animation&quot;:&quot;fadeIn&quot;,&quot;animation_delay&quot;:500}">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-69db59dd elementor-widget__width-auto elementor-widget elementor-widget-pt_button"
                                data-id="69db59dd" data-element_type="widget" data-widget_type="pt_button.default">
                                <div class="elementor-widget-container">
                                    <a href="menu-sections/index.html"
                                        class="elementor-button-link button pt-btn-outline" role="button">
                                        <span class="pt-btn-text">Browse Menus</span>
                                    </a>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-66996631 elementor-widget__width-auto elementor-widget elementor-widget-pt_button"
                                data-id="66996631" data-element_type="widget" data-widget_type="pt_button.default">
                                <div class="elementor-widget-container">
                                    <a href="shop/index.html" class="elementor-button-link button pt-btn-outline"
                                        role="button">
                                        <span class="pt-btn-text">Order Online</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
