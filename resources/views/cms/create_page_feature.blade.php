@extends('layouts.main')
@section('title', 'Add page feature')
@section('is_active_page_feature', 'active')
@section('main_content')
    <style>
        .green {
            border: 3px solid green;
        }

    </style>
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="" v-on:click="showThumbnailImage">{{ __('Add page feature') }}</p>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body" id="app">
            <form method="post" action="{{ route('page_feature.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Page title') }}
                                </span>
                            </div>
                            <input type="text" value="{{ old('title') }}" name="title"
                                class="form-control  @error('title') is-invalid @enderror">
                            @error('title')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('name field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Page type') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <select v-model="page_type_id" name="page_type_id"
                                class="form-control form-control-sm @error('page_type_id') is-invalid @enderror" required>
                                <option value="">{{ __('---Please select---') }}
                                </option>
                                <option v-for="(page_type,index) in page_types" :value="page_type.id" v-bind:key="index">
                                    @{{ page_type.title }}
                                </option>
                            </select>
                            @error('page_type_id')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('name field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-8 my-3">
                        <div class="row">
                            <div class="col-4">
                                <a href="#" class="btn btn-sm text-white btn-danger mx-1" data-toggle="modal"
                                    data-target="#modal-lg" v-on:click="showThumbnailImage"><i
                                        class="fas fa-upload file px-1"></i>upload
                                    from gallery</a>
                            </div>
                            <div class="col-8" style="margin-left:-55px;">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('upload new') }}
                                        </span>
                                    </div>
                                    <input type="file" name="new_name[]"
                                        class="form-control  @error('name') is-invalid @enderror" multiple>
                                    @error('name')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('image field is required') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-2">
                        <textarea name="content" id="editor1"></textarea>
                    </div>
                    <div class="col-4 mt-2">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus px-1"></i>
                            Submit</button>
                    </div>
                </div>

                {{-- modal for adding user status --}}
                <div class="modal fade text-sm" id="modal-lg">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="">{{ __('Choose image') }}</h5>
                                <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-3 my-2" v-for="(image,index) in images">
                                        <img v-bind:class="[imageArr.includes(image.id) ? 'green' : '']"
                                            v-bind:src="path + image.name" alt="" v-on:click="selectImage(image.id)">
                                        <i class="fas fa-chcek-circle"></i>
                                    </div>
                                    <div class="col-12 my-2">
                                        <a class="btn btn-sm btn-primary text-white" v-on:click="saveImage()"><i
                                                class="px-1 fa fas-floppy-disk"></i>Save </a>
                                    </div>
                                </div>
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
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vue/bundle.js') }}"></script>
    <script>
        new Vue({
            el: "#app",
            data: {
                images: [],
                path: '{{ asset('thumbnails') }}/',
                imageArr: [],
                page_types: [],
                page_type_id: ''
            },
            methods: {
                showThumbnailImage: function() {
                    let vm = this;
                    axios.get("{{ route('api.getAllThumbnail') }}")
                        .then(function(response) {
                            vm.images = response.data;
                        })
                        .catch(function(error) {
                            console.log(error);
                            alert("Some Problem Occured");
                        });
                },
                selectImage: function(image_id) {
                    let vm = this;
                    if (!vm.imageArr.includes(image_id)) {
                        vm.imageArr.push(image_id);
                    } else {
                        var filtered = vm.imageArr.filter(function(value, index, arr) {
                            if (value == image_id) {
                                vm.imageArr.splice(index, 1);
                            }
                        });
                    }
                },
                saveImage: function() {
                    let vm = this;
                    if (vm.imageArr.length == 0) {
                        alert('please select image');
                    } else {
                        if (vm.page_type_id == '') {
                            alert("Please select page type !!");
                        } else {
                            axios.post("{{ route('image.store') }}",{
                                    pageTypeId: vm.page_type_id,
                                    imageArray: vm.imageArr
                                })
                                .then(function(response) {
                                    alert("Image saved successfully");
                                })
                                .catch(function(error) {
                                    console.log(error);
                                    alert("Some Problem Occured");
                                });
                        }
                    }
                }
            },
            mounted() {
                let vm = this;
                axios.get("{{ route('api.getAllPageType') }}")
                    .then(function(response) {
                        vm.page_types = response.data;
                    })
                    .catch(function(error) {
                        console.log(error);
                        alert("Some Problem Occured");
                    });
            }
        })
    </script>
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
