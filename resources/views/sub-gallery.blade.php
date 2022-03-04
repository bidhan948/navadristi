@section('is_active_gallery', 'active')
@include('include.header')
@include('include.nav')
<!-- Second Page Start  -->
<section id="page" class="py-4">
    <div class="container">
        <div class="row">
            <h2>{{$gallery->title}}</h2>
            <div class="page_body mt-4">
                <div class="gallery-box">
                    <!-- gallery -->
                    <div class="gallery-full">
                        @foreach ($gallery->images as $image)
                            <a href="{{asset('storage/upload/'.$image->name)}}" data-lightbox="models" data-title=""
                                Caption1>
                                <img src="{{asset('storage/upload/'.$image->name)}}" alt="" />
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- !:: Footer Section  -->
@include('include.footer')
<script src="{{ asset('neuro/vendor/lightbox/js/lightbox-plus-jquery.min.js')}}"></script>
