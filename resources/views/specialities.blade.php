@section('title', 'Specialities')
@section('is_active_specialities', 'active')
@include('include.header')
@include('include.nav')
<!-- Second Page Start  -->
<section id="page" class="py-4">
    <div class="container">
        <div class="row">
            <h2>Specialities</h2>
            <!-- page body -->
            <div class="page_body py-4">
                <div class="row">
                    <div class="container d-flex flex-wrap">
                        <!-- card 1 -->
                        @foreach ($speciality as $singleSpeciality)
                            <div class="specialities_card">
                                <div class="content">
                                    <a href="{{ route('speciality.slug', $singleSpeciality->slug) }}">
                                        <div class="imgBox">
                                            @foreach ($singleSpeciality->images as $image)
                                                @if (!$image->is_banner)
                                                    <img src="{{ asset('storage/upload/' . $image->name) }}" alt="" />
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="contentBox">
                                            <h3>{{ $singleSpeciality->title }}</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- page body end -->
        </div>
    </div>
</section>
<!-- !:: Footer Section  -->
@include('include.footer')
