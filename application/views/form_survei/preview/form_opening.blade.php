@extends('include_backend/_template')

@php
$ci = get_instance();
@endphp

@section('style')
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
@endsection

@section('content')


<div class="container mt-5 mb-5" style="font-family: nunito;">
    <div class="text-center" data-aos="fade-up">
        <div id="progressbar" class="mb-5">
            <li id="account"><strong>Data Responden</strong></li>
            <li id="personal"><strong>Pertanyaan Survei</strong></li>
            @if($status_saran == 1)
            <li id="payment"><strong>Saran</strong></li>
            @endif
            <li id="completed"><strong>Completed</strong></li>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow" data-aos="fade-up">

                @if($manage_survey->img_benner == '')
                <img class="card-img-top" src="{{ base_url() }}assets/img/site/page/banner-survey.jpg" alt="new image" />
                @else
                <img class="card-img-top shadow" src="{{ base_url() }}assets/klien/benner_survei/{{$manage_survey->img_benner}}" alt="new image">
                @endif

                <div class="card-body">
                    <div>
                        @php
                        $slug = $ci->uri->segment(2);

                        $data_user = $ci->db->query("SELECT *
                        FROM manage_survey
                        JOIN users ON manage_survey.id_user = users.id
                        WHERE slug = '$slug'")->row();
                        @endphp

                        {!! $data_user->deskripsi_opening_survey !!}

                        <br>

                        @if($manage_survey->is_lampiran == 1 && $manage_survey->file_lampiran != '')
                        <span class="fw-bold text-primary"><b>{{$manage_survey->label_lampiran}}</b></span>
                        <div class="card card-body">
                            <object type="application/pdf" data="{{ base_url() . 'assets/klien/files/lampiran/' . $manage_survey->file_lampiran }}" width="100%" height="400"></object>
                        </div>
                        @endif
                    </div>
                    <br><br>
                    {!! anchor(base_url() . $ci->session->userdata('username') . '/' . $ci->uri->segment(2) .
                    '/form-survei/data-responden', 'IKUT SURVEI',
                    ['class' => 'btn btn-warning btn-block font-weight-bold shadow']) !!}

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('javascript')

@endsection