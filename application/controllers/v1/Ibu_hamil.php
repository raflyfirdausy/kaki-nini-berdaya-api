<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Ibu_hamil extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->title = "Ibu Hamil";
        $this->load->model("Vibu_hamil_model", "vIbuHamil");
        $this->load->model("Tr_ibu_hamil_model", "trIbuHamil");
    }

    public function index_get()
    {
        $page       = $this->input->get("page", TRUE) ?: "1";
        $perPage    = $this->input->get("perpage", TRUE) ?: "10";

        $model      = $this->vIbuHamil;
        $data       = $this->filter($model)
            ->with_prov("fields:nama")
            ->with_kab("fields:nama")
            ->with_kec("fields:nama")
            ->with_kel("fields:nama")
            ->with_admin("fields:nama")
            ->as_array()
            ->limit($perPage, (($page - 1) * $perPage))
            ->order_by("DATE(tgl_sortir)", "DESC")
            ->get_all() ?: [];

        $dataTotal = $this->filter($model)->as_array()->count_rows() ?: 0;
        if ($data) {

            for($i = 0; $i < sizeof($data); $i++) {
                $data[$i]["bulan_tampil"]   = bulan($data[$i]["bulan"]) . " " . $data[$i]["tahun"];
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
        $id_anggota = $this->input->get("id_anggota", TRUE);
        $id_admin   = $this->input->get("id_admin", TRUE);

        $data       = $model;

        if (!empty($id_anggota)) {
            $data = $data->where(["id_anggota" => $id_anggota]);
        }

        if (!empty($id_prov)) {
            $data = $data->where(["id_prov" => $id_prov]);
        }

        if (!empty($id_kab)) {
            $data = $data->where(["id_kab" => $id_prov]);
        }

        if (!empty($id_kec)) {
            $data = $data->where(["id_kec" => $id_prov]);
        }

        if (!empty($id_kel)) {
            $data = $data->where(["id_kel" => $id_prov]);
        }

        if (!empty($search)) {
            $data = $data->where("LOWER(nama_lansia)", "LIKE", strtolower($search));
            // $data = $data->where("LOWER(nama_anggota)", "LIKE", strtolower($search));
        }

        return $data;
    }

    public function index_post(){
        $id_lansia      = $this->input->post("id_lansia");
        $id_anggota     = $this->input->post("id_anggota");
        $usia_kehamilan = $this->input->post("usia_kehamilan");
        $kunjungan      = $this->input->post("kunjungan");

        $bulan          = $this->input->post("bulan") ? $this->input->post("bulan") + 1 : null;
        $tahun          = $this->input->post("tahun");
        $id_admin       = $this->input->post("id_admin");

        $isForce        = $this->input->post("is_force");
        $isEdit         = $this->input->post("is_edit") ?: "TIDAK";
        $id_edit        = $this->input->post("id_edit");

        //TODO : CEK 
        if (empty($id_admin)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Admin tidak diketahui",
                "data"                  => NULL
            ), REST_Controller::HTTP_OK);
        }

        if (empty($id_lansia)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Lansia tidak diketahui",
                "data"                  => NULL
            ), REST_Controller::HTTP_OK);
        }

        if (empty($bulan) || empty($tahun)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Data bulan belum diisi",
                "data"                  => NULL
            ), REST_Controller::HTTP_OK);
        }

        if (empty($id_anggota)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Anggota tidak diketahui",
                "data"                  => NULL
            ), REST_Controller::HTTP_OK);
        }

        if (empty($usia_kehamilan)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Usia kehamilan tidak diketahui",
                "data"                  => NULL
            ), REST_Controller::HTTP_OK);
        }

        if (empty($kunjungan)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Kunjungan kehamilan tidak diketahui",
                "data"                  => NULL
            ), REST_Controller::HTTP_OK);
        }

        if (empty($isForce)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Terjadi kesalahan : Force not found",
                "data"                  => NULL
            ), REST_Controller::HTTP_OK);
        }

        $cekInput = $this->vIbuHamil->where([
            "id_lansia"     => $id_lansia,
            "id_anggota"    => $id_anggota,
            "bulan"         => $bulan,
            "tahun"         => $tahun,
        ])->get();

        $dataInput = [
            "id_lansia"     => $id_lansia,
            "id_anggota"    => $id_anggota,
            "usia_kehamilan"=> $usia_kehamilan,
            "kunjungan"     => $kunjungan,
            "bulan"         => $bulan,
            "tahun"         => $tahun,
            "created_by"    => $id_admin
        ];

        if ($isEdit == "TIDAK") {
            if ($cekInput) {
                if ($isForce == "TIDAK") {
                    return $this->response(array(
                        "status"                => true,
                        "response_code"         => REST_Controller::HTTP_CONTINUE,
                        "response_message"      => "Data pada bulan tersebut sudah di inputkan, apakah akan digantikan dengan data yang baru ?",
                        "data"                  => NULL
                    ), REST_Controller::HTTP_OK);
                } else {
                    $update = $this->trIbuHamil->where(["id" => $cekInput["id"]])->update($dataInput);
                    if ($update) {
                        return $this->response(array(
                            "status"                => true,
                            "response_code"         => REST_Controller::HTTP_OK,
                            "response_message"      => "Data $this->title berhasil di perbaharui",
                            "data"                  => NULL
                        ), REST_Controller::HTTP_OK);
                    } else {
                        return $this->response(array(
                            "status"                => true,
                            "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                            "response_message"      => "Terjadi kesalahan saat memperbaharui data $this->title",
                            "data"                  => NULL
                        ), REST_Controller::HTTP_OK);
                    }
                }
            }
            $insert = $this->trIbuHamil->insert($dataInput);
            if ($insert) {
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_OK,
                    "response_message"      => "Data $this->title berhasil di tambahkan",
                    "data"                  => NULL
                ), REST_Controller::HTTP_OK);
            } else {
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                    "response_message"      => "Terjadi kesalahan saat menambahkan data $this->title",
                    "data"                  => NULL
                ), REST_Controller::HTTP_OK);
            }
        } else {
            $cekInputUpdate = $this->trIbuHamil->where([
                "id"        => $id_edit,
            ])->get();
            if ($cekInputUpdate) {
                $cekInputX = $this->trIbuHamil->where([
                    "id"        => $id_edit,
                    "bulan"     => $bulan,
                    "tahun"     => $tahun,
                ])->get();
                if ($cekInputX) {
                    $update = $this->trIbuHamil->where(["id" => $cekInputUpdate["id"]])->update($dataInput);
                    if ($update) {
                        return $this->response(array(
                            "status"                => true,
                            "response_code"         => REST_Controller::HTTP_OK,
                            "response_message"      => "Data $this->title berhasil di perbaharui",
                            "data"                  => NULL
                        ), REST_Controller::HTTP_OK);
                    } else {
                        return $this->response(array(
                            "status"                => true,
                            "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                            "response_message"      => "Terjadi kesalahan saat memperbaharui data $this->title",
                            "data"                  => NULL
                        ), REST_Controller::HTTP_OK);
                    }
                } else {
                    return $this->response(array(
                        "status"                => true,
                        "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                        "response_message"      => "Terjadi kesahalan : Tidak dapat merubah data bulan atau tahun jika melakukan edit data",
                        "data"                  => NULL
                    ), REST_Controller::HTTP_OK);
                }
            } else {
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                    "response_message"      => "Terjadi kesalahan : Data tidak ditemukan",
                    "data"                  => NULL
                ), REST_Controller::HTTP_OK);
            }
        }
    }

    public function delete_post()
    {
        $id             = $this->input->post("id");
        $delete         = $this->trIbuHamil->where(["id" => $id])->delete();

        if ($delete) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Berhasil menghapus data $this->title",
            ), REST_Controller::HTTP_OK);
        } else {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Terjadi kesalahan saat menghapus data $this->title",
            ), REST_Controller::HTTP_OK);
        }
    }
}
