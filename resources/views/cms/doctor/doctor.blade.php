@extends('layouts.main')
@section('title', 'Doctor')
@section('menu_show', 'menu-open')
@section('menu_open', 'menu-open')
@section('s_child_setting_formula', 'block')
@section('setting_doctor', 'active')
@section('main_content')
    <div class="card text-sm " id="app">
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
                        <th class="text-center">{{ __('Doctor name') }}</th>
                        <th class="text-center">{{ __('order') }}</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($doctors as $key => $doctor)
                        @if ($doctor->title != 'Department')
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $doctor->title }}</td>
                                    <td class="text-center">
                                        @if($key == 1)
                                            <span class="text-danger" style="font-size:1.3rem;" v-on:click="downUp('{{$doctor->id}}')">
                                                <i class='bx bx-down-arrow-alt'></i>
                                            </span>
                                        @elseif($key != $doctors->count()-1)
                                            <span class="text-danger" style="font-size:1.3rem;" v-on:click="downUp('{{$doctor->id}}')">
                                                <i class='bx bx-down-arrow-alt'></i>
                                            </span>
                                            <span class="text-success" style="font-size:1.3rem;" v-on:click="up('{{$doctor->id}}')">
                                                <i class='bx bx-up-arrow-alt'></i>
                                            </span>
                                        @else
                                            <span class="text-success" style="font-size:1.3rem;" v-on:click="up('{{$doctor->id}}')">
                                                <i class='bx bx-up-arrow-alt'></i>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center"><a href="{{ route('doctor.edit', $doctor) }}"
                                            class="btn btn-sm btn-primary">Edit <i
                                                class="fa-solid fa-pen-to-square px-1"></i></a> </td>
                                </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
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
              
            },
            methods: {
               downUp : function(param){
                   let vm = this;
                    axios.get("{{ route('api.downUp') }}", {
                            params: {
                                doctorId: param
                            }
                        })
                        .then(function(response) {
                            alert('Doctor position align successfuly');
                            window.location.href = "https://neurohospital.com.np/admin/doctor";
                        })
                        .catch(function(error) {
                            alert("Image removed successfully");
                        });
               },
               up: function(param){
                      axios.get("{{ route('api.up') }}", {
                            params: {
                                doctorId: param
                            }
                        })
                        .then(function(response) {
                             alert('Doctor position align successfuly');
                            window.location.href = "https://neurohospital.com.np/admin/doctor";
                        })
                        .catch(function(error) {
                            alert("Image removed successfully");
                        });
               }
            },
            mounted() {
             
            }
        })
    </script>
@endsection
