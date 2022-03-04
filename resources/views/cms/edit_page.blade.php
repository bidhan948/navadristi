@extends('layouts.main')
@section('title', $slug)
@section('is_active_page', 'active')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Edit content to ' . $slug) }}</p>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="post" action="{{ route('content.update', $slug) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 mb-3">
                        <textarea name="content" id="editor1">{!! $page->content !!}</textarea>
                    </div>
                </div>
                <input type="hidden" name="slug" value="{{ $slug }}">
                <div class="col-4 my-2 mx-0">
                    <button type="submit" class="btn btn-primary btn-sm" style="margin-left:-6px;"><i
                            class="fas fa-plus px-1"></i>
                        Update</button>
                </div>
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
