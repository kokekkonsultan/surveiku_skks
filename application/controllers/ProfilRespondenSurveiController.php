<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfilRespondenSurveiController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('ion_auth');

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata(
                'message_warning',
                'You must be logged in to access this page'
            );
            redirect('auth', 'refresh');
        }

        $this->load->library('form_validation');
        $this->load->model('ProfilRespondenSurvei_model', 'models');
    }

    public function index($id1, $id2)
    {
        $this->data = [];
        $this->data['title'] = 'Profil Responden';
        $this->data['profiles'] = $this->_get_data_profile($id1, $id2);

        $this->data['manage_survey'] = $this->db->get_where('manage_survey', ['slug' => $id2])->row();
        $table_identity = $this->data['manage_survey']->table_identity;
        $this->data['is_question'] = $this->data['manage_survey']->is_question;

        $this->data['profil_default'] = $this->db->query("SELECT *
		FROM profil_responden
		WHERE NOT EXISTS (SELECT * FROM profil_responden_$table_identity WHERE profil_responden.nama_profil_responden = profil_responden_$table_identity.nama_profil_responden) && id NOT IN (1,2,3)");




    // foreach($this->db->query("SELECT *,
    // (SELECT id_wilayah FROM users WHERE id = manage_survey.id_user) AS id_wilayah
    // FROM manage_survey
    // WHERE id > 77")->result() as $row){

    //     $insert_id = $row->id;

    //     $fk = 'survey_cst' . $insert_id . '_ibfk_1';
	// 	$fk1 = 'jawaban_pertanyaan_unsur_cst' . $insert_id . '_ibfk_2';
	// 	$fk2 = 'nilai_unsur_pelayanan_cst' . $insert_id . '_ibfk_1';
	// 	$fk3 = 'kategori_profil_responden_cst' . $insert_id . '_ibfk_3';
	// 	$fk4 = 'dimensi_cst' . $insert_id . '_ibfk_1';
	// 	$fk5 = 'unsur_cst' . $insert_id . '_ibfk_1';
	// 	$fk6 = 'pertanyaan_unsur_cst' . $insert_id . '_ibfk_4';

	// 	$tb_survey = 'survey_cst' . $insert_id;
	// 	$tb_responden = 'responden_cst' . $insert_id;
	// 	$tb_jawaban_pertanyaan_unsur = 'jawaban_pertanyaan_unsur_cst' . $insert_id;
	// 	$tb_tahapan_pembelian = 'tahapan_pembelian_cst' . $insert_id;
	// 	$tb_dimensi = 'dimensi_cst' . $insert_id;
	// 	$tb_unsur = 'unsur_cst' . $insert_id;

	// 	$tb_pertanyaan_unsur = 'pertanyaan_unsur_cst' . $insert_id;
	// 	$tb_nilai_unsur_pelayanan = 'nilai_unsur_pelayanan_cst' . $insert_id;
	// 	$tb_target = 'target_cst' . $insert_id;
	// 	$tb_profil_responden = 'profil_responden_cst' . $insert_id;
	// 	$tb_kategori_profil_responden = 'kategori_profil_responden_cst' . $insert_id;
	// 	$tb_log_survey = 'log_survey_cst' . $insert_id;
	// 	$tb_wilayah_survei = 'wilayah_survei_cst' . $insert_id;
	// 	$tb_sektor = 'sektor_cst' . $insert_id;


    //     $this->db->query("CREATE TABLE $tb_profil_responden LIKE profil_responden_cst77");
	// 	$this->db->query("INSERT INTO $tb_profil_responden SELECT * FROM profil_responden_cst77");

	// 	$this->db->query("CREATE TABLE $tb_kategori_profil_responden LIKE kategori_profil_responden_cst77");
    //     $this->db->query("INSERT INTO $tb_kategori_profil_responden SELECT * FROM kategori_profil_responden_cst77");



	// 	//BUAT TABEL PERTANYAAN UNSUR DLL
	// 	$this->db->query("CREATE TABLE $tb_tahapan_pembelian LIKE tahapan_pembelian_cst77");
    //     $this->db->query("INSERT INTO $tb_tahapan_pembelian SELECT * FROM tahapan_pembelian_cst77");

	// 	$this->db->query("CREATE TABLE $tb_dimensi LIKE dimensi_cst77");
    //     $this->db->query("INSERT INTO $tb_dimensi SELECT * FROM dimensi_cst77");

	// 	$this->db->query("CREATE TABLE $tb_unsur LIKE unsur_cst77");
    //     $this->db->query("INSERT INTO $tb_unsur SELECT * FROM unsur_cst77");

	// 	$this->db->query("CREATE TABLE $tb_pertanyaan_unsur LIKE pertanyaan_unsur_cst77");
    //     $this->db->query("INSERT INTO $tb_pertanyaan_unsur SELECT * FROM pertanyaan_unsur_cst77");

	// 	$this->db->query("CREATE TABLE $tb_nilai_unsur_pelayanan LIKE nilai_unsur_pelayanan_cst77");
    //     $this->db->query("INSERT INTO $tb_nilai_unsur_pelayanan SELECT * FROM nilai_unsur_pelayanan_cst77");


	// 	//BUAT TABEL RESPONDEN, SURVEI, DAN JAWABAN
	// 	$this->db->query("CREATE TABLE $tb_responden LIKE responden_cst77");
	// 	$this->db->query("CREATE TABLE $tb_survey LIKE survey_cst77");
	// 	$this->db->query("CREATE TABLE $tb_jawaban_pertanyaan_unsur LIKE jawaban_pertanyaan_unsur_cst77");
	// 	$this->db->query("CREATE TABLE $tb_log_survey LIKE log_survey_cst77");


    //     $this->db->query("ALTER TABLE $tb_dimensi ADD CONSTRAINT $fk4 FOREIGN KEY (`id_tahapan_pembelian`) REFERENCES $tb_tahapan_pembelian(`id`) ON DELETE CASCADE ON UPDATE CASCADE");
	// 	$this->db->query("ALTER TABLE $tb_unsur  ADD CONSTRAINT $fk5 FOREIGN KEY (`id_dimensi`) REFERENCES $tb_dimensi(`id`) ON DELETE CASCADE ON UPDATE CASCADE");
	// 	$this->db->query("ALTER TABLE $tb_pertanyaan_unsur  ADD CONSTRAINT $fk6 FOREIGN KEY (`id_unsur`) REFERENCES $tb_unsur(`id`) ON DELETE CASCADE ON UPDATE CASCADE");
	// 	$this->db->query("ALTER TABLE $tb_nilai_unsur_pelayanan ADD CONSTRAINT $fk2 FOREIGN KEY (`id_pertanyaan_unsur`) REFERENCES $tb_pertanyaan_unsur(`id`) ON DELETE CASCADE ON UPDATE CASCADE");
	// 	$this->db->query("ALTER TABLE $tb_survey ADD CONSTRAINT $fk FOREIGN KEY (`id_responden`) REFERENCES $tb_responden(`id`) ON DELETE CASCADE ON UPDATE CASCADE");
	// 	$this->db->query("ALTER TABLE $tb_jawaban_pertanyaan_unsur  ADD CONSTRAINT $fk1 FOREIGN KEY (`id_survey`) REFERENCES $tb_survey(`id`) ON DELETE CASCADE ON UPDATE CASCADE");


	// 	$this->db->query("CREATE TABLE $tb_sektor LIKE sektor_cst77");
    //     $this->db->query("INSERT INTO $tb_sektor SELECT * FROM sektor_cst77");
	// 	$this->db->query("CREATE TABLE $tb_target LIKE target_cst77");


	// 	//BUAT TABEL TRASH
	// 	$this->db->query("CREATE TABLE trash_responden_cst$insert_id LIKE responden_cst77");
	// 	$this->db->query("CREATE TABLE trash_survey_cst$insert_id LIKE survey_cst77");
	// 	$this->db->query("CREATE TABLE trash_jawaban_pertanyaan_unsur_cst$insert_id LIKE jawaban_pertanyaan_unsur_cst77");


       
    //     $this->db->query("
    //         CREATE TRIGGER log_app_cst$insert_id AFTER INSERT ON responden_cst$insert_id
    //         FOR EACH ROW BEGIN 
    //         INSERT INTO log_survey_cst$insert_id(log_value, log_time) VALUES(CONCAT(NEW.nama_lengkap, ', sudah mengisi survei'), DATE_ADD(NOW(), INTERVAL 13 HOUR));
    //         END");
    // }


        return view('profil_responden_survei/index', $this->data);
    }

    public function ajax_list()
    {
        $slug = $this->uri->segment(2);
        $get_identity = $this->db->get_where('manage_survey', ['slug' => "$slug"])->row();
        $table_identity = $get_identity->table_identity;

        $kategori_profil = $this->db->query("SELECT * FROM kategori_profil_responden_$table_identity
        UNION ALL
        SELECT id, 1, nama_sektor FROM sektor_$table_identity
        UNION ALL
        SELECT id, 2, nama_wilayah FROM wilayah_survei_$table_identity");

        $profil_responden = $this->db->get("profil_responden_$table_identity")->num_rows();

        $list = $this->models->get_datatables($table_identity);
        $data = [];
        $no = $_POST['start'];

        foreach ($list as $value) {
            $pilihan = [];
            foreach ($kategori_profil->result() as $get) {
                if ($get->id_profil_responden == $value->id) {
                    $pilihan[] = '<label><input type="radio">&ensp;' . $get->nama_kategori_profil_responden . '&emsp;</label>';
                }
            }
            $jawaban = implode('<br>', $pilihan);

            $no++;
            $row = [];

            for ($i = 1; $i <= $profil_responden; ++$i) {
                $selected = $no == $i ? 'selected' : '';
                $urutan[$no][] = '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
            }

            $row[] = '<input value="' . $value->id . '" name="id[]" hidden>
            <select name="urutan[]" class="form-control-sm">' . implode('<br>', $urutan[$no]) . '</select>';

            // $row[] = $no;
            $row[] = $value->id == 1 || $value->id == 2 || $value->id == 3 ? '<i class="fa fa-bookmark text-dark-50"></i> ' . $value->nama_profil_responden : $value->nama_profil_responden;

            $row[] = '<table></table>' . $jawaban;


            if ($value->id == 1 || $value->id == 2 || $value->id == 3) {
                $row[] = '';
            } else {
                $row[] = anchor($this->session->userdata('username') . '/' . $this->uri->segment(2) . '/profil-responden-survei/edit/' . $value->id, '<i class="fa fa-edit"></i> Edit', ['class' => 'btn btn-light-primary btn-sm font-weight-bold shadow']);
            }


            if ($get_identity->is_question == 1) {
                if ($value->id == 1 || $value->id == 2 || $value->id == 3) {
                    $row[] = '';
                } else {
                    $row[] = '<a class="btn btn-light-primary btn-sm font-weight-bold shadow" href="javascript:void(0)" title="Hapus ' . $value->nama_profil_responden . '" onclick="delete_data(' . "'" . $value->id . "'" . ')"><i class="fa fa-trash"></i> Delete</a>';
                }
            }
            $data[] = $row;
        }
        $output = [
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->models->count_all($table_identity),
            'recordsFiltered' => $this->models->count_filtered($table_identity),
            'data' => $data,
        ];
        echo json_encode($output);
    }

    public function update_urutan()
    {
        $manage_survey = $this->db
            ->get_where('manage_survey', ['slug' => $this->uri->segment(2)])
            ->row();
        $table_identity = $manage_survey->table_identity;

        foreach ($_POST['id'] as $key => $val) {
            $id = (int)$_POST['id'][$key];
            $urutan = $_POST['urutan'][$key];
            $this->db->query(
                "UPDATE profil_responden_$table_identity SET urutan=$urutan WHERE id=$id"
            );
        }

        $pesan = 'Data berhasil disimpan';
        $msg = ['sukses' => $pesan];
        echo json_encode($msg);
    }

    public function konfirmasi()
    {
        $manage_survey = $this->db->get_where('manage_survey', ['slug' => $this->uri->segment(2)])->row();

        if ($manage_survey->is_target == 1) {
            $is_target = 2;
        } else {
            $is_target = 1;
        }

        $this->db->truncate("target_$manage_survey->table_identity");
        $this->db->query("UPDATE manage_survey SET is_target = $is_target WHERE id=$manage_survey->id");

        $pesan = 'Data berhasil disimpan';
        $msg = ['sukses' => $pesan];
        echo json_encode($msg);
    }

    public function add_default()
    {
        $manage_survey = $this->db
            ->get_where('manage_survey', ['slug' => $this->uri->segment(2)])
            ->row();
        $table_identity = $manage_survey->table_identity;

        // $urutan = $this->db->get("profil_responden_$table_identity")->num_rows() + 1;

        $check = $this->input->post('check_list[]');
        $kode = [];
        foreach ($check as $row) {
            $kode[] = $row;
        }
        $id = implode(',', $kode);

        $this->db->query(
            "INSERT INTO profil_responden_$table_identity SELECT * FROM profil_responden WHERE id IN ($id)"
        );

        $this->db->query(
            "INSERT INTO kategori_profil_responden_$table_identity (id_profil_responden, nama_kategori_profil_responden) SELECT id_profil_responden, nama_kategori_profil_responden FROM kategori_profil_responden WHERE id_profil_responden IN ($id)"
        );

        //BUAT COLUMN BARU DI TABEL RESPONDEN
        $data_profil = $this->db
            ->query(
                "SELECT *, IF(type_data != '' ,'VARCHAR (255)','INT') AS type_data_db FROM profil_responden_$table_identity WHERE id IN ($id)"
            )
            ->result();

        foreach ($data_profil as $row) {
            // $this->db->query("UPDATE profil_responden_$table_identity SET urutan = $urutan WHERE id = $row->id");

            $this->db->query(
                "ALTER TABLE responden_$table_identity ADD $row->nama_alias $row->type_data_db"
            );
            $this->db->query(
                "ALTER TABLE trash_responden_$table_identity ADD $row->nama_alias $row->type_data_db"
            );

            if ($row->is_lainnya == 1) {
                $name_lainnya = $row->nama_alias . '_lainnya';
                $this->db->query(
                    "ALTER TABLE responden_$table_identity ADD $name_lainnya TEXT"
                );
                $this->db->query(
                    "ALTER TABLE trash_responden_$table_identity ADD $name_lainnya TEXT"
                );
            }
            // $urutan++;
        }
        $pesan = 'Data berhasil disimpan';
        $msg = ['sukses' => $pesan];
        echo json_encode($msg);
    }

    public function add_custom($id1, $id2)
    {
        $this->data = [];
        $this->data['title'] = 'Custom Profil Responden';
        $this->data['profiles'] = $this->_get_data_profile($id1, $id2);

        $this->db->select('');
        $this->db->from('manage_survey');
        $this->db->where('manage_survey.slug', $this->uri->segment(2));
        $table_identity = $this->db->get()->row()->table_identity;

        $this->form_validation->set_rules(
            'nama_profil_responden',
            'Nama Profil Responden',
            'trim|required'
        );
        $this->form_validation->set_rules(
            'jenis_jawaban',
            'Jenis Isian',
            'trim|required'
        );

        $this->data['nama_profil_responden'] = [
            'name' => 'nama_profil_responden',
            'id' => 'nama_profil_responden',
            'type' => 'text',
            'value' => $this->form_validation->set_value(
                'nama_profil_responden'
            ),
            'class' => 'form-control',
            'autofocus' => 'autofocus',
            'required' => 'required',
        ];

        if ($this->form_validation->run() == false) {
            return view('profil_responden_survei/form_add', $this->data);
        } else {
            $input = $this->input->post(null, true);

            $profil = $this->db->get('profil_responden')->num_rows();
            $profil_survei = $this->db->get_where(
                'profil_responden_' . $table_identity,
                ['is_default' => 2]
            );

            $nama_profil_responden = $input['nama_profil_responden'];

            //Cek terdapat tanda baca atau tidak
            if (!preg_match('/^[a-zA-Z0-9 ]+$/', $nama_profil_responden)) {
                $this->session->set_flashdata(
                    'message_danger',
                    'Penulisan Profil Responden tidak boleh menggunakan tanda baca!'
                );
                redirect(
                    base_url() .
                        $this->session->userdata('username') .
                        '/' .
                        $this->uri->segment(2) .
                        '/profil-responden-survei/add-custom',
                    'refresh'
                );
            } else {
                $nama_alias = preg_replace('/\s+/', '_', strtolower($nama_profil_responden));

                $cek_nama = $this->db->query("SELECT * FROM profil_responden_$table_identity WHERE nama_alias = '$nama_alias'");

                if ($cek_nama->num_rows() != 0) {
                    $this->session->set_flashdata('message_danger', 'Mohon maaf Nama Profil Responden yang anda isikan sudah ada!');
                    redirect(base_url() . $this->session->userdata('username') . '/' . $this->uri->segment(2) . '/profil-responden-survei', 'refresh');
                } else {
                    //CEK PERTANYAAN CUSTOM CUDAH ADA APA BELUM
                    if ($profil_survei->num_rows() == 0) {
                        $cek_id = $profil + 1;
                    } else {
                        $cek_id = '';
                    }

                    //CEK TYPE JENIS JAWABAN
                    if ($input['jenis_jawaban'] == 2) {
                        if (isset($_POST['type_data'])) {
                            $cek_type_data = $input['type_data'];
                        } else {
                            $cek_type_data = 'text';
                        }
                        $is_lainnya = '';
                    } else {
                        $cek_type_data = '';
                        $is_lainnya = $input['opsi_lainnya'];
                    }

                    $data = [
                        'id' => $cek_id,
                        'nama_profil_responden' => $input['nama_profil_responden'],
                        'jenis_isian' => $input['jenis_jawaban'],
                        'is_default' => 2,
                        'type_data' => $cek_type_data,
                        'is_lainnya' => $is_lainnya,
                        'nama_alias' => $nama_alias,
                    ];
                    $this->db->insert('profil_responden_' . $table_identity, $data);
                    $id_profil_responden = $this->db->insert_id();

                    if ($input['jenis_jawaban'] == '1') {
                        $id_profil_responden = $this->db->insert_id();
                        $pilihan_jawaban = $input['pilihan_jawaban'];

                        $result = [];
                        foreach ($_POST['pilihan_jawaban'] as $key => $val) {

                            $result[] = [
                                'id_profil_responden' => $id_profil_responden,
                                'nama_kategori_profil_responden' => $pilihan_jawaban[$key],
                            ];
                        }

                        if ($input['opsi_lainnya'] == 1) {
                            $result[] = [
                                'id_profil_responden' => $id_profil_responden,
                                'nama_kategori_profil_responden' => 'Lainnya',
                            ];
                        }
                        $this->db->insert_batch('kategori_profil_responden_' . $table_identity, $result);

                        //DELETE PILIHAN JAWABAN YANG KOSONG
                        $this->db->query("DELETE FROM kategori_profil_responden_$table_identity WHERE id_profil_responden = $id_profil_responden && nama_kategori_profil_responden = ''");
                    }

                    $data_profil = $this->db->query("SELECT *, IF(type_data != '' ,'VARCHAR (255)','INT') AS type_data_db FROM profil_responden_$table_identity WHERE id = $id_profil_responden")->row();

                    $this->db->query(
                        "ALTER TABLE responden_$table_identity ADD $data_profil->nama_alias $data_profil->type_data_db"
                    );
                    $this->db->query(
                        "ALTER TABLE trash_responden_$table_identity ADD $data_profil->nama_alias $data_profil->type_data_db"
                    );

                    if ($data_profil->is_lainnya == 1) {
                        $nama_lainnya = $data_profil->nama_alias . '_lainnya';
                        $this->db->query(
                            "ALTER TABLE responden_$table_identity ADD $nama_lainnya TEXT"
                        );
                        $this->db->query(
                            "ALTER TABLE trash_responden_$table_identity ADD $nama_lainnya TEXT"
                        );
                    }

                    $this->session->set_flashdata('message_success', 'Berhasil menambah data');
                    redirect(base_url() . $this->session->userdata('username') . '/' . $this->uri->segment(2) . '/profil-responden-survei', 'refresh');
                }
            }
        }
    }


    //LAST 04-01-2022
    public function edit($id1, $id2)
    {
        $this->data = [];
        $this->data['title'] = 'Edit Profil Responden';
        $this->data['profiles'] = $this->_get_data_profile($id1, $id2);

        $this->db->select('*');
        $this->db->from('manage_survey');
        $this->db->where('manage_survey.slug', $this->uri->segment(2));
        $table_identity = $this->db->get()->row()->table_identity;

        $this->data['profil_responden'] = $this->db->query("SELECT *, IF(type_data != '' ,'VARCHAR (255)','INT') AS type_data_db FROM profil_responden_$table_identity WHERE id =" . $this->uri->segment(5))->row();
        $profil_responden = $this->data['profil_responden'];

        $this->data['kategori_profil_responden'] = $this->db->query("SELECT *, (SELECT is_lainnya FROM profil_responden_$table_identity WHERE id_profil_responden = profil_responden_$table_identity.id) AS is_lainnya
        FROM (SELECT * FROM kategori_profil_responden_$table_identity
        UNION ALL
        SELECT id, 1, nama_sektor FROM sektor_$table_identity
        UNION ALL
        SELECT id, 2, nama_wilayah FROM wilayah_survei_$table_identity) AS kpr
        WHERE id_profil_responden = " . $this->uri->segment(5));

        $this->form_validation->set_rules('nama_profil_responden', 'Nama Profil Responden', 'trim|required');

        if ($this->form_validation->run() == false) {

            $this->data['nama_profil_responden'] = [
                'name' => 'nama_profil_responden',
                'id' => 'nama_profil_responden',
                'type' => 'text',
                'value' => $this->form_validation->set_value('nama_profil_responden', $profil_responden->nama_profil_responden),
                'class' => 'form-control',
                'autofocus' => 'autofocus',
                'required' => 'required',
            ];

            $this->data['jenis_isian'] = [
                'name' => 'jenis_isian',
                'type' => 'hidden',
                'value' => $this->form_validation->set_value('jenis_isian', $profil_responden->jenis_isian),
            ];

            return view('profil_responden_survei/form_edit', $this->data);
        } else {
            $input = $this->input->post(null, true);

            //CEK TYPE DATA
            if ($input['type_data'] == '') {
                $cek_type_data = 'INT';
            } else {
                $cek_type_data = 'VARCHAR (255)';
            }

            // $new_nama_profil_responden =  preg_replace('/\s+/', '_', strtolower($input['nama_profil_responden']));
            $this->db->query(
                "ALTER TABLE responden_$table_identity CHANGE $profil_responden->nama_alias $profil_responden->nama_alias $cek_type_data"
            );
            $this->db->query(
                "ALTER TABLE trash_responden_$table_identity CHANGE $profil_responden->nama_alias $profil_responden->nama_alias $cek_type_data"
            );


            $id_profil_responden = $this->uri->segment(5);
            $data = [
                'nama_profil_responden' => $input['nama_profil_responden'],
                'type_data' => $input['type_data'],
            ];
            $this->db->where('id', $id_profil_responden);
            $this->db->update('profil_responden_' . $table_identity, $data);

            if ($this->input->post('jenis_isian') == 1) {

                //CEK URI SEGMENT TERLEBIH DAHULU
                if ($this->uri->segment(5) == 1) {
                    $this->db->truncate("sektor_$table_identity");
                    $result = [];
                    foreach ($_POST['pilihan_jawaban'] as $key => $val) {
                        $result[] = ['nama_sektor' => $input['pilihan_jawaban'][$key]];
                    }
                    $this->db->insert_batch('sektor_' . $table_identity, $result);

                    //HAPUS SEKTOR YANG KOSONG
                    $this->db->query("DELETE FROM sektor_$table_identity WHERE nama_sektor = ''");
                } elseif ($this->uri->segment(5) == 2) {

                    $this->db->truncate("wilayah_survei_$table_identity");
                    $result = [];
                    foreach ($_POST['pilihan_jawaban'] as $key => $val) {
                        $result[] = ['nama_wilayah' => $input['pilihan_jawaban'][$key]];
                    }
                    $this->db->insert_batch('wilayah_survei_' . $table_identity, $result);

                    //HAPUS WILAYAH SURVEI YANG KOSONG
                    $this->db->query("DELETE FROM wilayah_survei_$table_identity WHERE nama_wilayah = ''");
                } else {

                    //JIKA ADA ISI KATEGORI SEBELUMNYA MAKA JALANKAN INI
                    if ($this->data['kategori_profil_responden']->num_rows() > 0) {
                        $this->db->query("DELETE FROM kategori_profil_responden_$table_identity WHERE id_profil_responden = $id_profil_responden");
                    }

                    $result = [];
                    foreach ($_POST['pilihan_jawaban'] as $key => $val) {
                        $result[] = [
                            'id_profil_responden' => $id_profil_responden,
                            'nama_kategori_profil_responden' => $input['pilihan_jawaban'][$key]
                        ];
                    }
                    $this->db->insert_batch('kategori_profil_responden_' . $table_identity, $result);

                    //HAPUS KATEGORI YANG KOSONG
                    $this->db->query("DELETE FROM kategori_profil_responden_$table_identity WHERE id_profil_responden = $id_profil_responden && nama_kategori_profil_responden = ''");
                }
            }

            $this->session->set_flashdata('message_success', 'Berhasil mengubah data');
            redirect(base_url() . $this->session->userdata('username') . '/' . $this->uri->segment(2) . '/profil-responden-survei', 'refresh');
        }
    }

    public function delete($id = null)
    {
        $this->db->select('*');
        $this->db->from('manage_survey');
        $this->db->where('manage_survey.slug', $this->uri->segment(2));
        $table_identity = $this->db->get()->row()->table_identity;

        $profil_responden = $this->db->get_where('profil_responden_' . $table_identity, ['id' => $this->uri->segment('5')])->row();
        $nama_alias = $profil_responden->nama_alias;

        $this->db->query(
            "ALTER TABLE responden_$table_identity DROP COLUMN $nama_alias"
        );
        $this->db->query(
            "ALTER TABLE trash_responden_$table_identity DROP COLUMN $nama_alias"
        );

        if ($profil_responden->is_lainnya == 1) {
            $nama_lainnya = $nama_alias . '_lainnya';
            $this->db->query(
                "ALTER TABLE responden_$table_identity DROP COLUMN $nama_lainnya"
            );
            $this->db->query(
                "ALTER TABLE trash_responden_$table_identity DROP COLUMN $nama_lainnya"
            );
        }

        $this->db->where('id_profil_responden', $this->uri->segment('5'));
        $this->db->delete('kategori_profil_responden_' . $table_identity);

        $this->db->where('id', $this->uri->segment('5'));
        $this->db->delete('profil_responden_' . $table_identity);

        echo json_encode(['status' => true]);
    }

    public function _get_data_profile($id1, $id2)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('users_groups', 'users.id = users_groups.user_id');
        $this->db->where(
            'users.username',
            $this->session->userdata('username')
        );
        $data_user = $this->db->get()->row();
        $user_identity = 'drs' . $data_user->is_parent;

        $this->db->select(
            'users.username, manage_survey.survey_name, manage_survey.slug, manage_survey.description, manage_survey.is_privacy, manage_survey.table_identity, manage_survey.atribut_pertanyaan_survey'
        );
        if ($data_user->group_id == 2) {
            $this->db->from('users');
            $this->db->join(
                'manage_survey',
                'manage_survey.id_user = users.id'
            );
        } else {
            $this->db->from('manage_survey');
            $this->db->join(
                "supervisor_$user_identity",
                "manage_survey.id_berlangganan = supervisor_$user_identity.id_berlangganan"
            );
            $this->db->join(
                'users',
                "supervisor_$user_identity.id_user = users.id"
            );
        }
        $this->db->where('users.username', $id1);
        $this->db->where('manage_survey.slug', $id2);
        $profiles = $this->db->get();

        if ($profiles->num_rows() == 0) {
            // echo 'Survey tidak ditemukan atau sudah dihapus !';
            // exit();
            show_404();
        }
        return $profiles->row();
    }
}