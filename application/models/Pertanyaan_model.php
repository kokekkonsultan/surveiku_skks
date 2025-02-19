<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pertanyaan_model extends CI_Model
{
    var $table             = '';
    var $column_order     = array(null, null, null, null, null);
    var $column_search     = array('isi_pertanyaan');
    var $order             = array('id_unsur' => 'asc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select("*, pertanyaan_unsur.id AS id_pertanyaan_unsur,
        (SELECT nama_jawaban FROM nilai_unsur_pelayanan WHERE id_pertanyaan_unsur = pertanyaan_unsur.id && nilai_jawaban = 1) AS pilihan_1,
        (SELECT nama_jawaban FROM nilai_unsur_pelayanan WHERE id_pertanyaan_unsur = pertanyaan_unsur.id && nilai_jawaban = 2) AS pilihan_2,
        (SELECT nama_jawaban FROM nilai_unsur_pelayanan WHERE id_pertanyaan_unsur = pertanyaan_unsur.id && nilai_jawaban = 3) AS pilihan_3,
        (SELECT nama_jawaban FROM nilai_unsur_pelayanan WHERE id_pertanyaan_unsur = pertanyaan_unsur.id && nilai_jawaban = 4) AS pilihan_4,
        (SELECT nama_jawaban FROM nilai_unsur_pelayanan WHERE id_pertanyaan_unsur = pertanyaan_unsur.id && nilai_jawaban = 5) AS pilihan_5, (SELECT kode_dimensi FROM dimensi WHERE id_dimensi = dimensi.id) AS kode_dimensi,
        (SELECT nama_dimensi FROM dimensi WHERE id_dimensi = dimensi.id) AS nama_dimensi");

        $this->db->from("pertanyaan_unsur");
        $this->db->join("unsur", "pertanyaan_unsur.id_unsur = unsur.id");

        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from("pertanyaan_unsur");
        $this->db->join("unsur", "pertanyaan_unsur.id_unsur = unsur.id");
        return $this->db->count_all_results();
    }
}