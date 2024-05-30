@extends('include_backend/template_backend')

@php
$ci = get_instance();
@endphp

@section('style')
<link href="{{ TEMPLATE_BACKEND_PATH }}plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="container-fluid">
    @include("include_backend/partials_no_aside/_inc_menu_repository")
    <br>
    <div class="row">
        <div class="col-md-3">
            @include('manage_survey/menu_data_survey')
        </div>
        <div class="col-md-9">

            <div class="card card-custom bgi-no-repeat gutter-b" style="height: 150px; background-color: #1c2840; background-position: calc(100% + 0.5rem) 100%; background-size: 100% auto; background-image: url(/assets/img/banner/rhone-2.svg)" data-aos="fade-down">
                <div class="card-body d-flex align-items-center">
                    <div>
                        <h3 class="text-white font-weight-bolder line-height-lg mb-5">
                            TABULASI & {{strtoupper($title)}}
                        </h3>

                        <span class="btn btn-secondary btn-sm disable">
                            <i class="fa fa-bookmark"></i> <b>{{$jumlah_kuesioner_terisi}} Kuesioner Terisi</b></span>
                    </div>
                </div>
            </div>


            <div class="card card-custom card-sticky" data-aos="fade-down" data-aos-delay="300">

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-hover" cellspacing="0" width="100%" style="font-size: 12px;">
                            <thead class="bg-secondary">
                                <tr>
                                    <th width="5%">No.</th>
                                    <th>Nama Lengkap</th>

                                    @foreach ($unsur->result() as $row)
                                    <th>{{$row->kode_unsur}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>



            <div class="card" data-aos="fade-down" data-aos-delay="300">
                <div class="card-body">

                    <div class="table-responsive">
                        <table width="100%" class="table table-bordered" style="font-size: 12px;">
                            <tr align="center">
                                <th></th>
                                @foreach ($unsur->result() as $value)
                                <th class="bg-primary text-white">{{$value->kode_unsur}}</th>
                                @endforeach
                            </tr>
                            <tr>
                                <th class="bg-light">TOTAL</th>
                                @foreach ($total->result() as $row)
                                <td class="text-center">{{ROUND($row->sum_skor_jawaban,2)}}</td>
                                @endforeach
                            </tr>

                            <tr>
                                <th class="bg-light">Rata-Rata</th>
                                @foreach ($total->result() as $val)
                                <td class="text-center">{{ ROUND($val->rata_rata, 3) }}</td>
                                @endforeach
                            </tr>

                            <!-- <tr>
                                <th class="bg-light">Nilai Per Dimensi</th>
                                @foreach ($rata_rata_per_dimensi->result() as $val)
                                <td class="text-center" colspan="{{$val->jumlah_unsur}}">{{ ROUND($val->rata_rata, 3) }}</td>
                                @endforeach
                            </tr> -->

                            <tr>
                                <th class="bg-light">Nilai Per Unsur</th>
                                @foreach ($total->result() as $val)
                                <td class="text-center">{{ ROUND($val->rata_rata, 3) }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <th class="bg-light">Rata-Rata x Bobot</th>
                                @foreach ($total->result() as $val)
                                @php
                                $nilai_bobot[] = $val->rata_rata_X_bobot;
                                $indeks = array_sum($nilai_bobot);
                                $nilai_konversi = $indeks * 25;
                                $colspan = count($nilai_bobot);
                                @endphp
                                <td class="text-center">{{ ROUND($val->rata_rata_X_bobot, 3) }}</td>
                                @endforeach
                            </tr>

                            <tr>
                                <th class="bg-light">Indeks</th>
                                <th colspan="{{ $colspan }}">{{ROUND($indeks, 3)}}</th>
                            </tr>

                            <tr>
                                <th class="bg-light">Nilai Konversi</th>
                                <th colspan="{{ $colspan }}">{{ROUND($nilai_konversi, 2)}}</th>
                            </tr>

                            <?php 
                            if ($nilai_konversi <= 100 && $nilai_konversi >= 80) {
                                $kategori = 'Sangat Baik';
                                $interpretasi = 'Memiliki tingkat kesadaran keamanan siber yang sangat tinggi';
                            } elseif ($nilai_konversi <= 79.99 && $nilai_konversi >= 50) {
                                $kategori = 'Baik';
                                $interpretasi = 'Memiliki tingkat kesadaran keamanan siber yang tinggi';
                            } elseif ($nilai_konversi <= 49.99 && $nilai_konversi >= 25) {
                                $kategori = 'Kurang Baik';
                                $interpretasi = 'Memiliki tingkat kesadaran keamanan siber yang rendah';
                            } elseif ($nilai_konversi <= 24.99 && $nilai_konversi >= 0) {
                                $kategori = 'Buruk';
                                $interpretasi = 'Memiliki tingkat kesadaran keamanan siber yang sangat rendah';
                            } else {
                                $kategori = 'NULL';
                                $interpretasi = 'NULL';
                            } ?>

                            <tr>
                                <th class="bg-light">Kategori</th>
                                <td colspan="{{ $colspan }}"><b>{{$kategori}}</b><br>{{$interpretasi}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ TEMPLATE_BACKEND_PATH }}plugins/custom/datatables/datatables.bundle.js"></script>

<script>
    $(document).ready(function() {
        table = $('#table').DataTable({

            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "Semua data"]
            ],
            "pageLength": 5,
            "order": [],
            "language": {
                "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
            },
            "ajax": {
                "url": "<?php echo base_url() . $ci->session->userdata('username') . '/' . $ci->uri->segment(2) . '/olah-data/ajax-list' ?>",
                "type": "POST",
                "data": function(data) {}
            },

            "columnDefs": [{
                "targets": [-1],
                "orderable": false,
            }, ],

        });
    });

    $('#btn-filter').click(function() {
        table.ajax.reload();
    });
    $('#btn-reset').click(function() {
        $('#form-filter')[0].reset();
        table.ajax.reload();
    });
</script>
@endsection