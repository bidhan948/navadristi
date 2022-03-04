@extends('layouts.main')
@section('title', 'Doctor')
@section('menu_show', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_setting_formula', 'block')
@section('setting_doctor_add', 'active')
@section('main_content')
<style>

</style>
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Add doctor') }}</p>
                </div>
                <div class="col-md-6 text-right" style="margin-bottom:-5px;">
                    <p class=""><a class="btn btn-sm btn-primary text-white" data-toggle="modal"
                            data-target="#modal-lg"><i class="fas fa-plus px-1"></i>{{ __('Add department') }}</a></p>
                </div>
            </div>
        </div>

        {{-- modal for adding user status --}}
        <div class="modal fade text-sm" id="modal-lg">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="">{{ __('Add department') }}</h5>
                        <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('department.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                {{ __('Department name') }} <span
                                                    class="text-danger px-1 font-weight-bold">*</span>
                                            </span>
                                        </div>
                                        <input type="text" value="" name="department_name"
                                            class="form-control  @error('department_name') is-invalid @enderror">
                                        @error('department_name')
                                            <p class="invalid-feedback" style="font-size: 1rem">
                                                {{ __('name field is required') }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 my-2">
                                    <button class="btn btn-sm btn-primary">{{__('Submit')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        {{-- end of modal for adding user status --}}

        <!-- /.card-header -->
        <div class="card-body">
            <form method="post" action="{{ route('doctor.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Doctor name') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <input type="text" value="" name="title"
                                class="form-control  @error('title') is-invalid @enderror">
                            @error('title')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('name field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Department') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <select name="page_id" id=""
                                class="form-control form-control-sm @error('page_id') is-invalid @enderror">
                                <option value="">{{ __('---Please select---') }}
                                    @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->title }}</option>
                                @endforeach
                                </option>

                            </select>
                            @error('page_id')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('Page field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 my-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Speciality') }}
                            </div>
                            <input type="text" value="{{ old('speciality') }}" name="speciality"
                                class="form-control  @error('speciality') is-invalid @enderror">
                            @error('speciality')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('name field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 my-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Doctor image') }} <span class="text-danger px-1 font-weight-bold">*</span>
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
                    <div class="col-6 mB-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Banner image') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <input type="file" value="" name="banner_image"
                                class="form-control  @error('banner_image') is-invalid @enderror">
                            @error('banner_image')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('banner image field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('NMC no') }}
                            </div>
                            <input type="text" value="{{ old('nmc_no') }}" name="nmc_no"
                                class="form-control  @error('nmc_no') is-invalid @enderror">
                            @error('nmc_no')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('name field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Past Affiliation') }}
                                </span>
                            </div>
                            <textarea id="editor3" name="past_affilation"></textarea>
                            @error('educatpast_affilationion')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('Past Affiliation field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Education') }}
                                </span>
                            </div>
                            <textarea name="education" id="editor2"></textarea>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                         <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Membership') }}
                                </span>
                            </div>
                            <textarea id="editor1" name="membership"></textarea>
                            @error('educatpast_affilationion')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('Past Affiliation field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Facebook link') }}
                                </span>
                            </div>
                            <input type="text" value="{{ old('facebook_link') }}" name="facebook_link"
                                class="form-control  @error('facebook_link') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Twitter link') }}
                                </span>
                            </div>
                            <input type="text" value="{{ old('twitter_link') }}" name="twitter_link"
                                class="form-control  @error('twitter_link') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Instagram link') }}
                                </span>
                            </div>
                            <input type="text" value="{{ old('instagram_link') }}" name="instagram_link"
                                class="form-control  @error('instagram_link') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-6"></div>
                    @foreach (config('week') as $week)
                        <div class="col-6 mb-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ $week . ' start time' }}
                                    </span>
                                </div>
                                <input type="time" value="{{ old($week."_start") }}" name="{{ $week . '_start' }}"
                                    class="form-control ">
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ $week . ' End time' }}
                                    </span>
                                </div>
                                <input type="time" value="{{ old($week."_end") }}" name="{{ $week . '_end' }}"
                                    class="form-control ">
                            </div>
                        </div>
                    @endforeach
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
