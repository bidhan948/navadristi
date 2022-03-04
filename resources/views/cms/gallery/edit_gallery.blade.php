@extends('layouts.main')
@section('title', $gallery->title . ' Album')
@section('is_active_gallery', 'active')
@section('main_content')
    <div class="card text-sm " id="app">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Edit  photos') }}</p>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="post" action="{{ route('gallery.add', $gallery) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('Gallery name') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <input type="text" value="{{ $gallery->title }}" name="title"
                                class="form-control  @error('album') is-invalid @enderror">
                            @error('album')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('Carousel album field is required') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3 delete-image-box">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('image') }}
                                </span>
                            </div>
                            <a target="_blank" v-for=" (image,index) in images">
                                <span class="" v-on:click="removeImage(image.id)">
                                    <i class="fas fa-times"></i>
                                </span>
                                <img v-bind:src="path + image.name" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-4 my-2 mx-0">
                    <button type="submit" class="btn btn-primary btn-sm" style="margin-left:-6px;"><i
                            class="fas fa-plus px-1"></i>
                        update</button>
                </div>
        </div>

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
                path: '{{ asset('storage/thumbnails') }}/',
                imageArr: [],
                page_types: [],
                galleryId: {{ $gallery->id }}
            },
            methods: {
                removeImage: function(imageId) {
                    let vm = this;
                    axios.get("{{ route('api.removeImage') }}", {
                            params: {
                                imageId: imageId
                            }
                        })
                        .then(function(response) {
                            vm.getGalleryImage();
                            alert('Image removed sucessfully');
                        })
                        .catch(function(error) {
                            alert("Image removed successfully");
                        });
                },
                getGalleryImage: function() {
                    let vm = this;
                    axios.get("{{ route('api.getGallery') }}", {
                            params: {
                                galleryId: vm.galleryId
                            }
                        })
                        .then(function(response) {
                            vm.images = response.data;
                        })
                        .catch(function(error) {
                            console.log(error);
                            alert("Some Problem Occured");
                        });
                }
            },
            mounted() {
                let vm = this;
                vm.getGalleryImage();
            }
        })
    </script>
@endsection
