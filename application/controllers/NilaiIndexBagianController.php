<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'application/core/Klien_Controller.php';

use application\core\Klien_Controller;

class NilaiIndexBagianController extends CI_Controller
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
    }

    public function index()
    {
        $this->data = [];
        $this->data['title'] = 'Nilai Indeks Bagian';

        return view('nilai_index_bagian/index', $this->data);
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

            $no++;
            $row = array();
            $div = 'q' . $no;
            //
            $row[] = '
			<a href="' . base_url() . 'nilai-index-bagian/' . $value->slug . '" title="">
			<div class="card mb-5 shadow" style="background-color: SeaShell;">
				<div class="card-body">
					<div class="row">
						<div class="col sm-12">
							<strong style="font-size: 17px;">' . $value->first_name . ' ' . $value->last_name . '</strong><br>
							<span class="text-dark">Nama Survei : <b>' . $value->survey_name . '</b></span><br>
						</div>
						<div class="col sm-2 text-right">
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


    public function detail($id1)
    {
        $this->data = [];
        $this->data['title'] = 'Nilai Per Sektor';

        $get_identity = $this->db->get_where('manage_survey', ['slug' => $id1])->row();
        $this->data['table_identity'] = $get_identity->table_identity;
        $this->data['users'] = $this->db->get_where("users", ['id' => $get_identity->id_user])->row();
        $this->data['nama_survey'] = $get_identity->survey_name;

        return view('nilai_index_bagian/detail', $this->data);
    }

}

/* End of file NilaiIndexBagianController.php */
/* Location: ./application/controllers/NilaiIndexBagianController.php */
