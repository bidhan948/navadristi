@section('is_active_specialities', 'active')
@include('include.header')
@include('include.nav')
<!-- Second Page Start  -->

<!-- page body -->
@foreach ($speciality->images as $key => $image)
    @if ($image->is_banner)
        <section id="single_page" class="py-4" style="
                background: linear-gradient(
                    0deg,
                    rgb(255 253 254 / 30%),
                    rgb(255 255 255)
                    ),
                    url('{{ asset('storage/upload/' . $image->name) }}') no-repeat
                    center center;
                opacity: 0.9;
                background-size: cover;
                position: relative;
                ">
    @endif
@endforeach
<div class="overly">
    <div class="container">
        <div class="row">
            <div class="col-md-12 page-body pt-4">
                <h2 class="page-title text-capitalize">{{ $speciality->title }}</h2>
                <div class="page-content">
                    <div class="specility-content-section">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="single_specialities_left">
                                    @foreach ($speciality->images as $key => $image)
                                        @if (!$image->is_banner)
                                            <img src="{{ asset('storage/upload/' . $image->name) }}" alt="" />
                                        @endif
                                    @endforeach
                                    <h2>{{ $speciality->title }}</h2>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="tabs-container">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-10 col-md-10">
                                                <div class="content-container">
                                                    <div class="content active">
                                                        <h3>Introduction</h3>

                                                        {!! $content['home'] !!}

                                                    </div>

                                                    <div class="content">
                                                        <h3>The Team</h3>
                                                        @if ($content['team'] != null)
                                                            @foreach ($content['team'] as $team)
                                                                <img src="{{ asset('storage/upload/' . $team) }}"
                                                                    height="100">
                                                            @endforeach
                                                        @endif
                                                    </div>

                                                    <div class="content">
                                                        <h3>Type of Service</h3>

                                                        {!! $content['type_of_service'] !!}

                                                    </div>
                                                    <div class="content">
                                                        <h3>Gallery</h3>
                                                        <div class="specilities_gallery">
                                                            @if (isset($content['gallery']))
                                                                @foreach ($gallery as $singleGallery)
                                                                    @if ($singleGallery->id == $content['gallery'])
                                                                        <div class="gallery">
                                                                            <div class="imgbox">
                                                                                <a href="{{ route('gallery.slug', $singleGallery->slug) }}"
                                                                                    target="_blank">
                                                                                    @foreach ($singleGallery->load('images')->images as $key => $image)
                                                                                        @if ($key == 0)
                                                                                            <img src="{{ asset('storage/upload/' . $image->name) }}"
                                                                                                alt="">
                                                                                        @endif
                                                                                    @endforeach
                                                                                </a>
                                                                            </div>
                                                                            <div class="detail">
                                                                                <h3>
                                                                                    {{ $singleGallery->title }}
                                                                                    <br>
                                                                                    <span>
                                                                                        {{ $singleGallery->load('images')->images->count() }}
                                                                                        photos
                                                                                    </span>
                                                                                </h3>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="content">
                                                        <h3>Equipment</h3>
                                                        <p>
                                                            @if ($content['equipment'] != null)
                                                                @foreach ($content['equipment'] as $equipment)
                                                                    <img src="{{ asset('storage/upload/' . $equipment) }}"
                                                                        height="100">
                                                                @endforeach
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2">
                                                <div class="tabs">
                                                    <div class="tab_s active">index</div>
                                                    <div class="tab_s">The Team</div>
                                                    <div class="tab_s">Type of Service</div>
                                                    <div class="tab_s">Gallery</div>
                                                    <div class="tab_s">Equipment</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- page body end -->

<!-- !:: Footer Section  -->
@include('include.footer')
