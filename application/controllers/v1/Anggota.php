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
        $this->load->model("Vanggota_model", "vAnggota");
    }

    public function index_get()
    {
        $page       = $this->input->get("page", TRUE)       ?: "1";
        $perPage    = $this->input->get("perpage", TRUE)    ?: "10";        

        $model      = $this->vAnggota;
        $data       = $this->filter($model)
            ->with_prov("fields:nama")
            ->with_kab("fields:nama")
            ->with_kec("fields:nama")
            ->with_kel("fields:nama")
            ->with_admin("fields:nama")            
            ->as_array()
            ->limit($perPage, (($page - 1) * $perPage))
            ->order_by("id", "DESC")
            ->get_all() ?: [];

        $dataTotal = $this->filter($model)->as_array()->count_rows() ?: 0;

        if ($data) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Data berhasil ditemukan",
                "dataTotal"             => (string) $dataTotal,
                "page"                  => (string) $page,
                "perPage"               => (string) $perPage,
                "countData"             => (string) sizeof($data),
                "data"                  => $data
            ), REST_Controller::HTTP_OK);
        } else {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Data tidak ditemukan",
                "dataTotal"             => (string) $dataTotal,
                "page"                  => (string) $page,
                "perPage"               => (string) $perPage,
                "countData"             => (string) sizeof($data),
                "data"                  => $data
            ), REST_Controller::HTTP_OK);
        }
    }

    public function filter($model = null)
    {

        $id_prov    = $this->input->get("id_prov", TRUE);
        $id_kab     = $this->input->get("id_kab", TRUE);
        $id_kec     = $this->input->get("id_kec", TRUE);
        $id_kel     = $this->input->get("id_kel", TRUE);
        $search     = $this->input->get("search", TRUE);
        $jenis      = $this->input->get("jenis", TRUE);

        $data       = $model;

        if (!empty($id_prov)) {
            $data = $data->where(["id_prov" => $id_prov]);
        }

        if (!empty($id_kab)) {
            $data = $data->where(["id_kab" => $id_kab]);
        }

        if (!empty($id_kec)) {
            $data = $data->where(["id_kec" => $id_kec]);
        }

        if (!empty($id_kel)) {
            $data = $data->where(["id_kel" => $id_kel]);
        }

        if (!empty($jenis)) {
            $data = $data->where(["jenis" => $jenis]);
        }

        if (!empty($search)) {
            $data = $data->where("LOWER(nama)", "LIKE", strtolower($search));
            // $data = $data->where("LOWER(nama_lansia)", "LIKE", strtolower($search), TRUE);
        }

        return $data;
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
        } else if (empty($jenis)) {
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
