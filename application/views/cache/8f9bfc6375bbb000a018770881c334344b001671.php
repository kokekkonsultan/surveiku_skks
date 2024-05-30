<!---------------------------------------------- MODAL ADD ---------------------------------------->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Dimensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form
                    action="<?php echo e(base_url() . $ci->session->userdata('username') . '/' . $ci->uri->segment(2) . '/dimensi/add'); ?>"
                    class="form_simpan" method="POST">

                    <div class="form-group">
                        <label class="font-weight-bold">Dimensi <span class="text-danger">*</span></label>
                        <?php echo form_textarea($nama_dimensi); ?>

                    </div>


                    <div class="text-right">
                        <button type="submit" class="btn btn-primary font-weight-bold tombolSimpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\IT\Documents\Htdocs MAMP\surveiku_skks\application\views/dimensi_survei/modal_add.blade.php ENDPATH**/ ?>