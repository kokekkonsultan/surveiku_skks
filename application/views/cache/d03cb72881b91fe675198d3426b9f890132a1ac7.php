

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
            <li class="active" id="account"><strong>Data Responden</strong></li>
            <li class="active" id="personal"><strong>Pertanyaan Survei</strong></li>
            <?php if($status_saran == 1): ?>
            <li class="active" id="payment"><strong>Saran</strong></li>
            <?php endif; ?>
            <li class="active" id="completed"><strong>Completed</strong></li>
        </div>
    </div>
    <br>
    <br>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow" data-aos="fade-up">
                <?php if($manage_survey->img_benner == ''): ?>
                <img class="card-img-top" src="<?php echo e(base_url()); ?>assets/img/site/page/banner-survey.jpg"
                    alt="new image" />
                <?php else: ?>
                <img class="card-img-top shadow"
                    src="<?php echo e(base_url()); ?>assets/klien/benner_survei/<?php echo e($manage_survey->img_benner); ?>" alt="new image">
                <?php endif; ?>
                <div class="card-body">

                    <div class="text-center">

                        <i class="fa fa-check-circle" style="font-size: 72px; color: #32CD32;"></i>

                        <br>
                        <br>
                        <br>


                        <div class="font-weight-bold" style="font-size: 15px;">
                            Terima kasih atas kesediaannya dan partisipasinya untuk mengisi kuesioner <?php echo e($manage_survey->survey_name); ?>.
                            <br>
                            Saran dan penilaian Saudara memberikan konstribusi yang sangat berarti bagi
                            peningkatan instansi kami.
                        </div>

                        <br>
                        <br>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function() {
    let timerInterval
    Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: 'Data survei anda berhasil disimpan.',
        confirmButtonColor: '#32CD32',
        confirmButtonText: 'Baik, saya mengerti',
        timer: 6000,
        footer: '<span style="color:d3d3d3;">Data yang anda inputkan kami simpan dengan aman dan tidak kami bagikan kepada yang tidak memiliki kepentingan.</span>',

    }).then((result) => {
        if (
            result.dismiss === Swal.DismissReason.timer
        ) {
            console.log('I was closed by the timer')
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('include_backend/_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\IT\Documents\Htdocs MAMP\surveiku_skks\application\views/survei/form_selesai.blade.php ENDPATH**/ ?>