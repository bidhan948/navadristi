@section('title', 'Doctor | Neuro Cardio and Multi Specialty Hospital - Biratnagar')
@section('is_active_doctor', 'active')
@include('include.header')
@include('include.nav')
<!-- Second Page Start  -->
<section id="page" class="py-4">
    <div class="container">
        <div class="row">
            <h2>Doctors</h2>
            <!-- page body -->
            <div class="page_body py-4">
                <div class="row">
                    <div class="container d-flex flex-wrap">
                        @foreach ($images as $doctor)
                            @if ($doctor->Parents->count() > 0)
                                @foreach ($doctor->Parents as $doctorName)
                                    @php
                                        $content = json_decode($doctorName->metaPage[0]->content);
                                    @endphp
                                    <!-- card 1 -->
                                    <div class="doctor_card">
                                        <div class="content">
                                            @foreach ($doctorName->load('images')->images as $image)
                                                @if (!$image->is_banner)
                                                    <div class="imgBox">
                                                        <img src="{{ asset('storage/upload/' . $image->name) }}"
                                                            alt="" />
                                                    </div>
                                                @endif
                                            @endforeach
                                            <div class="contentBox">
                                                <h3>{{ $doctorName->title }}</h3>
                                                <h4> {{ $content->speciality }}</h4>
                                                <p>NMC No. : {{ $content->nmc_no }}</p>
                                                <button class="doctor-cat" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $doctorName->id }}">
                                                    View More
                                                </button>
                                                <!-- Modal -->
                                            </div>
                                        </div>
                                        <ul class="sci">
                                            <li style="--i: 1">
                                                <a href="{{ $content->facebook_link ?? '' }}" target="_blank">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li style="--i: 2">
                                                <a href="{{ $content->twitter_link ?? '' }}" target="_blank">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li style="--i: 3">
                                                <a href="{{ $content->instagram_link ?? '' }}" target="_blank">
                                                    <i class="fa-brands fa-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="modal fade" id="exampleModal{{ $doctorName->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="doctor_detail_popup">
                                                        <div class="pop_left">
                                                            <div class="inner_left_pop">
                                                                @foreach ($doctorName->load('images')->images as $image)
                                                                    @if (!$image->is_banner)
                                                                        <div class="imgBox">
                                                                            <img src="{{ asset('storage/upload/' . $image->name) }}"
                                                                                alt="" />
                                                                        </div>
                                                                    @endif
                                                                @endforeach

                                                                <div class="content">
                                                                    <h3>{{ $doctorName->title }}</h3>
                                                                    <div class="nmc-no">
                                                                        NMC No. : <span> {{ $content->nmc_no }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="pop_center">
                                                            <div>
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <td class="title">Department</td>
                                                                        <td>{{ $doctor->title }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="title">Designation</td>
                                                                        <td>{{ $content->speciality ?? '' }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="title">Education</td>
                                                                        <td>{!! $content->education ?? '' !!}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="title">Past Affiliation</td>
                                                                        <td>{!! $content->past_affilation ?? '' !!}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="title">Membership</td>
                                                                        <td>{!! $content->membership ?? '' !!}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="pop_right">
                                                            <div>
                                                                <h3 class="title">OPD Time</h3>
                                                                <div class="opd-time">
                                                                    <table>
                                                                        <tr>
                                                                            <td class="day">Sunday</td>
                                                                            <td>{{ ($content->sunday_start ?? '') . ' - ' . ($content->sunday_end ?? '') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="day">Monday</td>
                                                                            <td>{{ ($content->monday_start ?? '') . ' - ' . ($content->monday_end ?? '') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="day">Tuesday</td>
                                                                            <td>{{ ($content->tuesday_start ?? '') . ' - ' . ($content->tuesday_end ?? '') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="day">Wednesday</td>
                                                                            <td>{{ ($content->wednesday_start ?? '') . ' - ' . ($content->wednesday_end ?? '') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="day">Thrusday</td>
                                                                            <td>{{ ($content->thursday_start ?? '') . ' - ' . ($content->thursday_end ?? '') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="day">Friday</td>
                                                                            <td>{{ ($content->friday_start ?? '') . ' - ' . ($content->friday_end ?? '') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="day">Saturday</td>
                                                                            <td>{{ ($content->saturday_start ?? '') . ' - ' . ($content->saturday_end ?? '') }}
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- page body end -->
        </div>
    </div>
</section>
<!-- !:: Footer Section  -->
@include('include.footer')
