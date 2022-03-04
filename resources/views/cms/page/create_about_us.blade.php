@extends('layouts.main')
@section('title', 'About us')
@section('is_active_page', 'active')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Add about-us') }}</p>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="post" action="{{ route('about-us.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Title') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <input type="text" value="" name="title"
                                class="form-control  @error('title') is-invalid @enderror">
                            @error('title')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('Speciality field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <textarea name="content" id="editor1"></textarea>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Our mission') }} 
                                </span>
                            </div>
                            <textarea name="our_mission" id="editor2"></textarea>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Quality & policy') }} 
                                </span>
                            </div>
                            <textarea name="quality_and_policy" id="editor3"></textarea>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Feature plans') }} 
                                </span>
                            </div>
                            <textarea name="feature_plan" id="editor4"></textarea>
                        </div>
                    </div>

                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Excutive director') }}
                                </span>
                            </div>
                            <input type="text" value="" name="excutive_director"
                                class="form-control  @error('excutive_director') is-invalid @enderror">
                            @error('excutive_director')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('excutive director field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Excutive director image') }}
                                </span>
                            </div>
                            <input type="file" value="" name="excutive_director_image"
                                class="form-control  @error('excutive_director_image') is-invalid @enderror">
                            @error('excutive_director_image')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('excutive director image field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Excutive director detail') }}
                                </span>
                            </div>
                            <input type="text" value="" name="excutive_director_detail"
                                class="form-control  @error('excutive_director_detail') is-invalid @enderror">
                            @error('excutive_director_detail')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('excutive director field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Excutive') }}
                                </span>
                            </div>
                            <input type="text" value="" name="excutive"
                                class="form-control  @error('excutive') is-invalid @enderror">
                            @error('excutive')
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
                                    {{ __('Excutive image') }}
                                </span>
                            </div>
                            <input type="file" value="" name="excutive_image"
                                class="form-control  @error('excutive_image') is-invalid @enderror">
                            @error('excutive_image')
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
                                    {{ __('Excutive detail') }}
                                </span>
                            </div>
                            <input type="text" value="" name="excutive_detail"
                                class="form-control  @error('excutive_detail') is-invalid @enderror">
                            @error('excutive_detail')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('excutive detail field is required') }}
                                </p>
                            @enderror
                        </div>
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

@section('scripts')
    <script>
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');
        CKEDITOR.replace('editor3');
        CKEDITOR.replace('editor4');
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
    <script>
        window.onload = function() {
            if ({{ $errors->any() }}) {
                $('#modal-lg').modal('show');
            }
        }
    </script>
@endsection
