@section('title', 'About us')
@section('is_active_about-us', 'active')
@include('include.header')
@include('include.nav')
<section id="page" class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 page-body">
                <h2 class="page-title">{{ $aboutUs->title }}</h2>
                <div class="page-content">
                    {!! $content['content'] !!}
                    <!-- Features Section -->
                    <div class="feartures-section">
                        <div class="row">
                            <!-- features one  -->
                            <div class="col-md-4">
                                <div class="featuresContainer">
                                    <div class="featuresTitle post__01">Our Mission</div>
                                    <div class="featuresContent">
                                        <p>
                                            {!! $content['our_mission'] !!}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="featuresContainer">
                                    <div class="featuresTitle post__02">Quality & Policy</div>
                                    <div class="featuresContent">
                                        <p>
                                            {!! $content['quality_and_policy'] !!}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="featuresContainer">
                                    <div class="featuresTitle post__03">Future Plans</div>
                                    <div class="featuresContent">
                                        {!! $content['feature_plan'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 side-bar">
                <!-- side box 3 -->
                <div class="side-box">
                    <ul>
                        <li><a href="#popup1"> Message from Executive Director </a></li>
                        <li><a href="#popup2"> Message from Managing Director </a></li>
                    </ul>
                    <!-- Pop up Box -->
                    <div id="popup1" class="overlay">
                        <div class="popup">
                            <a class="close" href="#">&times;</a>
                            <div class="message_from">
                                <div class="message_info">
                                    <div class="img_box">
                                        <img src="{{ asset('storage/upload/' . $content['excutive_director_image']) }}"
                                            alt="" />
                                    </div>
                                    <h4>{{ $content['excutive_director'] }}</h4>
                                    <p>{{ $content['excutive_director_detail'] }}</p>
                                </div>
                                <div class="message-cont">
                                    <h3>Message from Executive Director</h3>
                                    <p>
                                        {!! $content['excutive_director_message'] ?? '' !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- pop up 2 -->
                    <div id="popup2" class="overlay">
                        <div class="popup">
                            <a class="close" href="#">&times;</a>
                            <div class="message_from">
                                <div class="message_info">
                                    <div class="img_box">
                                        <img src="{{ asset('storage/upload/' . $content['excutive_image']) }}"
                                            alt="" />
                                    </div>
                                    <h4>{{ $content['excutive'] }}</h4>
                                    <p>{{ $content['excutive_detail'] }}</p>
                                </div>
                                <div class="message-cont">
                                    <h3>Message from Exuctive</h3>
                                    <p>
                                        {!! $content['excutive_message'] ?? '' !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="side-box">
                    <img src="{{ asset('storage/upload/' . $sideBannerImage->images[0]->name) }}" alt="" />
                </div>
            </div>
        </div>
</section>
@include('include.footer')
