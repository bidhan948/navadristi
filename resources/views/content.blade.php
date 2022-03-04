@section('title', $title)
@section('is_active_' . $title, 'active')
@include('include.header')
@include('include.nav')
<!-- Second Page Start  -->
<section id="page" class="py-4">
    <div class="container">
        <div class="row">
            <h2 class="text-capitalize">{{ $title }}</h2>
            <!-- page body -->
            <div class="page_body py-4">
                <div class="row">
                    <div class="container d-flex flex-wrap">
                        @if ($content)
                        @else
                            {!! $content[0]->content!!}
                        @endif
                    </div>
                </div>
            </div>
            <!-- page body end -->
        </div>
    </div>
</section>
<!-- !:: Footer Section  -->
@include('include.footer')
