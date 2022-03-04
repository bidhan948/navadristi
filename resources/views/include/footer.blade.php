<!-- !:: Footer Section  -->
<footer>
    <div class="container">
        <div class="row">
            <!-- footer Section 1 -->
            <div class="col-lg-2 col-md-2">
                <div class="footer">
                    <h4>Specialities</h4>
                    <div class="footer-body">
                        <ul>
                            @foreach ($specialities as $speciality)
                                <li><a href="#"> {{ $speciality->title }} </a></li>
                            @endforeach
                        </ul>
                        <div class="view_more">
                            <a ahref="#">
                                View More <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer Section 1 -->
            <div class="col-lg-4 col-md-4">
                <div class="footer">
                    <h4>Quick Feedback</h4>
                    <div class="footer-body quick_feedback">
                        <form action="{{ route('contact_us') }}" method="POST" class="feedback_form">
                            @csrf
                            <div class="feedback_name_phone">
                                <div class="name">
                                    <label for="name"> Name </label>
                                    <input type="text" placeholder=" " name="name" />
                                    @error('name')
                                        <p class="text-danger py-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="phone">
                                    <label for="phonenumber"> Phone </label>
                                    <input type="number" placeholder="" name="phone" />
                                    @error('phone')
                                        <p class="text-danger py-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <label for="email">Email</label>
                            <input type="email" placeholder="  " name="email" />
                            @error('email')
                                <p class="text-danger py-1">{{ $message }}</p>
                            @enderror
                            <label for="message"> Message </label>
                            <textarea id="subject" rows="4" name="subject"> </textarea>
                            @error('subject')
                                <p class="text-danger py-1">{{ $message }}</p>
                            @enderror
                            <button id="quick_submit" class="quick_submit" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- footer Section 1 -->
            <div class="col-lg-3 col-md-3">
                <div class="footer">
                    <h4>Facebook Live Feed</h4>
                    <div class="footer-body">
                        <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0"
                                                nonce="m5RihFEx"></script>
                        <div class="fb-page" data-href="https://www.facebook.com/neurohospitalofficial"
                            data-tabs="timeline" data-width="" data-height="360" data-small-header="false"
                            data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="https://www.facebook.com/neurohospitalofficial"
                                class="fb-xfbml-parse-ignore">
                                <a href="https://www.facebook.com/neurohospitalofficial">Neuro Cardio &amp;
                                    Multispeciality Hospital ,
                                    Biratnagar</a>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>

            <!-- footer Section 1 -->
            <div class="col-lg-3 col-md-3">
                <div class="footer">
                    <h4>Health Package</h4>
                    <div class="footer-body">
                        {!! $footer['health_package'] ?? '' !!}
                    </div>
                </div>

                <div class="footer">
                    <h4>Amublance Contact</h4>
                    <div class="footer-body">
                        {!! $footer['ambulance_contact'] ?? '' !!}
                    </div>
                </div>
            </div>

            <!-- Quick Feedback -->
            <div class="contact__us d-flex">
                <div class="contact__us__title">
                    <h2>Contact</h2>
                </div>
                <div class="contact__us__detail">
                    <ul>
                        <li>
                            <h4>Neuro Cardio & Multispecialty Hospital Pvt. Ltd.</h4>
                        </li>

                        <li><i class="fas fa-phone"></i> 021-416267,417484</li>
                        <li>
                            <i class="fas fa-envelope"></i> info@neurohospital.com.np
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i> Jahada Road,
                            Biratnagar-10, Nepal
                        </li>
                    </ul>
                </div>
            </div>
            <!-- quick contact end -->
        </div>
    </div>
    <!-- !:: Copyright -->
    <div class="container" id="copyright">
        <div class="row">
            <div class="col-md-8 col-lg-8 copyright">
                <p>
                    Copyright© <span id="year"></span> Neuro Cardio & Multispecialty
                    Hospital Pvt.Ltd. All right reserved.
                </p>
            </div>
            <div class="col-md-4 col-lg-4 power__by">
                <p>Power by : <a href="#"> PDMT </a></p>
            </div>
        </div>
    </div>
</footer>
<!-- JavaScript Include  -->
<script src="{{ asset('neuro/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('neuro/js/jquery.min.js') }}"></script>
<script src="{{ asset('neuro/js/main.js') }}"></script>
<script src="{{ asset('neuro/js/calculate.js') }}"></script>
<script src="{{ asset('neuro/vendor/owlcarousel/js/owl.carousel.min.js') }}"></script>
</body>

</html><!-- !:: Footer Section  -->
