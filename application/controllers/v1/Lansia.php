<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Lansia extends REST_Controller
{
    
    private $adminX;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Lansia_model", "lansia");
        $this->load->model("Vanggota_model", "vAnggota");
        $this->load->model("Anggota_model", "anggota");
        $this->load->model("Admin_model", "admin");
    }

    public function index_get()
    {
        $page       = $this->input->get("page", TRUE) ?: "1";
        $perPage    = $this->input->get("perpage", TRUE) ?: "10";
        $jenis      = $this->input->get("jenis", TRUE);
        $jenisX     = $this->input->get("jenis_x", TRUE);

        $id_admin   = $this->input->get("id_admin", TRUE);
        $this->adminX      = $this->admin->where(["id" => $id_admin])->get();
        if (!$this->adminX) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Data admin tidak ditemukan",
                "dataTotal"             => (string) 0,
                "page"                  => (string) $page,
                "perPage"               => (string) $perPage,
                "countData"             => (string) 0,
                "data"                  => NULL
            ), REST_Controller::HTTP_OK);
        }


        $model      = $this->lansia;
        if (!empty($jenis)) {
            $model = $this->vAnggota;
        }

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
            if (!empty($jenisX)) {
                for ($i = 0; $i < sizeof($data); $i++) {
                    $data[$i]["anggota"]    = [
                        "jenis"         => $jenisX,
                        "id_lansia"     => $data[$i]["id"],
                        "total"         => $this->anggota->where(["jenis" => $jenisX, "id_lansia" => $data[$i]["id"]])->count_rows() ?: 0
                    ];
                }
            }

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
        $id_lansia  = $this->input->get("id_lansia", TRUE);

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

        if (!empty($search)) {
            $data = $data->where("LOWER(nama)", "LIKE", strtolower($search));
        }

        if (!empty($jenis)) {
            $data = $data->where(["jenis" => $jenis]);
        }

        if (!empty($id_lansia)) {
            $data = $data->where(["id_lansia" => $id_lansia]);
        }

        if ($this->adminX["level"] == "KADER") {
            $data = $data->where(["created_by" => $this->adminX["id"]]);
        }

        if ($this->adminX["level"] == "PUSKESMAS") {
            $data = $data->where(["id_kec" => $this->adminX["id_kec"]]);
        }

        if ($this->adminX["level"] == "DESA") {
            $data = $data->where(["id_kel" => $this->adminX["id_kel"]]);
        }

        return $data;
    }

    public function index_post()
    {
        $nama           = $this->input->post("nama");
        $tanggal_lahir  = $this->input->post("tanggal_lahir");
        $jenis_kelamin  = $this->input->post("jenis_kelamin");
        $id_prov        = $this->input->post("id_prov");
        $id_kab         = $this->input->post("id_kab");
        $id_kec         = $this->input->post("id_kec");
        $id_kel         = $this->input->post("id_kel");
        $alamat_detail  = $this->input->post("alamat_detail");
        $latitude       = $this->input->post("latitude");
        $longitude      = $this->input->post("longitude");
        $created_by     = $this->input->post("created_by");

        $dataInput = [
            "nama"          => $nama,
            "tanggal_lahir" => $tanggal_lahir,
            "jenis_kelamin" => $jenis_kelamin,
            "id_prov"       => $id_prov,
            "id_kab"        => $id_kab,
            "id_kec"        => $id_kec,
            "id_kel"        => $id_kel,
            "alamat_detail" => $alamat_detail,
            "latitude"      => $latitude,
            "longitude"     => $longitude,
            "created_by"    => $created_by,
        ];

        if (empty($nama)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Nama lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($tanggal_lahir)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Tanggal lahir lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($jenis_kelamin)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Jenis Kelamin lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($id_prov)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Provinsi lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($id_kab)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Kabupaten lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($id_kec)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Kecamatan lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($id_kel)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Desa lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($latitude)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Latitude lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($longitude)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Longitude lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        }

        $insert = $this->lansia->insert($dataInput);
        if ($insert) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Berhasil mendaftarkan lansia $nama",
            ), REST_Controller::HTTP_OK);
        } else {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Terjadi kesalahan saat menambahkan data lansia",
            ), REST_Controller::HTTP_OK);
        }
    }

    public function update_post()
    {
        $id             = $this->input->post("id");
        $nama           = $this->input->post("nama");
        $tanggal_lahir  = $this->input->post("tanggal_lahir");
        $jenis_kelamin  = $this->input->post("jenis_kelamin");
        $id_prov        = $this->input->post("id_prov");
        $id_kab         = $this->input->post("id_kab");
        $id_kec         = $this->input->post("id_kec");
        $id_kel         = $this->input->post("id_kel");
        $alamat_detail  = $this->input->post("alamat_detail");
        $latitude       = $this->input->post("latitude");
        $longitude      = $this->input->post("longitude");
        $created_by     = $this->input->post("created_by");

        $dataInput = [
            "nama"          => $nama,
            "tanggal_lahir" => $tanggal_lahir,
            "jenis_kelamin" => $jenis_kelamin,
            "id_prov"       => $id_prov,
            "id_kab"        => $id_kab,
            "id_kec"        => $id_kec,
            "id_kel"        => $id_kel,
            "alamat_detail" => $alamat_detail,
            "latitude"      => $latitude,
            "longitude"     => $longitude,
            "created_by"    => $created_by,
        ];

        if (empty($nama)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Nama lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($tanggal_lahir)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Tanggal lahir lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($jenis_kelamin)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Jenis Kelamin lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($id_prov)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Provinsi lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($id_kab)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Kabupaten lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($id_kec)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Kecamatan lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($id_kel)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Desa lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($latitude)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Latitude lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($longitude)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Longitude lansia tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        }

        $update = $this->lansia->where(["id" => $id])->update($dataInput);
        if ($update) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Berhasil mengubah lansia $nama",
            ), REST_Controller::HTTP_OK);
        } else {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Terjadi kesalahan saat mengubah data lansia",
            ), REST_Controller::HTTP_OK);
        }
    }

    public function delete_post()
    {
        $id             = $this->input->post("id");
        $delete         = $this->lansia->where(["id" => $id])->delete();
        if ($delete) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Berhasil menghapus data lansia",
            ), REST_Controller::HTTP_OK);
        } else {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Terjadi kesalahan saat menghapus data lansia",
            ), REST_Controller::HTTP_OK);
        }
    }
}
