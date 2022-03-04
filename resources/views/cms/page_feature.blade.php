@extends('layouts.main')
@section('title', 'page feature')
@section('is_active_page_feature', 'active')
@section('main_content')

    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Page list') }}</p>
                </div>
                <div class="
                        col-md-6 text-right">
                    <a class="btn text-white btn-sm btn-primary" href="{{ route('page_feature.create') }}">
                        {{ __('Add page feature') }}</a>
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
                    @foreach ($pages as $key => $page)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $page->title ?? $page->pageType->title }}</td>
                            <td class="text-center"><a data-toggle="modal" data-target="#modal-lg{{ $page->id }}"
                                    class="btn btn-sm btn-primary text-white">
                                    <i class="fas fa-edit px-1"></i>
                                    {{ __('Edit') }}</a>
                                {{-- modal for adding user status --}}
                                <div class="modal fade text-sm" id="modal-lg{{ $page->id }}">
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
                                                <form method="post" action="{{ route('page.update', $page) }}">
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
                                                                <input type="text" value="{{ $page->title }}"
                                                                    name="title"
                                                                    class="form-control  @error('title') is-invalid @enderror">
                                                                @error('title')
                                                                    <p class="invalid-feedback" style="font-size: 1rem">
                                                                        {{ __('name field is required') }}
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                            <div class="input-group input-group-sm">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        {{ __('Page title') }} <span
                                                                            class="text-danger px-1 font-weight-bold">*</span>
                                                                    </span>
                                                                </div>
                                                                <select name="page_type_id" id=""
                                                                    class="form-control form-control-sm @error('page_type_id') is-invalid @enderror">
                                                                    <option value="">{{ __('---Please select---') }}
                                                                    </option>
                                                                    @foreach ($page_types as $page_type)
                                                                        <option value="{{ $page_type->id }}">
                                                                            {{ $page->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('page_type_id')
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
    <script>
        window.onload = function() {
            if ({{ $errors->any() }}) {
                $('#modal-lg').modal('show');
            }
        }
    </script>
@endsection
