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
                        <div class="single-news__item">
                            <div class="news_image">
                                @foreach ($newsEvent->images as $image)
                                    <img src="{{asset('storage/upload/'.$image->name)}}"
                                        alt="Post image" />
                                @endforeach
                            </div>
                            <div class="news_information">
                                <div class="news__date">{{ \Carbon\Carbon::parse($newsEvent->created_at)->diffForHumans() }}</div>
                                <h4 class="news__title">{{$newsEvent->title}}</h4>
                                <div class="news__content">
                                    {!! $newsEvent->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- !:: Footer Section  -->
@include('include.footer')
