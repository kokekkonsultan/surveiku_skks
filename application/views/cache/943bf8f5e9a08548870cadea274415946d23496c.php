<?php
$ci = get_instance();
?>

<?php
$user = $ci->ion_auth->user()->row();
$group = $ci->db->query("SELECT * FROM users_groups WHERE user_id = $user->id")->row();


$slug = $ci->uri->segment(2);
$manage_survey = $ci->db->get_where('manage_survey', array('slug' => "$slug"))->row();
$is_saran = $manage_survey->is_saran;
?>


<div class="nav flex-column flex-row-auto" id="kt_todo_aside">
    <div class="card card-custom card-stretch" data-aos="fade-down">
        <div class="card-body px-5">
            <div
                class="navi navi-hover navi-active navi-link-rounded navi-bold navi-icon-center navi-light-icon navi-accent">

                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url() . $ci->session->userdata('username') . '/' . $ci->uri->segment(2) . '/do'); ?>"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'do' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-bookmark-star-fill" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zM8.16 4.1a.178.178 0 0 0-.32 0l-.634 1.285a.178.178 0 0 1-.134.098l-1.42.206a.178.178 0 0 0-.098.303L6.58 6.993c.042.041.061.1.051.158L6.39 8.565a.178.178 0 0 0 .258.187l1.27-.668a.178.178 0 0 1 .165 0l1.27.668a.178.178 0 0 0 .257-.187L9.368 7.15a.178.178 0 0 1 .05-.158l1.028-1.001a.178.178 0 0 0-.098-.303l-1.42-.206a.178.178 0 0 1-.134-.098L8.16 4.1z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Deskripsi</span>
                    </a>
                </div>


                <!------------------------------------- HANYA KLIEN YANG BOLEH MENGAKSES -------------------------------------->
                <?php if($group->group_id == 2): ?>
                <div class="navi-item my-2">
                    <a href="<?php echo base_url() . $ci->session->userdata('username') . '/' . $ci->uri->segment(2) . '/profil-responden-survei' ?>"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'profil-responden-survei' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-person-badge-fill" viewBox="0 0 20 20">
                                    <path
                                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Profil Responden</span>
                    </a>
                </div>


                <div class="navi-item my-2 btn-group dropright">
                    <a class="navi-link <?php echo e($ci->uri->segment(3) == 'pertanyaan-unsur' ||$ci->uri->segment(3) == 'dimensi' || $ci->uri->segment(3) == 'tahapan-pembelian' ? 'active' : ''); ?> dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-journal-text" viewBox="0 0 20 20">
                                    <path
                                        d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Master Pertanyaan</span>
                    </a>
                    <div class="dropdown-menu" x-placement="right-start">

                        <!-- <li class="nav-item">
                            <a class="font-weight-bold nav-link <?php echo e($ci->uri->segment(3) == 'tahapan-pembelian' ? 'active' : ''); ?>"
                                href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/tahapan-pembelian">Tahapan Pembelian</a>
                        </li> -->

                        <li class="nav-item">
                            <a class="font-weight-bold nav-link <?php echo e($ci->uri->segment(3) == 'dimensi' ? 'active' : ''); ?>"
                                href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/dimensi">Dimensi</a>
                        </li>


                        <li class="nav-item">
                            <a class="font-weight-bold nav-link <?php echo e($ci->uri->segment(3) == 'pertanyaan-unsur' ? 'active' : ''); ?>"
                                href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/pertanyaan-unsur">Pertanyaan
                                Unsur</a>
                        </li>
                    </div>
                </div>

                <?php if($manage_survey->is_active_target == 1): ?>
                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/target-per-wilayah"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'target-per-wilayah' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-ui-checks" viewBox="0 0 20 20">
                                    <path
                                        d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708l-2 2zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708l-2 2zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Target Per Wilayah</span>
                    </a>
                </div>
                <?php endif; ?>


                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/data-surveyor-survei"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'data-surveyor-survei' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-people-fill" viewBox="0 0 20 20">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    <path fill-rule="evenodd"
                                        d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                                    <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Data Surveyor</span>
                    </a>
                </div>

                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/form-survei"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'form-survei' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-ui-checks" viewBox="0 0 20 20">
                                    <path
                                        d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708l-2 2zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708l-2 2zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Form Survei</span>
                    </a>
                </div>


                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/link-survei"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'link-survei' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-link-45deg" viewBox="0 0 20 20">
                                    <path
                                        d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                                    <path
                                        d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Link Survei</span>
                    </a>
                </div>


                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/scan-barcode"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'scan-barcode' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-upc-scan" viewBox="0 0 20 20">
                                    <path
                                        d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Scan Barcode</span>
                    </a>
                </div>




                <div class="navi-item my-2 btn-group dropright">
                    <a class="navi-link <?php echo e($ci->uri->segment(3) == 'data-perolehan-survei' ||$ci->uri->segment(3) == 'perolehan-surveyor' || $ci->uri->segment(3) == 'perolehan-per-wilayah' || $ci->uri->segment(3) == 'perolehan-per-sektor'  ? 'active' : ''); ?> dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-clipboard-data-fill" viewBox="0 0 20 20">
                                    <path
                                        d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z" />
                                    <path
                                        d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1ZM10 8a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V8Zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1Zm4-3a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Data Perolehan</span>
                    </a>
                    <div class="dropdown-menu" x-placement="right-start">

                        <li><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/data-perolehan-survei"
                                class="font-weight-bold nav-link <?php if($ci->uri->segment(3) == 'data-perolehan-survei'): ?> active <?php endif; ?>">Perolehan
                                Survei</a>
                        </li>

                        <li><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/perolehan-surveyor"
                                class="font-weight-bold nav-link <?php if($ci->uri->segment(3) == 'perolehan-surveyor'): ?> active <?php endif; ?>">Perolehan
                                Surveyor</a>
                        </li>

                        <!-- <li><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/perolehan-per-wilayah" class="font-weight-bold nav-link <?php if($ci->uri->segment(3) == 'perolehan-per-wilayah'): ?> active <?php endif; ?>">Perolehan Per Wilayah</a>
                        </li>

                        <li><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/perolehan-per-sektor" class="font-weight-bold nav-link <?php if($ci->uri->segment(3) == 'perolehan-per-sektor'): ?> active <?php endif; ?>">Perolehan Per Sektor</a>
                        </li> -->
                    </div>
                </div>



                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/olah-data"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'olah-data' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-graph-up-arrow" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M0 0h1v15h15v1H0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Olah Data</span>
                    </a>
                </div>

                <!-- <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/nilai-index-sektor"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'nilai-index-sektor' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-file-earmark-bar-graph-fill" viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm.5 10v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Nilai Index Per Sektor</span>
                    </a>
                </div> -->



                <div class="navi-item my-2 btn-group dropright">
                    <a class="navi-link <?php echo e($ci->uri->segment(3) == 'chart-visualisasi' || $ci->uri->segment(3) == 'rekap-responden' ? 'active' : ''); ?> dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-pie-chart-fill" viewBox="0 0 20 20">
                                    <path
                                        d="M15.985 8.5H8.207l-5.5 5.5a8 8 0 0 0 13.277-5.5zM2 13.292A8 8 0 0 1 7.5.015v7.778l-5.5 5.5zM8.5.015V7.5h7.485A8.001 8.001 0 0 0 8.5.015z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Grafik Hasil Survei</span>
                    </a>
                    <div class="dropdown-menu" x-placement="right-start">

                        <li><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/rekap-responden"
                                class="font-weight-bold nav-link <?php if($ci->uri->segment(3) == 'rekap-responden'): ?> active <?php endif; ?>">Grafik
                                Profil Responden</a>
                        </li>

                        <li><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/chart-visualisasi"
                                class="font-weight-bold nav-link <?php if($ci->uri->segment(3) == 'chart-visualisasi'): ?> active <?php endif; ?>">Grafik
                                Unsur</a>
                        </li>


                    </div>
                </div>



                <?php if($manage_survey->is_active_target == 1): ?>
                <div class="navi-item my-2 btn-group dropright">
                    <a class="navi-link <?php echo e($ci->uri->segment(3) == 'rekap-per-wilayah' || $ci->uri->segment(3) == 'rekap-per-sektor' ? 'active' : ''); ?> dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-bar-chart-steps" viewBox="0 0 20 20">
                                    <path
                                        d="M.5 0a.5.5 0 0 1 .5.5v15a.5.5 0 0 1-1 0V.5A.5.5 0 0 1 .5 0zM2 1.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Rekap Target</span>
                    </a>
                    <div class="dropdown-menu" x-placement="right-start">


                        <li><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/rekap-per-sektor"
                                class="font-weight-bold nav-link <?php if($ci->uri->segment(3) == 'rekap-per-sektor'): ?> active <?php endif; ?>">Per
                                Sektor</a>
                        </li>

                        <li><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/rekap-per-wilayah"
                                class="font-weight-bold nav-link <?php if($ci->uri->segment(3) == 'rekap-per-wilayah'): ?> active <?php endif; ?>">Per
                                Wilayah</a>
                        </li>


                    </div>
                </div>
                <?php endif; ?>


                <?php if($is_saran == 1): ?>
                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/rekap-saran"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'rekap-saran' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-book-half" viewBox="0 0 20 20">
                                    <path
                                        d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Rekap Saran</span>
                    </a>
                </div>
                <?php endif; ?>


                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/draft-kuesioner"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'draft-kuesioner' ? 'active' : ''); ?>" target="_blank">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-card-text" viewBox="0 0 20 20">
                                    <path
                                        d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                    <path
                                        d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Draf Kuesioner</span>
                    </a>
                </div>



                <!-- <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/analisa-survei"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'analisa-survei' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-graph-up-arrow" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Analisa Survei</span>
                    </a>
                </div> -->


                <!-- <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/laporan-survey"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'laporan-survey' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-journal-bookmark-fill" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8V1z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Laporan Survei</span>
                    </a>
                </div> 


                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/e-sertifikat"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'e-sertifikat' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-award" viewBox="0 0 20 20">
                                    <path
                                        d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z" />
                                    <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">E-Sertifikat</span>
                    </a>
                </div>-->



                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/settings/survey"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'settings' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-sliders" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Pengaturan</span>
                    </a>
                </div>
                <?php endif; ?>














                <!------------------------------------- HANYA SPV YANG BOLEH MENGAKSES -------------------------------------->
                <?php if($group->group_id == 5): ?>

                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/link-survei"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'link-survei' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-link-45deg" viewBox="0 0 20 20">
                                    <path
                                        d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                                    <path
                                        d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Link Survei</span>
                    </a>
                </div>


                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/scan-barcode"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'scan-barcode' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-upc-scan" viewBox="0 0 20 20">
                                    <path
                                        d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Scan Barcode</span>
                    </a>
                </div>



                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/data-perolehan-online"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'data-perolehan-online'  ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-clipboard-data-fill" viewBox="0 0 20 20">
                                    <path
                                        d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z" />
                                    <path
                                        d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1ZM10 8a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V8Zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1Zm4-3a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Data Perolehan</span>
                    </a>
                </div>


                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/olah-data-online"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'olah-data-online' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-file-earmark-bar-graph-fill" viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm.5 10v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Olah Data</span>
                    </a>
                </div>

                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/nilai-per-sektor-online"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'nilai-per-sektor-online' ? 'active' : ''); ?>">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-file-earmark-bar-graph-fill" viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm.5 10v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Nilai Index Per Sektor</span>
                    </a>
                </div>



                <div class="navi-item my-2 btn-group dropright">
                    <a class="navi-link <?php echo e($ci->uri->segment(3) == 'chart-visualisasi-online' || $ci->uri->segment(3) == 'rekap-responden-online' ? 'active' : ''); ?> dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-pie-chart-fill" viewBox="0 0 20 20">
                                    <path
                                        d="M15.985 8.5H8.207l-5.5 5.5a8 8 0 0 0 13.277-5.5zM2 13.292A8 8 0 0 1 7.5.015v7.778l-5.5 5.5zM8.5.015V7.5h7.485A8.001 8.001 0 0 0 8.5.015z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Grafik Hasil Survei</span>
                    </a>
                    <div class="dropdown-menu" x-placement="right-start">

                        <li><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/rekap-responden-online"
                                class="font-weight-bold nav-link <?php if($ci->uri->segment(3) == 'rekap-responden-online'): ?> active <?php endif; ?>">Grafik
                                Profil Responden</a>
                        </li>

                        <li><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/chart-visualisasi-online"
                                class="font-weight-bold nav-link <?php if($ci->uri->segment(3) == 'chart-visualisasi-online'): ?> active <?php endif; ?>">Grafik
                                Unsur</a>
                        </li>


                    </div>
                </div>


                <?php if($manage_survey->is_active_target == 1): ?>
                <div class="navi-item my-2 btn-group dropright">
                    <a class="navi-link <?php echo e($ci->uri->segment(3) == 'rekap-per-wilayah-online' || $ci->uri->segment(3) == 'rekap-per-sektor-online' ? 'active' : ''); ?> dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-bar-chart-steps" viewBox="0 0 20 20">
                                    <path
                                        d="M.5 0a.5.5 0 0 1 .5.5v15a.5.5 0 0 1-1 0V.5A.5.5 0 0 1 .5 0zM2 1.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Rekap Target</span>
                    </a>
                    <div class="dropdown-menu" x-placement="right-start">


                        <li><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/rekap-per-sektor-online"
                                class="font-weight-bold nav-link <?php if($ci->uri->segment(3) == 'rekap-per-sektor-online'): ?> active <?php endif; ?>">Per
                                Sektor</a>
                        </li>

                        <li><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/rekap-per-wilayah-online"
                                class="font-weight-bold nav-link <?php if($ci->uri->segment(3) == 'rekap-per-wilayah-online'): ?> active <?php endif; ?>">Per
                                Wilayah</a>
                        </li>


                    </div>
                </div>
                <?php endif; ?>


                <div class="navi-item my-2 btn-group dropright">
                    <a class="navi-link <?php echo e($ci->uri->segment(3) == 'rekap-alasan-online' || $ci->uri->segment(3) == 'rekap-saran-online' ? 'active' : ''); ?> dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-book-half" viewBox="0 0 20 20">
                                    <path
                                        d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Rekap Hasil Survei</span>
                    </a>
                    <div class="dropdown-menu" x-placement="right-start">

                        <li><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/rekap-alasan-online"
                                class="font-weight-bold nav-link <?php if($ci->uri->segment(3) == 'rekap-alasan-online'): ?> active <?php endif; ?>">Rekap
                                Alasan Jawaban</a>
                        </li>


                        <?php if($is_saran == 1): ?>
                        <li><a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/rekap-saran-online"
                                class="font-weight-bold nav-link <?php if($ci->uri->segment(3) == 'rekap-saran-online'): ?> active <?php endif; ?>">Rekap
                                Saran</a>
                        </li>
                        <?php endif; ?>

                    </div>
                </div>


                <div class="navi-item my-2">
                    <a href="<?php echo e(base_url()); ?><?php echo e($ci->session->userdata('username')); ?>/<?php echo e($ci->uri->segment(2)); ?>/draft-kuesioner"
                        class="navi-link <?php echo e($ci->uri->segment(3) == 'draft-kuesioner' ? 'active' : ''); ?>" target="_blank">
                        <span class="navi-icon mr-4">
                            <span class="svg-icon svg-icon-lg">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-card-text" viewBox="0 0 20 20">
                                    <path
                                        d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                    <path
                                        d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </span>
                        </span>
                        <span class="navi-text font-weight-bolder font-size-lg">Draf Kuesioner</span>
                    </a>
                </div>

                <?php endif; ?>




            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\IT\Documents\Htdocs MAMP\surveiku_skks\application\views/manage_survey/menu_data_survey.blade.php ENDPATH**/ ?>