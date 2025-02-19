<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapSaran_model extends CI_Model
{

    var $table          = '';
    var $column_order   = array(null, null, null, null, null, null, null, null, null);
    var $column_search  = array('nama_lengkap');
    var $order          = array('id_responden' => 'asc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query($table_identity)
    {

        $this->db->select("*");
        $this->db->from("survey_$table_identity");
        $this->db->join("responden_$table_identity", "survey_$table_identity.id_responden = responden_$table_identity.id");
        $this->db->where('is_submit', 1);
        $this->db->where('saran != ""');

        if($this->uri->segment(3) == 'rekap-saran-online'){
            $this->db->where('id_surveyor', 0);
        }

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

    function get_datatables($table_identity)
    {
        $this->_get_datatables_query($table_identity);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($table_identity)
    {
        $this->_get_datatables_query($table_identity);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($table_identity)
    {
        $this->db->from("survey_$table_identity");
        $this->db->join("responden_$table_identity", "survey_$table_identity.id_responden = responden_$table_identity.id");
        $this->db->where('is_submit', 1);
        $this->db->where('saran != ""');
        return $this->db->count_all_results();
    }
}