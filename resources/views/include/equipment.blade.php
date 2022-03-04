<section class="carousel_se_01" id="equipments">
    <div class="container-fluid">
        <div class="container pt-5">
            <div class="row">
                <div class="col-md-12 px-0 pt-1" style="">
                    <div class="col-sm-12 text-center">
                        <h2>Our Equipments</h2>
                    </div>
                    <div class="col-md-12 px-0 p-t-30">
                        <div class="owl-carousel carousel_se_01_carousel owl-theme">
                            <!-- 1 -->
                            @foreach ($equipments as $equipment)
                                <div class="item">
                                    <div class="col-md-12 wow fadeInUp">
                                        <div class="main_services text-center" style="">
                                            <a href="#">
                                                <h3 class="mt-3">{{ $equipment->title }}</h3>
                                                @foreach ($equipment->images as $image)
                                                    <img src="{{ asset('storage/upload/' . $image->name) }}" alt="" />
                                                @endforeach
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
