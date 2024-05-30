

<?php
$ci = get_instance();
?>

<?php $__env->startSection('style'); ?>
<!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

<style>
    .form-radio {
        font-size: 16px;
        text-transform: capitalize;
        font-family: Arial, Helvetica, sans-serif;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="container mt-5 mb-5" style="font-family:Arial, Helvetica, sans-serif;">
    <div class="text-center" data-aos="fade-up">
        <div id="progressbar" class="mb-5">
            <li class="active" id="account"><strong>Data Responden</strong></li>
            <li class="active" id="personal"><strong>Pertanyaan Survei</strong></li>
            <?php if($status_saran == 1): ?>
            <li id="payment"><strong>Saran</strong></li>
            <?php endif; ?>
            <li id="completed"><strong>Completed</strong></li>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow" data-aos="fade-up" id="kt_blockui_content" style="font-size: 16px; font-family:Arial, Helvetica, sans-serif;">
                <?php if($manage_survey->img_benner == ''): ?>
                <img class="card-img-top" src="<?php echo e(base_url()); ?>assets/img/site/page/banner-survey.jpg" alt="new image" />
                <?php else: ?>
                <img class="card-img-top shadow" src="<?php echo e(base_url()); ?>assets/klien/benner_survei/<?php echo e($manage_survey->img_benner); ?>" alt="new image">
                <?php endif; ?>

                <div class="card-header text-center">
                    <div class="mt-5 mb-5" style="background-color: #FCF7B6; padding: 5px; font-size: 16px;
                        font-family:Arial,Helvetica,sans-serif; font-weight: bold; text-transform: uppercase;">
                        BERIKAN PENILAIAN SAUDARA TERHADAP UNSUR-UNSUR KESADARAN KEAMANAN SIBER <br>
                        <span class="text-danger"><?php echo $__env->make('include_backend/partials_backend/_tanggal_survei', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></span>
                    </div>
                </div>

                <form action="<?php echo e(base_url() . 'survei/' . $ci->uri->segment(2) . '/add-pertanyaan/' . $ci->uri->segment(4)); ?>" class="form_survei" method="POST">

                    <div class="card-body ml-5 mr-5">
                        <br>


                        <?php
                        $i = 1;
                        ?>
                        <?php $__currentLoopData = $ci->db->get("dimensi_$manage_survey->table_identity")->result(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p class="mb-5" style="text-align: justify;"><?php echo $row->nama_dimensi; ?></p>


                        <?php $__currentLoopData = $pertanyaan->result(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $get): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($get->id_dimensi == $row->id): ?>
                        <table width="100%" border="0" class="mt-5 mb-5" style="font-weight:bold;">
                            <tr>
                                <td width="4%" valign="top">
                                    <p><span style="font-size:16px;"><?php echo e($i); ?>. </span></p>
                                </td>
                                <td width="96%"><?php echo $get->isi_pertanyaan; ?></td>
                            </tr>

                            <input name="id_pertanyaan_unsur[<?php echo e($i); ?>]" value="<?php echo e($get->id_pertanyaan_unsur); ?>" hidden>
                        </table>

                        <table width="100%" border="0" style="font-weight: bold;">
                            <tr>
                                <td width="5%"></td>
                                <td width="95%">

                                    <div class="form-group">
                                        <div class="radio-list">

                                            <label class="radio radio-lg radio-outline radio-outline-3x radio-primary" style=" font-size: 16px;">
                                                <input type="radio" name="jawaban_pertanyaan_unsur[<?php echo e($i); ?>]" value="1" class="<?php echo e($get->id_pertanyaan_unsur); ?>" required <?php echo $get->skor_jawaban == 1 ? 'checked' : '' ?>>
                                                <span></span>
                                                <?php echo e($get->jawaban_1); ?>

                                            </label>

                                            <label class="radio radio-lg radio-outline radio-outline-3x radio-primary" style=" font-size: 16px;">
                                                <input type="radio" name="jawaban_pertanyaan_unsur[<?php echo e($i); ?>]" value="2" class="<?php echo e($get->id_pertanyaan_unsur); ?>" required <?php echo $get->skor_jawaban == 2 ? 'checked' : '' ?>>
                                                <span></span>
                                                <?php echo e($get->jawaban_2); ?>

                                            </label>

                                            <label class="radio radio-lg radio-outline radio-outline-3x radio-primary" style=" font-size: 16px;">
                                                <input type="radio" name="jawaban_pertanyaan_unsur[<?php echo e($i); ?>]" value="3" class="<?php echo e($get->id_pertanyaan_unsur); ?>" required <?php echo $get->skor_jawaban == 3 ? 'checked' : '' ?>>
                                                <span></span>
                                                <?php echo e($get->jawaban_3); ?>

                                            </label>

                                            <label class="radio radio-lg radio-outline radio-outline-3x radio-primary" style=" font-size: 16px;">
                                                <input type="radio" name="jawaban_pertanyaan_unsur[<?php echo e($i); ?>]" value="4" class="<?php echo e($get->id_pertanyaan_unsur); ?>" required <?php echo $get->skor_jawaban == 4 ? 'checked' : '' ?>>
                                                <span></span>
                                                <?php echo e($get->jawaban_4); ?>

                                            </label>
                                        </div>
                                </td>
                            </tr>

                        </table>
                        <br>
                        <br>
                        <?php
                        $i++;
                        ?>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        


                        

                        



                    </div>
                    <div class="card-footer">
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-left">
                                    <?php if($ci->uri->segment(5) == 'edit'): ?>
                                    <a class="btn btn-secondary btn-lg shadow" href="<?php echo e(base_url() . 'survei/' . $ci->uri->segment(2) . '/data-responden/' . $ci->uri->segment(4) . '/edit'); ?>"><i class="fa fa-arrow-left"></i> Kembali</a>
                                    <?php endif; ?>
                                </td>
                                <td class="text-right">
                                    <button type="submit" class="btn btn-warning btn-lg font-weight-bold shadow-lg tombolSave">Selanjutnya <i class="fa fa-arrow-right"></i></button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>

<script>
    $('.form_survei').submit(function(e) {

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            cache: false,
            beforeSend: function() {
                $('.tombolSave').attr('disabled', 'disabled');
                $('.tombolSave').html('<i class="fa fa-spin fa-spinner"></i> Sedang diproses');

                KTApp.block('#kt_blockui_content', {
                    overlayColor: '#FFA800',
                    state: 'primary',
                    message: 'Processing...'
                });

                setTimeout(function() {
                    KTApp.unblock('#kt_blockui_content');
                }, 1000);

            },
            complete: function() {
                $('.tombolSave').removeAttr('disabled');
                $('.tombolSave').html('Selanjutnya <i class="fa fa-arrow-right"></i>');
            },

            error: function(e) {
                Swal.fire(
                    'Error !',
                    e,
                    'error'
                )
            },

            success: function(data) {
                if (data.full) {
            
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    html: data.full,
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                }
                if (data.sukses) {
                    // toastr["success"]('Data berhasil disimpan');

                    setTimeout(function() {
                        window.location.href = "<?php echo e($url_next); ?>";
                    }, 500);
                }
            }
        })
        return false;
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('include_backend/_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\IT\Documents\Htdocs MAMP\surveiku_skks\application\views/survei/form_pertanyaan.blade.php ENDPATH**/ ?>