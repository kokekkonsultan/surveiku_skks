<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library('ion_auth');

		if (!$this->ion_auth->logged_in()) {
			$this->session->set_flashdata('message_warning', 'You must be logged in to access this page');
			redirect('auth', 'refresh');
		}
		$this->load->model('ManageSurvey_model', 'models');
	}
	
	
	public function index()
	{
		$this->data = [];
		$this->data['title'] = 'Dashboard';


		return view('dashboard/index', $this->data);
	}

	public function jumlah_survei()
	{
		$user_id = $this->session->userdata('user_id');

		$this->db->select('COUNT(id) AS jumlah_survei');
		$query = $this->db->get_where('manage_survey', ['id_user' => $user_id])->row();

		$this->data = [];
		$this->data['jumlah_survei'] = $query->jumlah_survei;


		return view('dashboard/jumlah_survei', $this->data);
		// echo json_encode($data);
	}

	public function prosedur_aplikasi()
	{
		$this->data = [];
		$this->data['title'] = 'Prosedur Penggunaan Aplikasi';


		return view('dashboard/prosedur_aplikasi', $this->data);
	}


	public function get_chart_survei()
	{
		$this->data = [];
		$this->data['title'] = 'Dashboard Chart';

		$manage_survey = $this->db->get_where("manage_survey", array('id_user' => $this->session->userdata('user_id')));

		$users_groups = $this->db->get_where("users_groups", array('user_id' => $this->session->userdata('user_id')))->row();

		if ($users_groups->group_id == 2) {
			$this->db->select('*, manage_survey.slug AS slug_manage_survey');
			$this->db->from('manage_survey');
			$this->db->where('id_user', $this->session->userdata('user_id'));
		} else {
			$data_user = $this->db->get_where("users", array('id' => $this->session->userdata('user_id')))->row();

			$this->db->select('*, manage_survey.slug AS slug_manage_survey');
			$this->db->from('manage_survey');
			$this->db->join("supervisor_drs$data_user->is_parent", "manage_survey.id_berlangganan = supervisor_drs$data_user->is_parent.id_berlangganan");
			$this->db->where("supervisor_drs$data_user->is_parent.id_user", $this->session->userdata('user_id'));
		}
		$manage_survey = $this->db->get();

		if ($manage_survey->num_rows() > 0) {

			$data_chart = [];
			$no = 1;
			foreach ($manage_survey->result() as $value) {

				if ($this->db->get_where("survey_$value->table_identity", ['is_submit' => 1])->num_rows() > 0) {

					$nilai[$no] = $this->db->query("SELECT SUM(rata_rata_x_bobot) AS indeks, SUM(rata_rata_x_bobot) * 25 AS nilai_konversi
					FROM (
					SELECT ((SELECT AVG(skor_jawaban) FROM jawaban_pertanyaan_unsur_$value->table_identity JOIN survey_$value->table_identity ON jawaban_pertanyaan_unsur_$value->table_identity.id_survey = survey_$value->table_identity.id WHERE id_pertanyaan_unsur = pertanyaan_unsur_$value->table_identity.id && is_submit = 1) / (SELECT COUNT(id) FROM unsur_$value->table_identity)) AS rata_rata_x_bobot
	
					FROM pertanyaan_unsur_$value->table_identity
					) pu_$value->table_identity")->row();
	

					$data_chart[] = '{"label": "' . $value->survey_name . '", "value": "' . ROUND($nilai[$no]->nilai_konversi, 2) . '"}';
				} else {
					// $nama_survei[] = "'" . $value->survey_name . "'";
					// $skor_akhir[] = 0;
					$data_chart[] = '{"label": "' . $value->survey_name . '", "value": "0"}';
				};
				$no++;
			}
			$this->data['get_data_chart'] = implode(", ", $data_chart);
		} else {
			$this->data['get_data_chart'] = '{"label": "", "value": "0"}';
		}
		return view("dashboard/chart_survei", $this->data);
	}




	public function get_tabel_survei()
	{
		$this->data = [];
		$this->data['title'] = 'Dashboard Tabel';

		return view("dashboard/tabel_survei", $this->data);
	}


	public function ajax_list_tabel_survei()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('users_groups', 'users.id = users_groups.user_id');
		$this->db->where('users.username', $this->session->userdata('username'));
		$data_user = $this->db->get()->row();

		$list = $this->models->get_datatables($data_user);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {

			$no++;
			$row = array();

			if ($this->db->get_where("survey_$value->table_identity", ['is_submit' => 1])->num_rows() > 0) {

				$nilai[$no] = $this->db->query("SELECT SUM(rata_rata_x_bobot) AS indeks, SUM(rata_rata_x_bobot) * 25 AS nilai_konversi
				FROM (
				SELECT ((SELECT AVG(skor_jawaban) FROM jawaban_pertanyaan_unsur_$value->table_identity JOIN survey_$value->table_identity ON jawaban_pertanyaan_unsur_$value->table_identity.id_survey = survey_$value->table_identity.id WHERE id_pertanyaan_unsur = pertanyaan_unsur_$value->table_identity.id && is_submit = 1) / (SELECT COUNT(id) FROM unsur_$value->table_identity)) AS rata_rata_x_bobot

				FROM pertanyaan_unsur_$value->table_identity
				) pu_$value->table_identity")->row();

				$skor_akhir[$no] = $nilai[$no]->nilai_konversi;
				
			} else {
				$skor_akhir[$no] = 0;
			};

			
			#kategori
			if ($skor_akhir[$no] <= 100 && $skor_akhir[$no] >= 80) {
				$kategori[$no] = 'Sangat Baik';
			} elseif ($skor_akhir[$no] <= 79.99 && $skor_akhir[$no] >= 50) {
				$kategori[$no] = 'Baik';
			} elseif ($skor_akhir[$no] <= 49.99 && $skor_akhir[$no] >= 25) {
				$kategori[$no] = 'Kurang Baik';
			} elseif ($skor_akhir[$no] <= 24.99 && $skor_akhir[$no] >= 0) {
				$kategori[$no] = 'Buruk';
			} else {
				$kategori[$no] = 'NULL';
			}


			$row[] = $no;
			$row[] = $value->survey_name;
			$row[] = ROUND($skor_akhir[$no], 2);
			$row[] = $kategori[$no];

			$data[] = $row;
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->models->count_all($data_user),
			"recordsFiltered" 	=> $this->models->count_filtered($data_user),
			"data" 				=> $data,
		);

		echo json_encode($output);
	}

	public function get_detail_hasil_analisa()
	{

		$this->data = [];
		$id_manage_survey = $this->uri->segment(4);
		$this->data['id_manage_survey'] = $id_manage_survey;

		$this->data['manage_survey'] = $this->db->get_where('manage_survey', array('id' => $id_manage_survey))->row();


		return view('dashboard/detail_hasil_analisa', $this->data);
	}
}

/* End of file DashboardController.php */
/* Location: ./application/controllers/DashboardController.php */