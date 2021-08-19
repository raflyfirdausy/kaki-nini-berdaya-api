<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Anggota extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Anggota_model", "anggota");
    }

    public function index_post()
    {
        $id_lansia  = $this->input->post("id_lansia");
        $jenis      = $this->input->post("jenis");
        $nama       = $this->input->post("nama");
        $created_by = $this->input->post("created_by");

        if (empty($nama)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Nama anggota tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if(empty($jenis)){
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Jenis anggota tidak diketahui",
            ), REST_Controller::HTTP_OK);
        }


        $insert     = $this->anggota->insert([
            "id_lansia"     => $id_lansia,
            "jenis"         => $jenis,
            "nama"          => $nama,
            "created_by"    => $created_by,
        ]);
        if ($insert) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Berhasil mendaftarkan $nama",
            ), REST_Controller::HTTP_OK);
        } else {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Terjadi kesalahan saat menambahkan data anggota",
            ), REST_Controller::HTTP_OK);
        }
    }

    public function delete_post()
    {
        $id             = $this->input->post("id");
        $delete         = $this->anggota->where(["id" => $id])->delete();

        if ($delete) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Berhasil menghapus data anggota",
            ), REST_Controller::HTTP_OK);
        } else {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Terjadi kesalahan saat menghapus data anggota",
            ), REST_Controller::HTTP_OK);
        }
    }

    public function update_post()
    {
        $id         = $this->input->post("id");
        $nama       = $this->input->post("nama");

        if (empty($nama)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Nama anggota tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        }

        $update = $this->anggota->where(["id" => $id])->update(["nama" => $nama]);
        if ($update) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Berhasil mengubah anggota $nama",
            ), REST_Controller::HTTP_OK);
        } else {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Terjadi kesalahan saat mengubah data anggota",
            ), REST_Controller::HTTP_OK);
        }
    }
}
