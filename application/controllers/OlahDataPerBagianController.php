<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OlahDataPerBagianController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('ion_auth');

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('message_warning', 'You must be an admin to view this page');
            redirect('auth', 'refresh');
        }
        $this->load->library('form_validation');
        $this->load->model('DataPerolehanPerBagian_model', 'models');
        $this->load->model('OlahData_model', 'models');
        $this->load->model('OlahData_model');
    }

    public function index()
    {
        $this->data = [];
        $this->data['title'] = 'Olah Data';

        $klien_induk = $this->db->get_where("pengguna_klien_induk", array('id_user' => $this->session->userdata('user_id')))->row();
        $parent = implode(", ", unserialize($klien_induk->cakupan_induk));

        $this->db->select('*, manage_survey.slug AS slug_manage_survey, (SELECT first_name FROM users WHERE users.id = manage_survey.id_user) AS first_name, (SELECT last_name FROM users WHERE users.id = manage_survey.id_user) AS last_name');
        $this->db->from('manage_survey');
        $this->db->where("id IN ($parent)");

        $manage_survey = $this->db->get();

        if ($manage_survey->num_rows() > 0) {
            $nama_survei = [];
            $skor_akhir = [];
            $no = 1;
            foreach ($manage_survey->result() as $value) {

                $this->db->select('*');
                $this->db->from('users');
                $this->db->join('users_groups', 'users.id = users_groups.user_id');
                $this->db->where('users.id', $value->id_user);
                $data_user = $this->db->get()->row();

                if ($this->db->get_where("survey_$value->table_identity", ['is_submit' => 1])->num_rows() > 0) {

                    $nilai[$no] = $this->db->query("SELECT SUM(rata_rata_x_bobot) AS indeks, SUM(rata_rata_x_bobot) * 25 AS nilai_konversi
					FROM (
					SELECT ((SELECT AVG(skor_jawaban) FROM jawaban_pertanyaan_unsur_$value->table_identity JOIN survey_$value->table_identity ON jawaban_pertanyaan_unsur_$value->table_identity.id_survey = survey_$value->table_identity.id WHERE id_pertanyaan_unsur = pertanyaan_unsur_$value->table_identity.id && is_submit = 1) / (SELECT COUNT(id) FROM unsur_$value->table_identity)) AS rata_rata_x_bobot
	
					FROM pertanyaan_unsur_$value->table_identity
					) pu_$value->table_identity")->row();


                    $data_chart[] = '{"label": "' . $data_user->first_name . ' ' . $data_user->last_name . '",
						"value": "' . ROUND($nilai[$no]->nilai_konversi, 2) . '"}';
                } else {
                    $data_chart[] = '{"label": "' . $data_user->first_name . ' ' . $data_user->last_name . '", "value": "0"}';
                };
                $no++;
            }
            $this->data['get_data_chart'] = implode(", ", $data_chart);
        } else {
            $this->data['get_data_chart'] = '{"label": "", "value": "0"}';
        }

        return view('olah_data_per_bagian/index', $this->data);
    }

    public function ajax_list()
    {
        $klien_induk = $this->db->get_where("pengguna_klien_induk", array('id_user' => $this->session->userdata('user_id')))->row();
        $parent = implode(", ", unserialize($klien_induk->cakupan_induk));

        $list = $this->models->get_datatables($parent);
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $value) {

            $klien_user = $this->db->get_where("users", array('id' => $value->id_user))->row();

            if ($this->db->get_where("survey_$value->table_identity", ['is_submit' => 1])->num_rows() > 0) {

                $nilai = $this->db->query("SELECT SUM(rata_rata_x_bobot) AS indeks, SUM(rata_rata_x_bobot) * 25 AS nilai_konversi
                FROM (
                SELECT ((SELECT AVG(skor_jawaban) FROM jawaban_pertanyaan_unsur_$value->table_identity JOIN survey_$value->table_identity ON jawaban_pertanyaan_unsur_$value->table_identity.id_survey = survey_$value->table_identity.id WHERE id_pertanyaan_unsur = pertanyaan_unsur_$value->table_identity.id && is_submit = 1) / (SELECT COUNT(id) FROM unsur_$value->table_identity)) AS rata_rata_x_bobot

                FROM pertanyaan_unsur_$value->table_identity
                ) pu_$value->table_identity")->row();

                $skor_akhir = $nilai->nilai_konversi;
            } else {
                $skor_akhir = 0;
            };

            if ($skor_akhir <= 100 && $skor_akhir >= 80) {
                $kategori = 'Sangat Baik';
            } elseif ($skor_akhir <= 79.99 && $skor_akhir >= 50) {
                $kategori = 'Baik';
            } elseif ($skor_akhir <= 49.99 && $skor_akhir >= 25) {
                $kategori = 'Kurang Baik';
            } elseif ($skor_akhir <= 24.99 && $skor_akhir >= 0) {
                $kategori = 'Buruk';
            } else {
                $kategori = 'NULL';
            }

            $no++;
            $row = array();
            $row[] = '
			<a href="' . base_url() . 'olah-data-per-bagian/' . $klien_user->username . '/' . $value->slug . '" title="">
			<div class="card mb-5 shadow" style="background-color: SeaShell;">
				<div class="card-body">
					<div class="row">
						<div class="col sm-10">
							<strong style="font-size: 17px;">' . $value->first_name . ' ' . $value->last_name . '</strong><br>
							<span class="text-dark">Nama Survei : <b>' . $value->survey_name . '</b></span><br>
                            <span class="text-dark">Nilai : <b>' . ROUND($skor_akhir, 2) . '</b></span><br>
                            <span class="text-dark">Kategori : <b>' . $kategori . '</b></span><br>
						</div>
						<div class="col sm-2 text-right"><span class="badge badge-info" width="40%">Detail</span>
							<div class="mt-3 text-dark font-weight-bold" style="font-size: 11px;">
                            Periode Survei : ' . date('d-m-Y', strtotime($value->survey_start)) . ' s/d ' . date('d-m-Y', strtotime($value->survey_end)) . '
							</div>

						</div>
					</div>
					
				</div>
			</div>
		</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->models->count_all($parent),
            "recordsFiltered" => $this->models->count_filtered($parent),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function detail($id1, $id2)
    {
        $this->data = [];
        $this->data['title'] = 'Olah Data';
        $this->data['profiles'] = $this->_get_data_profile($id1, $id2);


        $get_identity = $this->db->get_where('manage_survey', ['slug' => $this->uri->segment(3)])->row();
        $table_identity = $get_identity->table_identity;
        $this->data['nama_survey'] = $get_identity->survey_name;

        $this->data['jumlah_kuesioner_terisi'] = $this->db->get_where("survey_$table_identity", ['is_submit' => 1])->num_rows();

        $this->data['unsur']  = $this->db->query("SELECT *, SUBSTR(kode_unsur, 2) AS kode_alasan FROM unsur_$table_identity");

        //TOTAL
        $this->data['total'] = $this->db->query("SELECT *, (SELECT COUNT(id) FROM unsur_$table_identity) AS jumlah_unsur,
        (SELECT SUM(skor_jawaban) FROM jawaban_pertanyaan_unsur_$table_identity JOIN survey_$table_identity ON jawaban_pertanyaan_unsur_$table_identity.id_survey = survey_$table_identity.id WHERE id_pertanyaan_unsur = pertanyaan_unsur_$table_identity.id && is_submit = 1) AS sum_skor_jawaban,
        (SELECT AVG(skor_jawaban) FROM jawaban_pertanyaan_unsur_$table_identity JOIN survey_$table_identity ON jawaban_pertanyaan_unsur_$table_identity.id_survey = survey_$table_identity.id WHERE id_pertanyaan_unsur = pertanyaan_unsur_$table_identity.id && is_submit = 1) AS rata_rata,
        ((SELECT AVG(skor_jawaban) FROM jawaban_pertanyaan_unsur_$table_identity JOIN survey_$table_identity ON jawaban_pertanyaan_unsur_$table_identity.id_survey = survey_$table_identity.id WHERE id_pertanyaan_unsur = pertanyaan_unsur_$table_identity.id && is_submit = 1) / (SELECT COUNT(id) FROM unsur_$table_identity)) AS rata_rata_X_bobot
        
        FROM pertanyaan_unsur_$table_identity");



        $this->data['rata_rata_per_dimensi'] = $this->db->query("SELECT *, 
        (SELECT COUNT(id) FROM unsur_$table_identity WHERE id_dimensi = dimensi_$table_identity.id) AS jumlah_unsur,
        
        (SELECT SUM(skor_jawaban) FROM jawaban_pertanyaan_unsur_$table_identity JOIN survey_$table_identity ON jawaban_pertanyaan_unsur_$table_identity.id_survey = survey_$table_identity.id JOIN pertanyaan_unsur_$table_identity ON jawaban_pertanyaan_unsur_$table_identity.id_pertanyaan_unsur = pertanyaan_unsur_$table_identity.id JOIN unsur_$table_identity ON pertanyaan_unsur_$table_identity.id_unsur = unsur_$table_identity.id WHERE id_dimensi = dimensi_$table_identity.id && is_submit = 1) AS sum_dimensi,
        
        (SELECT AVG(skor_jawaban) FROM jawaban_pertanyaan_unsur_$table_identity JOIN survey_$table_identity ON jawaban_pertanyaan_unsur_$table_identity.id_survey = survey_$table_identity.id JOIN pertanyaan_unsur_$table_identity ON jawaban_pertanyaan_unsur_$table_identity.id_pertanyaan_unsur = pertanyaan_unsur_$table_identity.id JOIN unsur_$table_identity ON pertanyaan_unsur_$table_identity.id_unsur = unsur_$table_identity.id WHERE id_dimensi = dimensi_$table_identity.id && is_submit = 1) AS rata_rata
        
        FROM dimensi_$table_identity");

        return view('olah_data_per_bagian/detail', $this->data);
    }



    public function _get_data_profile($id1, $id2)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('users_groups', 'users.id = users_groups.user_id');
        $this->db->where('users.username', $id1);
        $data_user = $this->db->get()->row();
        $user_identity = 'drs' . $data_user->is_parent;

        $this->db->select('users.username, manage_survey.survey_name, manage_survey.slug, manage_survey.description, manage_survey.is_privacy, manage_survey.table_identity, manage_survey.atribut_pertanyaan_survey');
        if ($data_user->group_id == 2) {
            $this->db->from('users');
            $this->db->join('manage_survey', 'manage_survey.id_user = users.id');
        } else {
            $this->db->from('manage_survey');
            $this->db->join("supervisor_$user_identity", "manage_survey.id_berlangganan = supervisor_$user_identity.id_berlangganan");
            $this->db->join("users", "supervisor_$user_identity.id_user = users.id");
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

/* End of file OlahDataPerBagianController.php */
/* Location: ./application/controllers/OlahDataPerBagianController.php */
