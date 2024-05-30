

<?php
$ci = get_instance();
?>

<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <?php echo $__env->make("include_backend/partials_no_aside/_inc_menu_repository", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row mt-5">
        <div class="col-md-3">
            <?php echo $__env->make('manage_survey/menu_data_survey', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-md-9">
            <div class="card card-custom bgi-no-repeat gutter-b" style="height: 150px; background-color: #1c2840; background-position: calc(100% + 0.5rem) 100%; background-size: 100% auto; background-image: url(/assets/img/banner/rhone-2.svg)" data-aos="fade-down">
                <div class="card-body d-flex align-items-center">
                    <div>
                        <h3 class="text-white font-weight-bolder line-height-lg mb-5">
                            LINK SURVEI
                        </h3>
                    </div>
                </div>
            </div>

            <?php if($profiles->is_question == 1): ?>
            <div class="card mb-5" data-aos="fade-down">
                <div class="card-header font-weight-bold">
                    Status Pengisian Unsur Pertanyaan dan Pertanyaan
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            <div class="my-5">
                                <table class="table">
                                    <tr>
                                        <th><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/profil-responden-survei" title="">1. Profil Responden</a></th>
                                        <td>
                                            <?php if($sektor == 0): ?>
                                            <span class="badge badge-danger">Pilihan Sektor Masih Kosong</span>
                                            <?php elseif($wilayah_survei == 0): ?>
                                            <span class="badge badge-danger">Pilihan Wilayah Survei Masih Kosong</span>
                                            <?php else: ?>
                                            <span class="badge badge-success">Oke</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/dimensi" title="">2. Dimensi</a></th>
                                        <td>
                                            <?php if($dimensi > 0): ?>
                                            <span class="badge badge-success">Oke</span>
                                            <?php else: ?>
                                            <span class="badge badge-danger">Belum diisi</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/pertanyaan-unsur" title="">3. Pertanyaan Unsur</a></th>
                                        <td>
                                            <?php if($unsur > 0): ?>
                                            <span class="badge badge-success">Oke</span>
                                            <?php else: ?>
                                            <span class="badge badge-danger">Belum diisi</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <!-- <?php if($profiles->is_active_target == 1): ?>
                                    <tr>
                                        <th><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/target-per-wilayah" title="">4. Target Survei</a></th>
                                        <td>
                                            <?php if($target == 0): ?>
                                            <span class="badge badge-danger">Target Survei belum diisi</span>
                                            <?php elseif($target_online > 0 && $target_offline > 0): ?>
                                            <span class="badge badge-danger">Target Survei anda masih ada yang
                                                kosong</span>
                                            <?php else: ?>
                                            <span class="badge badge-success">Oke</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?> -->

                                </table>

                                <p>Link kuesioner akan ditampilkan ketika Pengisian Dimensi dan Pertanyaan
                                    sudah lengkap.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


                <?php if($unsur > 0 && $dimensi > 0 && $sektor > 0 && $wilayah_survei > 0): ?>
                <div class="card" data-aos="fade-down">
                    <div class="card-header font-weight-bold bg-light-success">
                        Link Survey
                    </div>
                    <div class="card-body">
                        <form class="form_submit" action="<?php echo e($form_action); ?>" method="POST">
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-8">
                                    <div class="my-5">
                                        <h3 class="text-dark font-weight-bold mb-10">Konfirmasi Pengisian Soal dan
                                            Pertanyaan Survei</h3>
                                        <div class="form-group row">
                                            <label class="col-3">Konfirmasi</label>
                                            <div class="col-9">
                                                <div class="mb-5">
                                                    <i class="fas fa-check-circle text-success"></i> Profil Responden
                                                </div>
                                                <div class="mb-5">
                                                    <i class="fas fa-check-circle text-success"></i> Dimensi
                                                </div>
                                                <div class="mb-5">
                                                    <i class="fas fa-check-circle text-success"></i> Pertanyaan Unsur
                                                </div>

                                                <?php if($profiles->is_active_target == 1): ?>
                                                <div class="mb-5">
                                                    <i class="fas fa-check-circle text-success"></i> Target Survei
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <p>Dengan menekan tombol konfirmasi dibawah ini berarti anda sudah membuat
                                            pertanyaan survey yang telah diisi dengan benar dan siap dilakukan pengisian
                                            survey.<br>Link kuesioner akan ditampilkan ketika anda sudah menekan tombol
                                            konfirmasi.</p>
                                        <input type="hidden" name="is_question" value="2">
                                        <button type="submit" class="btn btn-light-success font-weight-bold shadow btn-block tombolSubmit" onclick="return confirm('Apakah anda yakin ingin mengkonfirmasi link survei ?')"><i class="fas fa-check-circle text-success"></i>
                                            Konfirmasi</button>
                                    </div>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endif; ?>

            <?php else: ?>
            <div class="card" data-aos="fade-down">
                <!-- <div class="card-header font-weight-bold bg-light-primary">
                    Link Survey
                </div> -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            <div class="my-5">

                                <div class="text-center">

                                    <div class="mt-10 mb-10">
                                        Anda bisa menggunakan link survei untuk dibagikan kepada responden di bawah ini.
                                    </div>

                                    <div class='input-group'>
                                        <input type='text' class='form-control' id='kt_clipboard_1' value="<?php echo e(base_url()); ?>survei/<?php echo e($ci->uri->segment(2)); ?>" placeholder='Type some value to copy' />
                                        <div class='input-group-append'>
                                            <a href='javascript:void(0)' class='btn btn-light-primary font-weight-bold shadow' data-clipboard='true' data-clipboard-target='#kt_clipboard_1'><i class='la la-copy'></i> Copy Link</a>
                                        </div>
                                    </div>

                                    <div class="mt-10 mb-10">
                                        Atau gunakan tombol dibawah ini.
                                    </div>

                                    <?php
                                    echo anchor(base_url().'survei/'.$ci->uri->segment(2), '<i class="fas fa-globe"></i>
                                    Menuju Link Survey', ['class' => 'btn btn-primary font-weight-bold btn-block
                                    shadow-lg', 'target' => '_blank']);
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <?php if($profiles->group_id == 2): ?>
                <div class="card mt-5 mb-5" data-aos="fade-down">
                    <div class="card-header font-weight-bold bg-light-danger">
                        Ubah Susunan Pertanyaan Survey
                    </div>
                    <div class="card-body">

                        <form class="form_submit" action="<?php echo e($form_action); ?>" method="POST">
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-8">
                                    <div class="my-5">
                                        <h3 class="text-dark font-weight-bold mb-10">Ubah Kembali Susunan Soal dan
                                            Pertanyaan Survey</h3>
                                        <div class="form-group row">
                                            <label class="col-3">Konfirmasi perubahan pertanyaan untuk unsur berikut
                                                ini</label>
                                            <div class="col-9">
                                                <div class="mb-5">
                                                    <i class="fas fa-check-circle text-danger"></i> Profil Responden
                                                </div>
                                                <div class="mb-5">
                                                    <i class="fas fa-check-circle text-danger"></i> Dimensi
                                                </div>
                                                <div class="mb-5">
                                                    <i class="fas fa-check-circle text-danger"></i> Pertanyaan Unsur
                                                </div>

                                                <?php if($profiles->is_active_target == 1): ?>
                                                <div class="mb-5">
                                                    <i class="fas fa-check-circle text-danger"></i> Target Survei
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <p>Dengan menekan tombol konfirmasi dibawah ini berarti anda akan merubah susunan
                                            pertanyaan survey.</p>
                                        <p class="text-danger">Jika anda mengkonfirmasi maka kuesioner terisi sebelumnya
                                            akan dihapus dan tidak bisa dikembalikan kembali.</p>
                                        <p>Klik tombol konfirmasi jika anda setuju.</p>

                                        <input type="hidden" name="is_question" value="1">
                                        <button type="submit" class="btn btn-light-secondary font-weight-bold shadow btn-block text-dark tombolSubmit" onclick="return confirm('Apakah anda yakin ingin mengubah kembali susunan pertanyaan survei ?')"><i class="fas fa-info-circle text-danger"></i> Konfirmasi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<script>
    "use strict";
    var KTClipboardDemo = function() {

        var demos = function() {
            new ClipboardJS('[data-clipboard=true]').on('success', function(e) {
                e.clearSelection();
                toastr["success"]('Link berhasil dicopy, Silahkan paste di browser anda sekarang.');
            });
        }
        return {
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

        $('.form_submit').submit(function(e) {

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                cache: false,
                beforeSend: function() {
                    $('.tombolSubmit').attr('disabled', 'disabled');
                    $('.tombolSubmit').html(
                        '<i class="fa fa-spin fa-spinner"></i> Sedang diproses');

                    Swal.fire({
                        title: 'Memproses data',
                        html: 'Mohon tunggu sebentar. Sistem sedang menyiapkan request anda.',
                        onOpen: () => {
                            swal.showLoading()
                        }
                    });

                },
                complete: function() {
                    $('.tombolSubmit').removeAttr('disabled');
                    $('.tombolSubmit').html('Konfirmasi');
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

                        window.location.href =
                            "<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/link-survei";

                    }
                }
            })
            return false;
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('include_backend/template_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\IT\Documents\Htdocs MAMP\surveiku_skks\application\views/link_survei/index.blade.php ENDPATH**/ ?>