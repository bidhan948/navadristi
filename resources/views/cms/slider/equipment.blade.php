@extends('layouts.main')
@section('title', 'Equipments')
@section('menu_show_slider', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_slider', 'block')
@section('setting_equipment', 'active')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Add Equipment') }}</p>
                </div>
                <div class="col-md-6 text-right" style="margin-bottom:-5px;">
                    <a href="{{ route('equipment.create') }}" class="btn btn-sm btn-primary">Add Equipment<i
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
                        <th class="text-center">{{ __('Equipment image') }}</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipments->Parents as $key => $equipment)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $equipment->title }}</td>
                            <td class="text-center">
                                <a href="{{ asset('storage/upload/' . ($equipment->images == null ? '' : $equipment->images[0]->name)) }}"
                                    target="_blank">
                                    <!--<img src="{{ asset('thumbnails/' . ($equipment->images == null ? '' : $equipment->images[0]->name)) }}"-->
                                    <!--    alt="">-->
                                    <img src="{{ asset('storage/upload/' . ($equipment->images == null ? '' : $equipment->images[0]->name)) }}"
                                        alt="" height="100">
                                </a>
                            </td>
                            <td class="text-center"><a href="{{ route('equipment.edit', $equipment) }}"
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
