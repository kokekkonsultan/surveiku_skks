<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Carbon\Carbon;

class Client_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function check_subscription()
    {
        $this->db->select('*, berlangganan.id AS id_berlangganan');
        $this->db->from('berlangganan');
        $this->db->join('users', 'users.id = berlangganan.id_user');
        $this->db->join('paket', 'paket.id = berlangganan.id_paket');
        $this->db->join('status_berlangganan', 'status_berlangganan.id = berlangganan.id_status_berlangganan');
        $this->db->join('metode_pembayaran', 'metode_pembayaran.id = berlangganan.id_metode_pembayaran');
        $this->db->where('berlangganan.id_user', $_SESSION['user_id']);
        $this->db->order_by('berlangganan.id', 'asc');
        $get_data = $this->db->get();

        $last_payment = $get_data->last_row();

        $tanggal_mulai = $last_payment->tanggal_mulai;
        $tanggal_selesai = $last_payment->tanggal_selesai;

        $now = Carbon::now();
        $start_date = Carbon::parse($tanggal_mulai);
        $end_date = Carbon::parse($tanggal_selesai);
        $due_date = $now->diffInDays($end_date); // Tanggal jatuh tempo

        if ($now->between($start_date, $end_date)) {
            // return 'Paket berakhir dalam '.$due_date.' hari lagi';
            return TRUE;
        } else {
            // return 'Packet is Expired';

            return FALSE;
        }
    }

    public function last_subscribe()
    {
        // $this->data = [];

        $this->db->select('*, berlangganan.id AS id_berlangganan, berlangganan.uuid AS uuid_berlangganan');
        $this->db->from('berlangganan');
        $this->db->join('users', 'users.id = berlangganan.id_user');
        $this->db->join('paket', 'paket.id = berlangganan.id_paket');
        $this->db->join('status_berlangganan', 'status_berlangganan.id = berlangganan.id_status_berlangganan');
        $this->db->join('metode_pembayaran', 'metode_pembayaran.id = berlangganan.id_metode_pembayaran');
        $this->db->where('berlangganan.id_user', $_SESSION['user_id']);
        $this->db->order_by('berlangganan.id', 'asc');
        $get_data = $this->db->get();

        $last_payment = $get_data->last_row();
        // $this->data['last_payment'] = $last_payment;

        $this->data['nama_paket'] = $last_payment->nama_paket;
        $this->data['deskripsi_paket'] = $last_payment->deskripsi_paket;
        $this->data['panjang_hari'] = $last_payment->panjang_hari;
        $this->data['harga_paket'] = $last_payment->harga_paket;
        $this->data['jumlah_user'] = $last_payment->jumlah_user;
        $this->data['jumlah_kuesioner'] = $last_payment->jumlah_kuesioner;
        $this->data['is_active'] = $last_payment->is_active;

        $this->data['tanggal_mulai'] = $last_payment->tanggal_mulai;
        $this->data['tanggal_selesai'] = $last_payment->tanggal_selesai;

        return $this->data;
    }

    public function all_subscribe()
    {
        // $this->data = [];

        $this->db->select('*, berlangganan.id AS id_berlangganan, berlangganan.uuid AS uuid_berlangganan');
        $this->db->from('berlangganan');
        $this->db->join('users', 'users.id = berlangganan.id_user');
        $this->db->join('paket', 'paket.id = berlangganan.id_paket');
        $this->db->join('status_berlangganan', 'status_berlangganan.id = berlangganan.id_status_berlangganan');
        $this->db->join('metode_pembayaran', 'metode_pembayaran.id = berlangganan.id_metode_pembayaran');
        $this->db->where('berlangganan.id_user', $_SESSION['user_id']);
        $this->db->order_by('berlangganan.id', 'asc');
        $get_data = $this->db->get();

        $this->data['all_payment'] = $get_data->result();


        return $this->data;
    }

    public function table_identity_check($uuid)
    {
        $this->db->select('table_identity');
        $this->db->from('manage_survey');
        $this->db->where('uuid', $uuid);
        $get = $this->db->get()->row()->table_identity;

        return $get;
    }


    public function check_jumlah_kuesioner($username, $uuid_berlangganan)
    {
        $this->db->select('berlangganan.uuid AS uuid_berlangganan, id_paket');
        $this->db->from('berlangganan');
        $this->db->join('users', 'users.id = berlangganan.id_user');
        $this->db->where('users.username', $username);
        $this->db->where('berlangganan.uuid', $uuid_berlangganan);
        $berlangganan = $this->db->get()->row();

        // cek paket jumlah kuota kuesioner
        $id_paket = $berlangganan->id_paket;
        $this->db->select('jumlah_kuesioner');
        $this->db->from('paket');
        $this->db->where('id', $id_paket);
        $jumlah_kuesioner_paket = $this->db->get()->row()->jumlah_kuesioner;

        // cek jumlah kuota kuesioner yang dipakai
        $this->db->select('manage_survey.id');
        $this->db->from('berlangganan');
        $this->db->join('manage_survey', 'manage_survey.id_berlangganan = berlangganan.id');
        $this->db->where('berlangganan.uuid', $uuid_berlangganan);
        $this->db->where('berlangganan.id_paket', $id_paket);
        $jumlah_kuesioner_dibuat = $this->db->get()->num_rows();

        $pemakaian  = $jumlah_kuesioner_paket - $jumlah_kuesioner_dibuat;

        if ($pemakaian == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}

/* End of file Client_Controller.php */
/* Location: ./application/core/Client_Controller.php */