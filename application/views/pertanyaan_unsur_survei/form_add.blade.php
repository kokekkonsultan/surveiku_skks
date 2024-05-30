@extends('include_backend/template_backend')

@php
$ci = get_instance();
@endphp

@section('style')

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include('manage_survey/menu_data_survey')
        </div>
        <div class="col-md-9">
            <div class="card shadow" data-aos="fade-down" data-aos-delay="300">
                <div class="card-header bg-secondary font-weight-bold">
                    {{ $title }}
                </div>
                <div class="card-body">

                    {!! form_open($form_action) !!}

                    <span class="text-danger mb-3">{!! validation_errors() !!}</span>

                    <div class="form-group row">
                        <label class="col-sm-2 font-weight-bold col-form-label">Dimensi <span style="color: red;">*</span></label>
                        <div class="col-sm-10">
                            {!! form_dropdown($id_dimensi) !!}
                        </div>
                    </div>

                    <input name="kode_unsur" value="U{{$kode_unsur}}" hidden>
                    <div class="form-group row">
                        <label class="col-sm-2 font-weight-bold col-form-label">Unsur <span class="text-danger">*</span></label>
                        <div class="col-sm-10">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">U{{$kode_unsur}}</span>
                                </div>
                                {!! form_textarea($nama_unsur) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 font-weight-bold col-form-label">Pertanyaan <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            {!! form_textarea($pertanyaan_unsur) !!}
                        </div>
                    </div>

                    <br>
                    <h5 class="text-primary">Pilihan Jawaban</h5>
                    <hr>

                    <datalist id="data_pilihan_jawaban">
                        <?php foreach ($pilihan->result() as $d) {
                            echo "<option value='$d->id'>$d->pilihan_1</option>";
                        }
                        ?>
                    </datalist>

                    <div class="form-group row">
                        <label class="col-sm-3 font-weight-bold col-form-label">Pilihan Jawaban 1 <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" value="1" name="nilai_jawaban[]">
                            <input class="form-control pilihan" list="data_pilihan_jawaban" type="text" name="pilihan_jawaban[]" id="id" placeholder="Masukkan pilihan jawaban anda .." onchange="return autofill();" autofocus autocomplete='off' required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 font-weight-bold col-form-label">Pilihan Jawaban 2 <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" value="2" name="nilai_jawaban[]">
                            <input type="text" class="form-control pilihan" name="pilihan_jawaban[]" id="pilihan_2" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 font-weight-bold col-form-label">Pilihan Jawaban 3 <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" value="3" name="nilai_jawaban[]">
                            <input type="text" class="form-control pilihan" name="pilihan_jawaban[]" id="pilihan_3" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 font-weight-bold col-form-label">Pilihan Jawaban 4 <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" value="4" name="nilai_jawaban[]">
                            <input type="text" class="form-control pilihan" name="pilihan_jawaban[]" id="pilihan_4" required>
                        </div>
                    </div>


                    <div class="text-right">
                        @php
                        echo
                        anchor(base_url().$ci->session->userdata('username').'/'.$ci->uri->segment(2).'/pertanyaan-unsur',
                        'Batal', ['class' => 'btn btn-light-primary font-weight-bold'])
                        @endphp

                        <button class="btn btn-primary font-weight-bold tombolSimpan" type="submit">Simpan</button>
                    </div>
                    {!! form_close() !!}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script src="{{ base_url() }}assets/themes/metronic/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>
<script src="{{ base_url() }}assets/themes/metronic/assets/js/pages/crud/forms/editors/ckeditor-classic.js"></script>

<script>
    function autofill() {
        var id = document.getElementById('id').value;
        $.ajax({
            url: "<?php echo base_url() . $ci->session->userdata('username') . '/' . $ci->uri->segment(2) . '/pertanyaan-unsur/cari' ?>",
            data: '&id=' + id,
            success: function(data) {
                var hasil = JSON.parse(data);

                $.each(hasil, function(key, val) {

                    document.getElementById('id').value = val.pilihan_1;
                    document.getElementById('pilihan_2').value = val.pilihan_2;
                    document.getElementById('pilihan_3').value = val.pilihan_3;
                    document.getElementById('pilihan_4').value = val.pilihan_4;
                });
            }
        });
    }
</script>
@endsection