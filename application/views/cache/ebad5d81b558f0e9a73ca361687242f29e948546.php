<?php
$ci = get_instance();
?>
<div class="modal-header bg-secondary text-white">
    <h5 class="modal-title" id="exampleModalLabel"><?php echo e($sektor->nama_sektor); ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i aria-hidden="true" class="ki ki-close"></i>
    </button>
</div>
<div class="modal-body">

    <?php if($jumlah_kuesioner_terisi > 0): ?>
    <div class="table-responsive">
        <table width="100%" class="table table-bordered" style="font-size: 12px;">
            <tr align="center">
                <th></th>
                <?php $__currentLoopData = $unsur->result(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th class="bg-primary text-white"><?php echo e($value->kode_unsur); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
            <tr>
                <th class="bg-light">TOTAL</th>
                <?php $__currentLoopData = $total->result(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td class="text-center"><?php echo e(ROUND($row->sum_skor_jawaban,2)); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>

            <tr>
                <th class="bg-light">Rata-Rata</th>
                <?php $__currentLoopData = $total->result(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td class="text-center"><?php echo e(ROUND($val->rata_rata, 3)); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>

            <!-- <tr>
                <th class="bg-light">Nilai Per Dimensi</th>
                <?php $__currentLoopData = $rata_rata_per_dimensi->result(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td class="text-center" colspan="<?php echo e($val->jumlah_unsur); ?>"><?php echo e(ROUND($val->rata_rata, 3)); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr> -->

            <tr>
                <th class="bg-light">Nilai Per Unsur</th>
                <?php $__currentLoopData = $total->result(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td class="text-center"><?php echo e(ROUND($val->rata_rata, 3)); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
            <tr>
                <th class="bg-light">Rata-Rata x Bobot</th>
                <?php $__currentLoopData = $total->result(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $nilai_bobot[] = $val->rata_rata_X_bobot;
                $indeks = array_sum($nilai_bobot);
                $nilai_konversi = $indeks * 25;
                $colspan = count($nilai_bobot);
                ?>
                <td class="text-center"><?php echo e(ROUND($val->rata_rata_X_bobot, 3)); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>

            <tr>
                <th class="bg-light">Indeks</th>
                <th colspan="<?php echo e($colspan); ?>"><?php echo e(ROUND($indeks, 3)); ?></th>
            </tr>

            <tr>
                <th class="bg-light">Nilai Konversi</th>
                <th colspan="<?php echo e($colspan); ?>"><?php echo e(ROUND($nilai_konversi, 2)); ?></th>
            </tr>

            <?php
            if ($nilai_konversi <= 100 && $nilai_konversi >= 80) {
                $kategori = 'Sangat Baik';
                $interpretasi = 'Memiliki tingkat kesadaran keamanan siber yang sangat tinggi';
            } elseif ($nilai_konversi <= 79.99 && $nilai_konversi >= 50) {
                $kategori = 'Baik';
                $interpretasi = 'Memiliki tingkat kesadaran keamanan siber yang tinggi';
            } elseif ($nilai_konversi <= 49.99 && $nilai_konversi >= 25) {
                $kategori = 'Kurang Baik';
                $interpretasi = 'Memiliki tingkat kesadaran keamanan siber yang rendah';
            } elseif ($nilai_konversi <= 24.99 && $nilai_konversi >= 0) {
                $kategori = 'Buruk';
                $interpretasi = 'Memiliki tingkat kesadaran keamanan siber yang sangat rendah';
            } else {
                $kategori = 'NULL';
                $interpretasi = 'NULL';
            } ?>

            <tr>
                <th class="bg-light">Kategori</th>
                <td colspan="<?php echo e($colspan); ?>"><b><?php echo e($kategori); ?></b><br><?php echo e($interpretasi); ?></td>
            </tr>
        </table>
    </div>
    <?php else: ?>

    <div class="text-danger text-center"><i>Belum ada data responden yang sesuai.</i></div>
    <?php endif; ?>
</div><?php /**PATH C:\Users\IT\Documents\Htdocs MAMP\surveiku_skks\application\views/nilai_index_sektor/detail.blade.php ENDPATH**/ ?>