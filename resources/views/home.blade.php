@extends('layouts.main')
@section('title', 'Dashboard')
@section('is_active_home', 'active')
@section('main_content')
    {{-- <div class="row mt-2">
        <h2 class="text-center">HELLO</h2>
    </div> --}}


    {{-- Welcome page --}}



    <div class="row pt-2">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row mt-4">
        {{-- box-1 --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info bg-1 d-block">
                <div class="inner">
                    <h3> Welcome Back !</h3>
                    <p>To Dashboard</p>
                </div>
                <div class="icon">
                    <!--<i class="ion ion-bag"></i>-->
                    <i class='bx bx-home-circle d-icon-big'></i>
                    <!--<img src="{{ asset('neuro/images/neuro-logo.png') }}" alt="">-->
                </div>
                <!--<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
        </div>
        
        {{-- box-2 --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info bg-2 d-block">
                <div class="inner">
                    <h3> {{ $doctors->count() - 1 }}</h3>
                    <p> Doctors</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-user-doctor d-icon-big"></i>
                </div>
                
            </div>
        </div>
       
       {{-- box-3 --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info bg-3 d-block">
                <div class="inner">
                    <h3> {{ $specialities->count() - 1 }}</h3>
                    <p> Specialities </p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-stethoscope d-icon-big "></i>
                </div>
                
            </div>
        </div>

        {{-- box-4 --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info bg-4 d-block">
                <div class="inner">
                    <h3> {{ $equipments->count() - 1 }}</h3>
                    <p> Equipments</p>
                </div>
                <div class="icon">
                    <!--<i class="fa-solid fa-stethoscope d-icon-big "></i>-->
                    <i class="fa-solid fa-toolbox d-icon-big"></i>
                </div>
                
            </div>
        </div>

 

     

    </div>
    {{-- table --}}
    <div class="row mt-4">
        <div class="col-lg-6 col-md-6">
            <div class="card doctor-card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title text-bold"> Doctors List</h3>
                    <div class="card-tools">

                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>

                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body d-doctor-list">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="" style="max-width:30px;">{{ __('S.no') }}</th>
                                <th class="">{{ __('Doctor name') }}</th>
                                <th class="" style="max-width:60px;"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctors as $key => $doctor)
                                @if ($doctor->slug != 'department')
                                    <tr>
                                        <td class="">{{ $key }}</td>
                                        <td class="">{{ $doctor->title }}</td>
                                        <td class=""><a href="{{ route('doctor.edit', $doctor) }}"
                                                class="btn btn-sm btn-primary">Edit <i
                                                    class="fa-solid fa-pen-to-square px-1"></i></a> </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Specialities Table --}}
        <div class="col-lg-6 col-md-6">
            <div class="card doctor-card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title text-bold"> Specialities </h3>
                    <div class="card-tools">

                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>

                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body d-doctor-list">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="" style="max-width:30px;">{{ __('S.no') }}</th>
                                <th class="">{{ __('specialities name') }}</th>
                                <th class="" style="max-width:60px;"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($specialities as $key => $speciality)
                                <tr>
                                    <td class="">{{ $key }}</td>
                                    <td class="">{{ $speciality->title }}</td>
                                    <td class=""><a href="{{ route('speciality.edit', $speciality) }}"
                                            class="btn btn-sm btn-primary">Edit <i
                                                class="fa-solid fa-pen-to-square px-1"></i></a> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
