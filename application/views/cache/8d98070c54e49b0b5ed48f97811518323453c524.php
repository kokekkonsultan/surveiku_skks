

<?php
$ci = get_instance();
?>

<?php $__env->startSection('style'); ?>
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container mt-5 mb-5" style="font-family:Arial, Helvetica, sans-serif;">
    <div class="text-center" data-aos="fade-up">
        <div id="progressbar" class="mb-5">
            <li id="account"><strong>Data Responden</strong></li>
            <li id="personal"><strong>Pertanyaan Survei</strong></li>
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
            <div class="card shadow" data-aos="fade-up">
                <?php if($judul->img_benner == ''): ?>
                <img class="card-img-top" src="<?php echo e(base_url()); ?>assets/img/site/page/banner-survey.jpg"
                    alt="new image" />
                <?php else: ?>
                <img class="card-img-top shadow"
                    src="<?php echo e(base_url()); ?>assets/klien/benner_survei/<?php echo e($manage_survey->img_benner); ?>" alt="new image">
                <?php endif; ?>
                <div class="card-body">
                    <div>
                        <?php echo $manage_survey->deskripsi_opening_survey; ?>

                    </div>
                    <!-- <br> -->
                    <br>

                    <?php if($manage_survey->is_lampiran == 1 && $manage_survey->file_lampiran != ''): ?>
                    <span class="fw-bold text-primary"><b><?php echo e($manage_survey->label_lampiran); ?></b></span>
                    <div class="card card-body">
                        <object type="application/pdf"
                            data="<?php echo e(base_url() . 'assets/klien/files/lampiran/' . $manage_survey->file_lampiran); ?>"
                            width="100%" height="400"></object>
                    </div>
                    <?php endif; ?>


                    <br>
                    <br>
                    <?php if($ci->uri->segment(3) == NULL): ?>
                    <a class="btn btn-warning btn-block font-weight-bold shadow"
                        href="<?php echo e(base_url() . 'survei/' . $ci->uri->segment(2) . '/data-responden'); ?>">IKUT SURVEI</a>

                    <?php else: ?>
                    <a class="btn btn-warning btn-block font-weight-bold shadow"
                        href="<?php echo e(base_url() . 'survei/' . $ci->uri->segment(2) . '/data-responden/' . $ci->uri->segment(3)); ?>">IKUT
                        SURVEI</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('include_backend/_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\IT\Documents\Htdocs MAMP\surveiku_skks\application\views/survei/form_opening.blade.php ENDPATH**/ ?>