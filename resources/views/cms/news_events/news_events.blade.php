@extends('layouts.main')
@section('title', 'News & Events')
@section('is_active_news_events', 'active')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Add news & events') }}</p>
                </div>
                <div class="col-md-6 text-right" style="margin-bottom:-5px;">
                    <a href="{{ route('news-events.create') }}" class="btn btn-sm btn-primary">Add news & events <i
                            class="fas fa-plus px-1"></i></a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('S.no') }}</th>
                        <th class="text-center">{{ __('title') }}</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($newsEvents as $key => $newsEvent)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $newsEvent->title }}</td>
                            <td class="text-center"><a href="{{ route('news-events.edit', $newsEvent) }}"
                                    class="btn btn-sm btn-primary"><i class="fa fa-pen px-1"></i>Edit</a></td>
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
