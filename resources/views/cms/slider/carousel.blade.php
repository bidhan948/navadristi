@extends('layouts.main')
@section('title', 'Speciality')
@section('menu_show_slider', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('setting_carousel', 'active')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Add doctor') }}</p>
                </div>
                <div class="col-md-6 text-right" style="margin-bottom:-5px;">
                    <a href="{{ route('carousel.create') }}" class="btn btn-sm btn-primary">Add <i
                            class="fas fa-plus px-1"></i></a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('Carousel image') }}</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">
                            @foreach ($carousels->images as $image)
                                <a href="{{ asset('storage/upload/' . $image->name) }}" target="_blank">
                                    <img src="{{ asset('thumbnails/' . $image->name) }}" alt="" class="px-1">
                                    <img src="{{ asset('storage/thumbnails/' . $image->name) }}" alt="" class="px-1" height="50">
                                </a>
                            @endforeach
                        </td>
                        <td class="text-center">
                            <a href="{{ route('carousel.edit', $page) }}" class="btn btn-sm btn-success"><i
                                    class="fas fa-edit px-1"></i>{{ __('Edit') }}</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
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
