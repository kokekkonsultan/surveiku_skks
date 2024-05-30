<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SertifikatIndukPerBagianController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('message_warning', 'You must be an admin to view this page');
            redirect('auth', 'refresh');
        }
        $this->load->library('form_validation');
        $this->load->model('DataPerolehanPerBagian_model', 'models');
    }

    public function index()
    {
        $this->data = [];
		$this->data['title'] = 'E-Sertifikat Per Bagian';

		return view('sertifikat_per_bagian/index', $this->data);
    }

    public function detail($id1, $id2)
    {
        $this->data = [];
        $this->data['title'] = "E-Sertifikat Per Bagian";

        $this->data['profiles'] = $this->_get_data_profile($id1, $id2);
        $this->data['user'] = $this->ion_auth->user()->row();

        $this->db->select("*, manage_survey.id AS id_manage_survey, manage_survey.survey_name, manage_survey.table_identity AS table_identity,  DATE_FORMAT(survey_start, '%M') AS survey_mulai, DATE_FORMAT(survey_end, '%M %Y') AS survey_selesai");
        $this->db->from('manage_survey');
        $this->db->where('manage_survey.slug', $this->uri->segment(3));
        $manage_survey = $this->db->get()->row();
        $this->data['manage_survey'] = $manage_survey;
        $table_identity = $manage_survey->table_identity;
        $this->data['nama_survey'] = $manage_survey->survey_name;

        //echo $table_identity;

        //LOAD PROFIL RESPONDEN
        $this->data['profil_responden'] = $this->db->query("SELECT * FROM profil_responden_$table_identity WHERE jenis_isian = 1 && id NOT IN (1,2)");

        // if (date("Y-m-d") < $manage_survey->survey_end) {
        //     $this->data['pesan'] = 'Halaman ini hanya bisa dikelola jika periode survei sudah diselesai atau survei sudah ditutup.';
        //     return view('not_questions/index', $this->data);
        // }

        $this->data['jumlah_kuisioner'] = $this->db->get_where("survey_$table_identity", array('is_submit' => 1))->num_rows();

        if ($this->data['jumlah_kuisioner'] == 0) {
            $this->data['pesan'] = 'survei belum dimulai atau belum ada responden !';
            return view('not_questions/index', $this->data);
        }


        $this->data['rata_rata_per_unsur_x_bobot'] = $this->db->query("SELECT kode_unsur, persentase_unsur, (SELECT AVG(skor_jawaban) FROM jawaban_pertanyaan_unsur_$table_identity
        JOIN survey_$table_identity ON jawaban_pertanyaan_unsur_$table_identity.id_survey = survey_$table_identity.id
        WHERE id_pertanyaan_unsur = pertanyaan_unsur_$table_identity.id && is_submit = 1) AS rata_per_unsur,
        
        (SELECT unsur_$table_identity.persentase_unsur / 100) AS persentase_unsur_dibagi_100,
        
        ((SELECT AVG(skor_jawaban) FROM jawaban_pertanyaan_unsur_$table_identity
        JOIN survey_$table_identity ON jawaban_pertanyaan_unsur_$table_identity.id_survey = survey_$table_identity.id
        WHERE id_pertanyaan_unsur = pertanyaan_unsur_$table_identity.id && is_submit = 1) * (unsur_$table_identity.persentase_unsur / 100)) AS persen_per_unsur
        
        FROM pertanyaan_unsur_$table_identity
        JOIN unsur_$table_identity ON pertanyaan_unsur_$table_identity.id_unsur = unsur_$table_identity.id");

        foreach ($this->data['rata_rata_per_unsur_x_bobot']->result() as $rows) {
            $total[] = $rows->persen_per_unsur;
            $this->data['ikk'] = array_sum($total);
        }


        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
        $this->form_validation->set_rules('model_sertifikat', 'Model sertifikat', 'trim|required');
        $this->form_validation->set_rules('periode', 'Periode Survei', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            return view('sertifikat_per_bagian/detail', $this->data);
        } else {
            if ($manage_survey->nomor_sertifikat == NULL) {

                $array_bulan = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
                $bulan = $array_bulan[date('n')];

                $object = [
                    'nomor_sertifikat'     => '000' . $manage_survey->id .  '/IKK/' .  $manage_survey->id_user . '/' . $bulan . '/' . date('Y'),
                    // 'qr_code' 	=> $table_identity . '.png'
                ];
                $this->db->where('slug', $this->uri->segment(3));
                $this->db->update('manage_survey', $object);
            };


            $input     = $this->input->post(NULL, TRUE);
            $this->data['nama'] = $input['nama'];
            $this->data['jabatan'] = $input['jabatan'];
            $this->data['model_sertifikat'] = $input['model_sertifikat'];
            $this->data['periode'] = $input['periode'];
            $this->data['table_identity'] = $table_identity;
            $profil_responden = $input['profil_responden'];
            $data_profil = implode(",", $profil_responden);

            //TAMPILKAN PROFIL YANG DIPILIH
            $this->data['profil'] = $this->db->query("SELECT *,  REPLACE(LOWER(nama_profil_responden), ' ', '_') AS nama_alias FROM profil_responden_$table_identity WHERE id IN ($data_profil)");

            $this->data['qr_code'] = 'https://image-charts.com/chart?chl=' . base_url() . 'validasi-sertifikat/' . $manage_survey->uuid . '&choe=UTF-8&chs=300x300&cht=qr';


            //------------------------------CETAK-------------------------//
            $this->load->library('pdfgenerator');
            $this->data['title_pdf'] = 'SERTIFIKAT E-IKK';
            $file_pdf = 'SERTIFIKAT E-IKK';
            $paper = 'A4';
            $orientation = "potrait";

            $html = $this->load->view('sertifikat_per_bagian/cetak', $this->data, true);

            $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
        }
    }

    public function _get_data_profile($id1, $id2)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('users_groups', 'users.id = users_groups.user_id');
        $this->db->where('users.username', $id1);
        $data_user = $this->db->get()->row();
        $user_identity = 'drs' . $data_user->is_parent;

        $this->db->select('users.username, manage_survey.survey_name, is_question, manage_survey.slug, manage_survey.description, manage_survey.is_privacy, manage_survey.table_identity, is_publikasi');
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

    public function ajax_list()
	{
		$klien_induk = $this->db->get_where("pengguna_klien_induk", array('id_user' => $this->session->userdata('user_id')))->row();
		$parent = implode(", ", unserialize($klien_induk->cakupan_induk));

		$list = $this->models->get_datatables($parent);
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $value) {

            $klien_user = $this->db->get_where("users", array('id' => $value->id_user))->row();

			if ($value->is_privacy == 1) {
				$status = '<span class="badge badge-info" width="40%">Public</span>';
			} else {
				$status = '<span class="badge badge-danger" width="40%">Private</span>';
			};

			$no++;
			$row = array();
			$row[] = '
			<a href="' . base_url() . 'e-sertifikat-per-bagian/' . $klien_user->username . '/' . $value->slug . '" title="">
			<div class="card mb-5 shadow" style="background-color: SeaShell;">
				<div class="card-body">
					<div class="row">
						<div class="col sm-10">
							<strong style="font-size: 17px;">' . $value->first_name . ' ' . $value->last_name . '</strong><br>
							<span class="text-dark">Nama Survei : <b>' . $value->survey_name . '</b></span><br>
						</div>
						<div class="col sm-2 text-right">' . $status . '
							<div class="mt-3 text-dark font-weight-bold" style="font-size: 11px;">
								Periode Survei : ' . date('d-m-Y', strtotime($value->survey_start)) . ' s/d ' . date('d-m-Y', strtotime($value->survey_end)) . '
							</div>

						</div>
					</div>
					<!--small class="text-secondary">' . $value->description . '</small><br-->
					
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
}

/* End of file SertifikatIndukPerBagianController.php */
/* Location: ./application/controllers/SertifikatIndukPerBagianController.php */