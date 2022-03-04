@extends('layouts.main')
@section('title', 'Add Side banner image')
@section('is_active_side_banner_image', 'active')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Add gallery') }}</p>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="post" action="{{ route('side_banner.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Side Banner Image') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <input type="file" value="" name="image"
                                class="form-control  @error('image') is-invalid @enderror" >
                            @error('image')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('Carousel image field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 my-2">
                        <a href="{{asset('storage/upload/'.$image->name)}}" target="_blank">
                            <img src="{{asset('thumbnails/'.$image->name)}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-4 my-2 mx-0">
                    <button type="submit" class="btn btn-primary btn-sm" style="margin-left:-6px;"><i
                            class="fas fa-plus px-1"></i>
                        Submit</button>
                </div>
        </div>

        </form>
    </div>
    <!-- /.card-body -->
    </div>
@endsection

