{{-- 
@section('title', 'Home | Neuro Cardio and Multi Specialty Hospital - Biratnagar')
@section('is_active_home', 'active')
@include('include.header')
@include('include.nav')
<!-- ! Slider  -->
<!-- ! Slider  -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        @foreach ($carousels as $key => $carousel)
            @if ($key != 0)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}"
                    aria-label="Slide {{ $key }}"></button>
            @endif
        @endforeach
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('storage/upload/' . $carousels[0]->name) }}" class="d-block w-100" alt="..." />
        </div>
        @foreach ($carousels as $key => $carousel)
            @if ($key != 0)
                <div class="carousel-item">
                    <img src="{{ asset('storage/upload/' . $carousel->name) }}" class="d-block w-100" alt="..." />
                </div>
            @endif
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- !:: Appointment -->
<div class="appointment">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>High-class specialists are ready to help you at any time!</h2>
                <h3>1660 2152 777 (Toll Free)</h3>
            </div>
        </div>
    </div>
</div>

<!-- ::Medical Specialist -->
@include('include.doctor-carousel')

<!--!:: Equipments -->
@include('include.equipment')

<!-- !:: BMI Calculator -->
<section id="bmi__calculator">
    <div class="container">
        <div class="bmi__calculator">
            <div class="bmi_cal">
                <div class="warpper">
                    <input class="radio" id="one" name="group" type="radio" checked />
                    <input class="radio" id="two" name="group" type="radio" />

                    <div class="tabs">
                        <label class="tabc" id="one-tab" for="one">Standard</label>
                        <label class="tabc" id="two-tab" for="two">Metric</label>
                    </div>
                    <div class="panels">
                        <div class="panel" id="one-panel">
                            <!-- <div class="panel-title">Why Learn CSS?</div> -->
                            <form>
                                <div class="">
                                    <label for="inputheight">Your Height:</label>
                                    <br />
                                    <input min="0" type="number" class="cal__input" id="standard_ft"
                                        placeholder="( feets )" />
                                    <!-- <label for=""> &nbsp </label> -->
                                    <input min="0" type="number" class="cal__input" id="standard_inch"
                                        placeholder="( inches )" />
                                </div>

                                <div class="">
                                    <label for="inputweight">Your Weight:</label>
                                    <br />
                                    <input min="0" type="number" class="cal__input" id="standard_pd"
                                        placeholder="( pounds )" />
                                </div>

                                <button id="standard_calculate" type="submit" class="">
                                    Calculate
                                </button>

                                <!-- ::Result  -->
                                <div id="standard_result_div" class="result-holder" style="display: none">
                                    <div class="result-box">
                                        <div class="form-group">
                                            <label for="result" class="result">Your BMI:</label>
                                            <div class="result">
                                                <h2 id="standard_result"></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel" id="two-panel">
                            <!-- <div class="panel-title">Take-Away Skills</div> -->
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputheight">Your Height:</label>
                                        <br />
                                        <input min="0" type="number" class="cal__input" id="metric_cm"
                                            placeholder="( centimeters )" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputweight">Your Weight:</label>
                                    <br />
                                    <input min="0" type="number" class="cal__input" id="metric_kg"
                                        placeholder="( kilograms )" />
                                </div>
                                <button id="metric_calculate" type="submit" class="">
                                    Calculate
                                </button>
                                <!-- Result  -->
                                <div id="metric_result_div" class="result-holder" style="display: none">
                                    <div class="result-box">
                                        <div class="form-group">
                                            <label for="result" class="result">Your BMI:</label>
                                            <div class="result">
                                                <h2 id="metric_result"></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bmi_info">
                <div class="bmi__info__holder">
                    <h1 class="bmi__info__holder__title">BMI Categories:</h1>
                    <p>Underweight = < 18.5</p>
                            <p>Normal weight = 18.5–24.9</p>
                            <p>Overweight = 25–29.9</p>
                            <p>Obesity = BMI of 30 or greater</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonial-slider">
    <h3 class="text-center">Our Patient Say..</h3>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner py-5 text-center">
            @foreach ($testimonials as $key => $testimonial)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <i class="fa-solid fa-quote-right fs-1 text-danger"></i>
                    <figure class="text-cent col-md-6 offset-md-3 mt-4">
                        <blockquote class="blockquote">
                            <p>
                                {!! $testimonial->content !!}
                            </p>
                        </blockquote>
                        @foreach ($testimonial->images as $image)
                            <img src="{{ asset('storage/upload/' . $image->name) }}" alt="" class="testimonial-pic" />
                        @endforeach
                        <figcaption class="blockquote-footer mt-2">{{ $testimonial->title }}</figcaption>
                    </figure>
                </div>
            @endforeach
        </div>
    </div>
</section>

@include('include.footer') --}}
