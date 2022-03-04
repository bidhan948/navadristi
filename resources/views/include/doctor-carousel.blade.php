    <section id="doctors__section">
    <div class="medical-spec">
        <div class="">
            <h4>Medical Specialists</h4>
        </div>
        <h4>We have the best specialists of the country</h4>
        <p>
            Contact us in any suitable way and make an appointment with the doctor
            whose help you need! Visit us at the scheduled time and get your
            treatment.
        </p>
        <!-- Doctor Section -->
        <div class="container" id="doctor__section">
            <div class="doc-detail-holder">
                <!-- tab item 1 -->
                        @php
                        $i = 0
                        @endphp
                @foreach($doctors as $key => $parent)
                
                @if ($key == 0)
                    <div class="tab tab-active" data-id="tab{{ $key }}">
                        @foreach($parent->load('images')->images as $image)
                         @if($image->is_banner)
                        <img src="{{ asset('storage/upload/' . $image->name) }}" alt="" />
                        @endif
                        @endforeach
                    </div>
                @else
                    <div class="tab" data-id="tab{{ $key }}">
                        <img src="{{ asset('storage/upload/' . $image->name) }}" alt="" />
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="carousel_se_02">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center wow fadeInUp"></div>
                <div class="col-md-12 px-4 pt-0">
                    <div class="owl-carousel carousel_se_02_carousel owl-theme">
                        <!-- 01 -->
                        @foreach ($doctors as $key=> $parent)
                        @php
                            $data = json_decode($parent->metaPage[0]->content,true)
                        @endphp
                                    <div class="tab-a" data-id="tab{{ $key }}">
                                        <div class="item">
                                            <div class="col-sm-12 wow fadeInUp delay-1">
                                                <div class="upper-content">
                                                    <div class="image-content">
                                                        @foreach ($parent->load('images')->images as $image)
                                                            @if (!$image->is_banner)
                                                                <img src="{{ asset('storage/upload/' . $image->name) }}"
                                                                    alt="" />
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="lower-content">
                                                    <div>
                                                        <h3>{{ $parent->title }}</h3>
                                                        <h4>Sr. Con. {{$data['speciality'] ?? ''}} </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- our clients -->
        </div>
    </div>
</section>
