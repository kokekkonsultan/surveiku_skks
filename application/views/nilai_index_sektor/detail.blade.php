@php
$ci = get_instance();
@endphp
<div class="modal-header bg-secondary text-white">
    <h5 class="modal-title" id="exampleModalLabel">{{$sektor->nama_sektor}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i aria-hidden="true" class="ki ki-close"></i>
    </button>
</div>
<div class="modal-body">

    @if($jumlah_kuesioner_terisi > 0)
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
    @else

    <div class="text-danger text-center"><i>Belum ada data responden yang sesuai.</i></div>
    @endif
</div>