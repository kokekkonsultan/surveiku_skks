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
                <div class="card-header font-weight-bold bg-secondary">
                    <b> {{ $title }}</b>
                </div>
                <div class="card-body font-size-h6 font-weight-normal" id="kt_blockui_content">

                    {!! form_open($form_action) !!}
                    <span class="text-danger mb-3">{!! validation_errors() !!}</span>


                    <div class="form-group row">
                        <label class="col-sm-2 font-weight-bold col-form-label">Dimensi <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input value="{!! $dimensi !!}" class="form-control" disabled>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 font-weight-bold col-form-label">Unsur <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{!! $kode_unsur !!}</span>
                                </div>
                                {!! form_textarea($nama_unsur) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 font-weight-bold col-form-label">Pertanyaan Unsur <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            {!! form_textarea($pertanyaan_unsur) !!}
                        </div>
                    </div>

                    <br>
                    <h5 class="tex t -primar y">Pilihan Jawaban</h5>
                    <hr>

                    <?php
                    $no = 1;
                    foreach ($nilai_unsur_pelayanan as $row) {
                        ?>
                        <input type="tex t" name="id[ ]" value=" < ?php echo $row->id; ?>" hidden>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label font-weight-bold">Pilihan Jawaban
                                <?php echo $no++; ?> <span style="color: red;">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama_jawaban[]" value="<?php echo $row->nama_jawaban; ?>" required>
                            </div>
                        </div>
                    <?php
                }
                ?>

                    <div class="text-right">
                        <?php echo anchor(base_url() . $ci->session->userdata('username') . '/' . $ci->uri->segment(2) .  '/pertanyaan-unsur', 'Kembali', ['class' => 'btn btn-secondary font-weight-bold shadow']); ?>
                        <input type="submit" class="btn btn-primary font-weight-bold shadow" value="Simpan">
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('javascript')
<script src="{{ base_url() }}assets/themes/metronic/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>
<script src="{{ base_url() }}assets/themes/metronic/assets/js/pages/crud/forms/editors/ckeditor-classic.js"></script>
@endsection