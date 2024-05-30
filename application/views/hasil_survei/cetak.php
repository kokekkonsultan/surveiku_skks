<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Hasil Survei -- <?php echo $responden->nama_lengkap ?></title> -->
    <style>
    table {
        border-collapse: collapse;
        font-family: sans-serif;
        font-size: .8rem;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 3px;
    }

    header {
        position: fixed;
    }

    td {
        font-size: 11px;
    }
    </style>
</head>

<body>
    <table style="width: 100%;">
        <tr>

            <td width="50%" style="border: 10px; padding-left: 8px;">
                <table style="width: 100%; border: 10px;">
                    <tr style="border: 10px;">
                        <td width="10%" style="border: 10px; padding-left: 8px;">
                            <?php if ($data_user->foto_profile == '') { ?>
                            <img src="<?php echo base_url() ?>assets/klien/foto_profile/200px.jpg" height="60" alt="">
                            <?php } else { ?>
                            <img src="<?php echo base_url(); ?>assets/klien/foto_profile/<?php echo $data_user->foto_profile ?>"
                                height="60" alt="">
                            <?php } ?>
                        </td>
                        <td class="text-right" style="border: 10px;">

                            <div style="font-size:13px; font-weight:bold; padding-left: 8px;">
                                <?php
                                $title_header = unserialize($manage_survey->title_header_survey);
                                $title_1 = strtoupper($title_header[0]);
                                $title_2 = strtoupper($title_header[1]);
                                ?>
                                <?php echo $title_1 ?><br><?php echo $title_2 ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
            <!-- <td width="50%">
                <div style="font-weight:bold; margin: auto; padding: 10px;  font-size:15px; text-align: center;"> SURVEI
                    INDEKS KEBERDAYAAN KONSUMEN</div>
            </td> -->
        </tr>
    </table>


    <table style="width: 100%;">
        <tr>
            <td style="text-align:center; font-size: 11px; font-family:Arial, Helvetica, sans-serif;">Dalam rangka
                meningkatkan pemberdayaan konsumen, Saudara dipercaya
                menjadi responden pada kegiatan
                survei ini.<br>
                Atas kesediaan Saudara kami sampaikan terima kasih dan penghargaan sedalam-dalamnya.</td>
        </tr>
    </table>

    <table style="width: 100%;">
        <tr>
            <td colspan="2"
                style="text-align:left; font-size: 11px; background-color: black; color:white; height:15px;">
                DATA RESPONDEN
            </td>
        </tr>

        <!-- MEMANGGIL DATA PROFIL RESPONDEN YANG DIBUAT -->
        <?php foreach ($profil_responden as $value) {
            $isi_profil = $value->nama_alias;
            ?>
        <tr style="font-size: 11px;">
            <td width=" 30%" style="height:15px;"><?php echo $value->nama_profil_responden ?></td>
            <td width="70%" style="height:15px;"><?php echo $responden->$isi_profil ?></td>
        </tr>
        <?php } ?>

        <tr style="font-size: 11px;">
            <td width=" 30%" style="height:15px;">Waktu Isi Survei</td>
            <td width="70%"> <?php echo date("d-m-Y", strtotime($responden->waktu_isi)) ?></td>
        </tr>
    </table>

    <table style="width: 100%;">
        <tr>
            <td colspan="2" style="text-align:left; font-size: 11px; background-color: black; color:white;">
                PENILAIAN TERHADAP UNSUR-UNSUR KEBERDAYAAN KONSUMEN (isi kolom dengan tanda "X" sesuai jawaban Saudara)
            </td>
        </tr>
    </table>

    <table width="100%" style="font-size: 11px; text-align:center; background-color:#C7C6C1">
        <tr>
            <td rowspan="2" width="5%">No</td>
            <td rowspan="2" width="47%">PERTANYAAN</td>
            <td colspan="4" width="48%">PILIHAN JAWABAN</td>
        </tr>
        <tr>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
        </tr>
    </table>

    <table style="width: 100%;">
        <?php foreach ($dimensi->result() as $row) { ?>
        <tr>
            <td colspan="6" style="text-align:left; font-size: 11px;">
                <b><?php echo $row->nama_dimensi ?></b>
            </td>
        </tr>

        <?php foreach ($pertanyaan->result() as $get) { ?>
        <?php if ($get->id_dimensi == $row->id) { ?>
            <tr>
            <td rowspan="2" width="5%" style="text-align:center; font-size: 11px;">
                <?php echo $get->kode_unsur ?>
            </td>
            <td width="47%" rowspan="2" style="text-align:left; font-size: 11px;">
                <?php echo str_replace("16px", "11px", $get->isi_pertanyaan) ?>
            </td>

            <td width="12%" style="background-color:#C7C6C1; text-align:center; font-size: 11px;">
                <?php echo $get->jawaban_1 ?>
            </td>
            <td width="12%" style="background-color:#C7C6C1; text-align:center; font-size: 11px;">
                <?php echo $get->jawaban_2 ?>
            </td>
            <td width="12%" style="background-color:#C7C6C1; text-align:center; font-size: 11px;">
                <?php echo $get->jawaban_3 ?>
            </td>
            <td width="12%" style="background-color:#C7C6C1; text-align:center; font-size: 11px;">
                <?php echo $get->jawaban_4 ?>
            </td>
        </tr>

        <?php if ($get->skor_jawaban == 1) { ?>
            <tr>
            <th>X</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <?php } else if ($get->skor_jawaban == 2) { ?>
        <tr>
            <th></th>
            <th>X</th>
            <th></th>
            <th></th>
        </tr>
        <?php } else if ($get->skor_jawaban == 3) { ?>
        <tr>
            <th></th>
            <th></th>
            <th>X</th>
            <th></th>
        </tr>
        <?php } else if ($get->skor_jawaban == 4) { ?>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th>X</th>
        </tr>
        <?php } else { ?>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <?php } ?>


        
        <?php } ?>
        <?php } ?>
        <?php } ?>
    </table>




    <table width="100%" style="font-size: 11px; text-align:center;">
        <tr>
            <td colspan="7" style="text-align:left;">
                <b>SARAN :</b> <br /><br />
                <?php echo $responden->saran ?>
                <br><br>
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align:center;">
                Terima kasih atas kesediaan Saudara mengisi kuesioner tersebut di atas.<br>
                Saran dan penilaian Saudara memberikan konstribusi yang sangat berarti bagi peningkatan keberdayaan
                konsumen.
            </td>
        </tr>
    </table>
</body>

</html>