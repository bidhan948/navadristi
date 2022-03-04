@section('title', 'Gallery')
@section('is_active_gallery', 'active')
@include('include.header')
@include('include.nav')
<!-- Second Page Start  -->
<section id="page" class="py-4">
    <div class="container">
        <div class="row">
            <h2>Gallery</h2>
            <div class="page_body mt-4">
                <div class="gallery-box">
                    @if($galleries->count() > 0)
                        @foreach ($galleries as $gallery)
                            <!-- gallery -->
                            <div class="gallery">
                                <div class="imgbox">
                                    <a href="{{ route('gallery.slug', $gallery->slug) }}">
                                        <img src="{{ asset('storage/upload/' . $gallery->images[0]->name) }}" alt="" />
                                    </a>
                                </div>
                                <div class="detail">
                                    <h3>
                                        {{ $gallery->title }} <br />
                                        <span> {{ $gallery->images->count() }} Photos </span>
                                    </h3>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- !:: Footer Section  -->
@include('include.footer')
