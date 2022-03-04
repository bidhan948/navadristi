@extends('layouts.main')
@section('title', 'Speciality')
@section('menu_show_speciality', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_speciality', 'block')
@section('setting_speciality', 'active')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Add doctor') }}</p>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('S.no') }}</th>
                        <th class="text-center">{{ __('Speciality') }}</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($specialities->page as $key => $speciality)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $speciality->title }}</td>
                            <td class="text-center"><a href="{{ route('speciality.edit', $speciality) }}"
                                    class="btn btn-sm btn-primary">Edit <i class="fa-solid fa-pen-to-square px-1"></i></a>
                            </td>
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
