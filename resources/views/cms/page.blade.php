@extends('layouts.main')
@section('title', 'page')
@section('is_active_page', 'active')
@section('main_content')

    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Page list') }}</p>
                </div>
                <div class="
                        col-md-6 text-right">
                    <a class="btn text-white btn-sm btn-primary" data-toggle="modal" data-target="#modal-lg">
                        {{ __('Add page') }}</a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('S.no') }}</th>
                        <th class="text-center">{{ __('page') }}</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page_types as $key => $page_type)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">
                                @if ($page_type->slug == 'about-us')
                                    <a href="{{ route('about-us.admin') }}">{{ $page_type->title }}</a>
                                @elseif($page_type->slug == 'footer')
                                    <a href="{{ route('footer') }}">{{ $page_type->title }}</a>
                                @elseif($page_type->slug == 'home')
                                    {{ $page_type->title }}
                                @elseif($page_type->slug == 'news-and-events')
                                    {{ $page_type->title }}
                                @elseif($page_type->slug == 'doctor')
                                    {{ $page_type->title }}
                                @else
                                    <a href="{{ route('admin', $page_type->title) }}">{{ $page_type->title }}</a>
                                @endif
                            </td>
                            <td class="text-center"><a data-toggle="modal" data-target="#modal-lg{{ $page_type->id }}"
                                    class="btn btn-sm btn-primary text-white">
                                    <i class="fas fa-edit px-1"></i>
                                    {{ __('Edit') }}</a>
                                {{-- modal for adding user status --}}
                                <div class="modal fade text-sm" id="modal-lg{{ $page_type->id }}">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="">{{ __('Add User') }}</h5>
                                                <button type=" button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('page.update', $page_type) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="input-group input-group-sm">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        {{ __('Page title') }} <span
                                                                            class="text-danger px-1 font-weight-bold">*</span>
                                                                    </span>
                                                                </div>
                                                                <input type="text" value="{{ $page_type->title }}"
                                                                    name="title"
                                                                    class="form-control  @error('title') is-invalid @enderror">
                                                                @error('title')
                                                                    <p class="invalid-feedback" style="font-size: 1rem">
                                                                        {{ __('name field is required') }}
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-4 ">
                                                            <button type="submit" class="btn btn-primary btn-sm"><i
                                                                    class="fas fa-plus px-1"></i>
                                                                Submit</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                {{-- end of modal for adding user status --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    {{-- modal for adding user status --}}
    <div class="modal fade text-sm" id="modal-lg">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="">{{ __('Add User') }}</h5>
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('page.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('Page title') }} <span
                                                class="text-danger px-1 font-weight-bold">*</span>
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
                            <div class="col-4 ">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus px-1"></i>
                                    Submit</button>
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
    <script>
        window.onload = function() {
            if ({{ $errors->any() }}) {
                $('#modal-lg').modal('show');
            }
        }
    </script>
@endsection
