@extends('layouts.main')
@section('title', 'Edit carousel')
@section('menu_show_slider', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('setting_carousel', 'active')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Edit Carousel') }}</p>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="post" action="{{ route('carousel.update',$page) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Carousel Image') }}
                                </span>
                            </div>
                            <input type="file" value="" name="image[]"
                                class="form-control  @error('image') is-invalid @enderror" multiple>
                            @error('image')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('Carousel image field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Carousel Image') }}
                                </span>
                            </div>
                            @foreach ($images as $image)
                                <a href="{{ asset('storage/upload/' . $image->name) }}" target="_blank">
                                    <img src="{{ asset('thumbnails/' . $image->name) }}" alt="" class="px-1">
                                    <img src="{{ asset('storage/thumbnails/' . $image->name) }}" alt="" class="px-1" height="50">
                                </a>
                                <input type="hidden" name="old_carousel_image[]" value="{{$image->name}}">
                            @endforeach
                        </div>
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
