@extends('include_backend/template_backend')

@php
$ci = get_instance();
@endphp

@section('style')
<link href="{{ TEMPLATE_BACKEND_PATH }}plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include('manage_survey/menu_data_survey')
        </div>
        <div class="col-md-9">
            <div class="card" data-aos="fade-down" data-aos-delay="300">
                <div class="card-header bg-secondary font-weight-bold">
                    {{ $title }}
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ base_url() }}assets/img/200px.jpg" alt="">
                        </div>
                        <div class="col-md-8">
                            <table class="table table-striped">
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>
                                        {{ $data_surveyor->first_name }} {{ $data_surveyor->last_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kode Surveyor</th>
                                    <td>
                                        {{ $data_surveyor->kode_surveyor }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>
                                        {{ $data_surveyor->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>HP</th>
                                    <td>
                                        {{ $data_surveyor->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th valign="middle">Link Survei</th>
                                    <td>
                                        <div class='input-group'>
                                            <input class='form-control' id='kt_clipboard_1' value="{{ base_url() }}survei/{{ $ci->uri->segment(2) }}/{{ $ci->uri->segment(4) }}" readonly />
                                            <div class='input-group-append'>
                                                <a href='javascript:void(0)' class='btn btn-light-primary' data-clipboard='true' data-clipboard-target='#kt_clipboard_1'><i class='la la-copy'></i></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <form action="{{ base_url() }}perolehan-surveyor/get-email" class="form_kirim_email" method="POST">

                                <input type="hidden" name="id_surveyor" value="<?php echo $data_surveyor->id ?>">
                                <div class="mt-5 text-right">
                                    <button type="submit" class="btn btn-light-danger font-weight-bold btn-block tombolKirim shadow"><i class="fas fa-envelope"></i> Informasikan akun kepada surveyor menggunakan
                                        email</button>
                                </div>
                                <div class="text-right mt-5 font-italic">
                                    <p style="color: red;">** Pastikan email sudah benar dan aktif !</p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            {{--<div class="card mt-5" data-aos="fade-down" data-aos-delay="300">
                <div class="card-body">

                    <div class="text-primary text-center">
                        <h5>Perolehan Per Sektor</h5>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center bg-secondary">
                                    <th>No</th>
                                    <th>Sektor</th>
                                    <th>Perolehan</th>
                                    <!-- <th>Target</th>
                                    <th>Kekurangan</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($sektor->result() as $row)
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td><?php echo $row->nama_sektor ?></td>
                                    <td class="text-center"><span class="badge badge-success">{{$row->perolehan}}</span></td>
                                    <!-- <td class="text-center"><span class="badge badge-info">{{$row->target}}</span></td>
                                    <td class="text-center"><span class="badge badge-danger">{{$row->target - $row->perolehan}}</span></td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>--}}

            <div class="card mt-5" data-aos="fade-down" data-aos-delay="300">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-hover" cellspacing="0" width="100%">
                            <thead class="bg-secondary">
                                <tr>
                                    <th width="5%">No.</th>
                                    <th>Status</th>
                                    <th>Form</th>

                                    <?php foreach ($profil as $row) { ?>
                                        <th><?php echo $row->nama_profil_responden ?></th>
                                    <?php } ?>

                                    <th>Waktu Isi Survei</th>
                                    <th></th>
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

@endsection

@section('javascript')
<script src="{{ TEMPLATE_BACKEND_PATH }}plugins/custom/datatables/datatables.bundle.js"></script>
<script>
    $(document).ready(function() {
        table = $('#table').DataTable({

            // "searching": true,
            // paging: true,
            // dom: 'Blfrtip',
            // "buttons": [{
            //     extend: 'collection',
            //     text: 'Export',
            //     buttons: [
            //         'excel'
            //     ]
            // }],

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
                "url": "<?php echo base_url() . $ci->session->userdata('username') . '/' . $ci->uri->segment(2) . '/perolehan-surveyor/ajax-list-detail/' . $data_surveyor->uuid ?>",
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

    function delete_data(id) {
        if (confirm('Are you sure delete this data?')) {
            $.ajax({
                url: "<?php echo base_url() . $ci->session->userdata('username') . '/' . $ci->uri->segment(2) . '/data-perolehan-survei/delete/' ?>" +
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
    "use strict";
    // Class definition

    var KTClipboardDemo = function() {

        // Private functions
        var demos = function() {
            // basic example
            new ClipboardJS('[data-clipboard=true]').on('success', function(e) {
                e.clearSelection();
                // alert('Copied!');
                toastr["success"]('Link berhasil dicopy, Silahkan paste di browser anda sekarang.');
            });
        }

        return {
            // public functions
            init: function() {
                demos();
            }
        };
    }();

    jQuery(document).ready(function() {
        KTClipboardDemo.init();
    });
</script>

<script>
    $(document).ready(function(e) {
        $('.form_kirim_email').submit(function(e) {

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                cache: false,
                beforeSend: function() {
                    $('.tombolKirim').attr('disabled', 'disabled');
                    $('.tombolKirim').html(
                        '<i class="fa fa-spin fa-spinner"></i> Sedang diproses');


                    KTApp.block('#kt_blockui_content', {
                        overlayColor: '#000000',
                        state: 'primary',
                        message: 'Processing...'
                    });

                    setTimeout(function() {
                        KTApp.unblock('#kt_blockui_content');
                    }, 5000);
                },
                complete: function() {
                    $('.tombolKirim').removeAttr('disabled');
                    $('.tombolKirim').html(
                        'Informasikan akun kepada surveyor menggunakan email');

                    $('[name="is_surveyor"]').val('<?php echo $data_surveyor->id ?>');
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
                        toastr["success"]('Email berhasil dikirim');
                    }
                }
            })
            return false;
        });

    });
</script>
@endsection