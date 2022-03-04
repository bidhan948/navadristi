@extends('layouts.main')
@section('title', 'Gallery')
@section('is_active_gallery', 'active')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Gallery') }}</p>
                </div>
                <div class="col-md-6 text-right" style="margin-bottom:-5px;">
                    <p class=""><a href="{{ route('gallery.create') }}" class="btn btn-sm btn-primary"><i
                                class="fas fa-plus px-1"></i>{{ __('Add gallery') }}</a></p>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('S.no') }}</th>
                        <th class="text-center">{{ __('Album name') }}</th>
                        <th class="text-center">
                            {{ __('Edit') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galleries as $key => $gallery)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">
                                <a href="{{ route('gallery.show', $gallery) }}"
                                    class="text-capitalize">{{ $gallery->title }}</a>
                            </td>
                            <td class="text-center"> <a href="{{ route('gallery.edit', $gallery) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="fas fa-pen px-1"></i> Edit
                                </a></td>
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
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
