@extends('layouts.main')
@section('title', 'Edit News and events')
@section('is_active_news_events', 'active')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Edit News and events') }}</p>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="post" action="{{ route('news-events.update', $newsEvent) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Title') }} <span class="text-danger font-weight-bold px-1">*</span>
                            </div>
                            <input type="text" value="{{ $newsEvent->title }}" name="title"
                                class="form-control  @error('title') is-invalid @enderror">
                            @error('title')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('testimonial title field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Image') }}
                                </span>
                            </div>
                            <input type="file" value="" name="image"
                                class="form-control  @error('image') is-invalid @enderror">
                            @error('image')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('testimonial image field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Image') }}
                                </span>
                            </div>
                            <img src="{{ asset('storage/upload/' . $newsEvent->images[0]->name) }}" alt="">
                            <input type="hidden" name="old_image" value="{{ $newsEvent->images[0]->name }}">
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <textarea id="editor1" name="content">{!! $newsEvent->content !!}</textarea>
                    </div>
                </div>
                <div class="col-4 my-2 mx-0">
                    <button type="submit" class="btn btn-primary btn-sm" style="margin-left:-6px;"><i
                            class="fas fa-plus px-1"></i>
                        Update</button>
                </div>
        </div>

        </form>
    </div>
    <!-- /.card-body -->
    </div>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('editor1');
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
