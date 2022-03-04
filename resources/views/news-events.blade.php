@section('title', 'News & events')
@section('is_active_news-and-events', 'active')
@include('include.header')
@include('include.nav')
<!-- Second Page Start  -->
<section id="page" class="py-4">
    <div class="container">
        <div class="row">
            <h2>News & Events</h2>
            <div class="page_body py-4">
                <div class="inner_body">
                    <div class="news_events">
                        <!-- post item 1 -->
                        @foreach ($newsEvents as $newsEvent)
                            <div class="posts__item">
                                <div class="posts__image">
                                    @foreach ($newsEvent->images as $image)
                                        <img src="{{ asset('storage/upload/' . $image->name) }}" alt="">
                                    @endforeach
                                </div>
                                <div class="posts__information">
                                    <div class="posts__date">
                                        {{ \Carbon\Carbon::parse($newsEvent->created_at)->diffForHumans() }}</div>
                                    <div class="posts__title">
                                        <a
                                            href="{{ route('news_and_events.slug', $newsEvent->slug) }}">{{ $newsEvent->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- !:: Footer Section  -->
@include('include.footer')
