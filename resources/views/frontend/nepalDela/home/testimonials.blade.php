<!--testimonials-->
@if ($items->isNotEmpty())
    @php
        $parts = splitTitle($title, 2);
    @endphp
    <div class="testimonial-area bg py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">{{ $subtitle }}</span>
                        <h2 class="site-title">{{ $parts[0] }} <span>{{ $parts[1] }}</span></h2>
                    </div>
                </div>
            </div>
            <div class="testimonial-slider owl-carousel owl-theme">
                @foreach ($items as $item)
                    <div class="testimonial-item">
                        <div class="testimonial-author-img">
                            <img src="{{ asset(explode(',', $item->thumb)[0]) }}" alt>
                        </div>
                        <p>
                            {{ $item->description }}
                        </p>
                        <div class="testimonial-author-info">
                            <h4>{{ $item->name }}</h4>
                            <p>{{ $item->position }}</p>
                        </div>
                        <span class="flaticon-quote"></span>
                    </div>
                @endforeach
                {{-- <div class="testimonial-item">
                <div class="testimonial-author-img">
                    <img src="assets/img/testimonial/02.jpg" alt>
                </div>
                <p>
                    The consultants at Nepal Dela helped me secure admission and financial aid at my dream university.
                    Their expertise in document handling is top-notch.
                </p>
                <div class="testimonial-author-info">
                    <h4>Asmita Adhikari</h4>
                    <p>Undergraduate – Australia</p>
                </div>
                <span class="flaticon-quote"></span>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-author-img">
                    <img src="assets/img/testimonial/03.jpg" alt>
                </div>
                <p>
                    I was struggling with visa requirements, but Nepal Dela made the entire process seamless. Their
                    professional approach really stands out.
                </p>
                <div class="testimonial-author-info">
                    <h4>Dipesh Karki</h4>
                    <p>Job Seeker – Germany</p>
                </div>
                <span class="flaticon-quote"></span>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-author-img">
                    <img src="assets/img/testimonial/04.jpg" alt>
                </div>
                <p>
                    From university selection to pre-departure support, Nepal Dela provided exceptional service. Their
                    dedication to students is truly commendable.
                </p>
                <div class="testimonial-author-info">
                    <h4>Pratiksha Dhungana</h4>
                    <p>Graduate Student – Canada</p>
                </div>
                <span class="flaticon-quote"></span>
            </div> --}}
            </div>

        </div>
    </div>
@endif
