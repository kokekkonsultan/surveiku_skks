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
    <div class="row">
        <div class="col-md-3">
            @include('manage_survey/menu_data_survey')
        </div>
        <div class="col-md-9">
            <div class="card card-custom bgi-no-repeat gutter-b" style="height: 150px; background-color: #1c2840; background-position: calc(100% + 0.5rem) 100%; background-size: 100% auto; background-image: url(/assets/img/banner/rhone-2.svg)" data-aos="fade-down">
                <div class="card-body d-flex align-items-center">
                    <div>
                        <h3 class="text-white font-weight-bolder line-height-lg mb-5">
                            {{strtoupper($title)}} SURVEI
                        </h3>
                        <button type="button" class="btn btn-primary btn-sm font-weight-bold" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Tambah Dimensi</button>
                    </div>
                </div>
            </div>


            <div class="card card-custom card-sticky shadow" data-aos="fade-down" data-aos-delay="300">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-hover" cellspacing="0" width="100%">
                            <thead class="bg-secondary">
                                <tr>
                                    <th width="5%">No.</th>
                                    <th>Dimensi</th>

                                    @if($is_question == 1)
                                    <th></th>
                                    <th></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


@include('dimensi_survei/modal_add')


<!-- ======================================= MODAL EDIT ========================================== -->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Edit Dimensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" id="bodyModalEdit">
                <div align="center" id="loading_registration">
                    <img src="{{ base_url() }}assets/site/img/ajax-loader.gif" alt="">
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
            "order": [],
            "language": {
                "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
            },
            "ajax": {
                "url": "{{ base_url() }}{{ $ci->uri->segment(1) }}/{{ $ci->uri->segment(2) }}/dimensi/ajax-list",
                "type": "POST",
                "data": function(data) {}
            },

            "columnDefs": [{
                "targets": [-1],
                "orderable": false,
            }, ],
        });
    });

    
    function delete_data(id) {
        if (confirm('Apakah anda akan menghapus dimensi ini?')) {
            $.ajax({
                url: "{{ base_url() }}{{ $ci->session->userdata('username') }}/{{ $ci->uri->segment(2) }}/dimensi/delete/" +
                    id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status) {
                        table.ajax.reload();
                        Swal.fire(
                            'Informasi',
                            'Berhasil menghapus data',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Informasi',
                            'Hak akses terbatasi. Bukan akun administrator.',
                            'warning'
                        );
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });

        }
    }
</script>


<script>
    $('.form_simpan').submit(function(e) {
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            cache: false,
            beforeSend: function() {
                $('.tombolSimpan').attr('disabled', 'disabled');
                $('.tombolSimpan').html('<i class="fa fa-spin fa-spinner"></i> Sedang diproses');

            },
            complete: function() {
                $('.tombolSimpan').removeAttr('disabled');
                $('.tombolSimpan').html('Simpan');
            },
            error: function(e) {
                Swal.fire(
                    'Error !',
                    e,
                    'error'
                )
            },
            success: function(data) {
                if (data.validasi) {
                    $('.pesan').fadeIn();
                    $('.pesan').html(data.validasi);
                }
                if (data.sukses) {
                    toastr["success"]('Data berhasil disimpan');
                    table.ajax.reload();
                }
            }
        })
        return false;
    });
</script>


<script>
    function showedit(id) {
        $('#bodyModalEdit').html(
            "<div class='text-center'><img src='{{ base_url() }}assets/img/ajax/ajax-loader-big.gif'></div>");

        $.ajax({
            type: "post",
            url: "<?php echo base_url() . $ci->session->userdata('username') . '/' . $ci->uri->segment(2) . '/dimensi/detail-edit/' ?>" +
                id,
            // data: "id=" + id,
            dataType: "text",
            success: function(response) {

                // $('.modal-title').text('Edit Pertanyaan Unsur');
                $('#bodyModalEdit').empty();
                $('#bodyModalEdit').append(response);
            }
        });
    }
</script>
@endsection