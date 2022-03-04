@extends('layouts.main')
@section('title', 'Edit speciality')
@section('menu_show_speciality', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_speciality', 'block')
@section('setting_speciality', 'active')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Edit speciality') }}</p>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="post" action="{{ route('speciality.update', $speciality) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Speciality name') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <input type="text" value="{{ $speciality->title }}" name="title"
                                class="form-control  @error('title') is-invalid @enderror">
                            @error('title')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('Speciality field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Page') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <select name="page_type_id" id=""
                                class="form-control form-control-sm @error('page_type_id') is-invalid @enderror" readonly>
                                <option value="{{ $pageType == null ? '' : $pageType->id }}">
                                    {{ $pageType == null ? 'NO-SPECIALITY' : $pageType->title }}</option>
                            </select>
                            @error('page_type_id')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('Page field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <textarea name="home" id="editor1">{!! $metaData['type_of_service'] !!}</textarea>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Type of service') }}
                                </span>
                            </div>
                            <textarea name="type_of_service" id="editor2">{!! $metaData['type_of_service'] !!}</textarea>
                            @error('type_of_service')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('Speciality field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('featured_image') }}
                                </span>
                            </div>
                            <input type="file" value="" name="image"
                                class="form-control  @error('image') is-invalid @enderror">
                            @error('image')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('image field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Background Image') }}
                                </span>
                            </div>
                            <input type="file" value="" name="banner_image"
                                class="form-control  @error('banner_image') is-invalid @enderror">
                            @error('banner_image')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('banner_image field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Featured image') }}
                                </span>
                            </div>
                            @foreach ($speciality->images as $image)
                                @if (!$image->is_banner)
                                    <a href="{{ asset('storage/upload/' . $image->name) }}" class=""
                                        target="_blank">
                                        <img src="{{ asset('thumbnails/' . $image->name) }}" class="px-1"
                                            alt="" height="100">
                                    </a>
                                    <input type="hidden" name="old_image" value="{{ $image->name }}">
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Background image') }}
                                </span>
                            </div>
                            @foreach ($speciality->images as $image)
                                @if ($image->is_banner)
                                    <a href="{{ asset('storage/upload/' . $image->name) }}" class=""
                                        target="_blank">
                                        <img class="px-1" src="{{ asset('thumbnails/' . $image->name) }}"
                                            alt="" height="100">
                                    </a>
                                    <input type="hidden" name="old_banner_image" value="{{ $image->name }}">
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Team') }}
                                </span>
                            </div>
                            <input type="file" value="" name="team[]"
                                class="form-control  @error('team') is-invalid @enderror" multiple>
                            @error('team')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('Team field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Equipment') }}
                                </span>
                            </div>
                            <input type="file" value="" name="equipment_image[]"
                                class="form-control  @error('equipment_image') is-invalid @enderror" multiple>
                            @error('equipment_image')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('equipment image field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Team image') }}
                                </span>
                            </div>
                            @if ($metaData['team'])
                                @foreach ($metaData['team'] as $key => $team)
                                    <a href="{{ asset('storage/upload/' . $team) }}" class=""
                                        target="_blank">
                                        <img src="{{ asset('thumbnails/' . $team) }}" class="px-1" alt=""
                                            height="100">
                                    </a>
                                    <input type="hidden" name="old_team_image[]" value="{{ $team }}">
                                @endforeach
                            @endif
                        </div>
                    </div>
                    @if ($metaData['equipment'])
                        <div class="col-6 mb-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ __('Equipment image') }}
                                    </span>
                                </div>
                                @foreach ($metaData['equipment'] as $key => $equipment)
                                    <a href="{{ asset('storage/upload/' . $equipment) }}" class=""
                                        target="_blank">
                                        <img src="{{ asset('thumbnails/' . $equipment) }}" class="px-1" alt=""
                                            height="100">
                                    </a>
                                    <input type="hidden" name="old_equipment_image[]" value="{{ $equipment }}">
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Gallery') }}
                                </span>
                            </div>
                            <select name="gallery" id="" class="form-control form-control-sm">
                                <option value="">{{ __('--select--') }}</option>
                                @foreach ($galleries as $gallery)
                                    <option value="{{ $gallery->id }}"
                                        {{ isset($metaData['gallery']) && $metaData['gallery'] == $gallery->id ? 'selected' : '' }}>
                                        {{ $gallery->title }}
                                    </option>
                                @endforeach
                            </select>
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

@section('scripts')
    <script>
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
