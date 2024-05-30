@php
$ci = get_instance();
$ci->load->helper('form');
@endphp

<form
    action="{{base_url() . $ci->session->userdata('username') . '/' . $ci->uri->segment(2) . '/dimensi/edit/'.$ci->uri->segment(5)}}"
    method="POST" class="form_edit">

    <div class="form-group">
        <label class="font-weight-bold">Nama Dimensi <span class="text-danger">*</span></label>
        {!! form_textarea($nama_dimensi) !!}
    </div>


    <div class="text-right mb-5">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary tombolEdit">Simpan</button>
    </div>
</form>




<script>
$('.form_edit').submit(function(e) {

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        cache: false,
        beforeSend: function() {
            $('.tombolEdit').attr('disabled', 'disabled');
            $('.tombolEdit').html(
                '<i class="fa fa-spin fa-spinner"></i> Sedang diproses');
        },
        complete: function() {
            $('.tombolEdit').removeAttr('disabled');
            $('.tombolEdit').html('Simpan');
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