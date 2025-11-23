
{{-- @include('frontend.resturant.partials.loader') --}}
 @if (count($items) > 0)
        <!-- Main Slideshow Section -->
        <div data-elementor-type="wp-page" data-elementor-id="5123" class="elementor-5123 elementor elementor-5778">
            <section
                class="elementor-section elementor-top-section elementor-element elementor-element-10bf1eb8 elementor-section-full_width elementor-section-height-default elementor-section-height-default"
                data-id="10bf1eb8" data-element_type="section">
                <div class="elementor-container elementor-column-gap-no">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-b17e49e dark-color"
                        data-id="b17e49e" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <!-- The slideshow section has a default background from slide 0 -->
                            <section id="slideshow-section"
                                class="elementor-section elementor-inner-section elementor-element elementor-element-4c0b3aac elementor-section-full_width elementor-section-height-min-height elementor-section-content-middle pt-section-content-fullwidth elementor-section-height-default"
                                data-id="4c0b3aac" data-element_type="section">

                                <!-- Transparent Overlay (Opacity 0.8) -->
                                <div id="overlay" class="slideshow-overlay"></div>

                                <div class="elementor-container elementor-column-gap-no">
                                    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-40ceea70"
                                        data-id="40ceea70" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-4ae64c80 elementor-widget elementor-widget-pt_title"
                                                data-id="4ae64c80" data-element_type="widget"
                                                data-widget_type="pt_title.default">
                                                <div class="elementor-widget-container">
                                                    <div class="pt-title-wrap text-center">
                                                        <div class="pt-subtitle-wrap">
                                                            <span class="pt-subtitle color-white style-bordered"
                                                                id="slideshow-subtitle"></span>
                                                        </div>
                                                        <h2 class="pt-title" id="slideshow-title"></h2>
                                                        <div class="pt-title-text">
                                                            <p id="slideshow-description"></p>
                                                        </div>
                                                        <div class="pt-title-btn">
                                                            <a class="button elementor-button-link pt-btn-large"
                                                                role="button" href="#" id="slideshow-btn-link">
                                                                <span class="pt-btn-text"
                                                                    id="slideshow-btn-text"></span>
                                                            </a>
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
                </div>
            </section>
        </div>
    @endif

    <!-- Slideshow Items (Hidden Data) -->
    <div id="slideshow-items" style="display: none;">
        @php
            // Ensure you have sliders and buttons from the content
            $sliders = $items ?? [];
            $totalSliders = count($sliders);
            $totalButtons = isset($content['buttons']) ? count($content['buttons']) : 0;
        @endphp

        @foreach ($sliders as $index => $slider)
            @php
                // If buttons exist, assign based on cycling pattern
                $button = $totalButtons > 0 ? $content['buttons'][$index % $totalButtons] : null;
            @endphp

            <div class="slide" data-image="{{ asset($slider->cover) }}" data-title="{{ $slider->title }}"
                data-subtitle="{{ $slider->subtitle }}" data-description="{{ $slider->remarks }}"
                @if ($button) data-button-text="{{ $button->title }}"
                data-button-link="{{ $button->url }}" @endif>
            </div>
        @endforeach
    </div>



    <!-- JavaScript -->

    <script type="text/javascript" src="{{ asset('assets/restruant/assets/js/slider.js') }}" id="jquery-core-js"></script>
