@extends('layouts.main')
@section('title', 'Testimonial')
@section('menu_show_slider', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('setting_testimonial', 'active')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Add testimonial') }}</p>
                </div>
                <div class="col-md-6 text-right" style="margin-bottom:-5px;">
                    <a href="{{ route('testimonial.create') }}" class="btn btn-sm btn-primary">Add testimonial<i
                            class="fas fa-plus px-1"></i></a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">S.no</th>
                        <th class="text-center">{{ __('Title') }}</th>
                        <th class="text-center">{{ __('testimonial image') }}</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testimonials as $key => $testimonial)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $testimonial->title }}</td>
                            <td class="text-center">
                                <a href="{{ asset('storage/upload/' . ($testimonial->images == null ? '' : $testimonial->images[0]->name)) }}"
                                    target="_blank">
                                    <img src="{{ asset('thumbnails/' . ($testimonial->images == null ? '' : $testimonial->images[0]->name)) }}"
                                        alt="" height="50">
                                </a>
                            </td>
                            <td class="text-center"><a href="{{ route('testimonial.edit', $testimonial) }}"
                                    class="btn btn-success btn-sm"><i class="fas fa-pen px-1"></i>Edit</a></td>
                        </tr>
                    @endforeach
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
