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
            <li class="active" id="account"><strong>Data Responden</strong></li>
            <li class="active" id="personal"><strong>Pertanyaan Survei</strong></li>
            @if($status_saran == 1)
            <li class="active" id="payment"><strong>Saran</strong></li>
            @endif
            <li class="active" id="completed"><strong>Completed</strong></li>
        </div>
    </div>
    <br>
    <br>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow mb-5" data-aos="fade-up">
                @if($manage_survey->img_benner == '')
                <img class="card-img-top" src="{{ base_url() }}assets/img/site/page/banner-survey.jpg"
                    alt="new image" />
                @else
                <img class="card-img-top shadow"
                    src="{{ base_url() }}assets/klien/benner_survei/{{$manage_survey->img_benner}}" alt="new image">
                @endif
                <div class="card-body">

                    <div class="text-center">

                        <i class="fa fa-check-circle" style="font-size: 72px; color: #32CD32;"></i>

                        <br>
                        <br>
                        <br>


                        <div class="font-weight-bold" style="font-size: 15px;">
                            Terima kasih atas kesediaannya dan partisipasinya untuk mengisi kuesioner
                            <?php echo $manage_survey->survey_name ?>.
                            <br>
                            Saran dan penilaian Saudara memberikan konstribusi yang sangat berarti bagi
                            peningkatan instansi kami.
                        </div>

                        <br>
                        <br>
                        <br>
                        <a class="btn btn-warning btn-block"
                            href="<?php echo base_url() . $ci->session->userdata('username') . '/' . $ci->uri->segment(2) . '/form-survei/saran' ?>">Kembali</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('javascript')
<script type="text/javascript">
$(document).ready(function() {
    let timerInterval
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: 'Data survei anda berhasil disimpan.',
        confirmButtonColor: '#32CD32',
        confirmButtonText: 'Baik, saya mengerti',
        timer: 6000,
        footer: '<span style="color:d3d3d3;">Data yang anda inputkan kami simpan dengan aman dan tidak kami bagikan kepada yang tidak memiliki kepentingan.</span>',

    }).then((result) => {
        if (
            result.dismiss === Swal.DismissReason.timer
        ) {
            console.log('I was closed by the timer')
        }
    });
});
</script>
@endsection