<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Kesehatan_lansia extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Lansia_model", "lansia");
        $this->load->model("Vanggota_model", "vAnggota");
        $this->load->model("Anggota_model", "anggota");
        $this->load->model("Tr_kesehatan_lansia_model", "trKesehatanLansia");
        $this->load->model("Vkesehatan_lansia_model", "vKesLansia");
    }

    public function index_get()
    {
        $page       = $this->input->get("page", TRUE) ?: "1";
        $perPage    = $this->input->get("perpage", TRUE) ?: "10";

        $model      = $this->vKesLansia;
        $data       = $this->filter($model)
            ->with_admin("fields:nama")
            ->as_array()
            ->limit($perPage, (($page - 1) * $perPage))
            ->order_by("DATE(tgl_sortir)", "DESC")
            ->get_all() ?: [];

        $dataTotal = $this->filter($model)->as_array()->count_rows() ?: 0;

        if ($data) {
            for ($i = 0; $i < sizeof($data); $i++) {
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
        $bulan      = $this->input->get("bulan", TRUE);
        $tahun      = $this->input->get("tahun", TRUE);
        $nama       = $this->input->get("nama", TRUE);

        $id_admin   = $this->input->get("id_admin", TRUE);
        $id_lansia  = $this->input->get("id_lansia", TRUE);

        $data       = $model;

        if (!empty($id_lansia)) {
            $data = $data->where(["id_lansia" => $id_lansia]);
        }

        if (!empty($bulan)) {
            $data = $data->where(["bulan" => ($bulan + 1)]);
        }

        if (!empty($tahun)) {
            $data = $data->where(["tahun" => $tahun]);
        }

        if (!empty($nama)) {
            $data = $data->where("LOWER(nama)", "LIKE", strtolower($nama));
        }

        return $data;
    }

    public function index_post()
    {
        $id_lansia      = $this->input->post("id_lansia");
        $kunjungan      = $this->input->post("kunjungan");
        $gula_darah     = $this->input->post("gula_darah");
        $sistole        = $this->input->post("sistole");
        $diastole       = $this->input->post("diastole");
        $merokok        = $this->input->post("merokok");
        $dm             = $this->input->post("dm");
        $hipertensi     = $this->input->post("hipertensi");
        $jantung        = $this->input->post("jantung");
        $asam_urat      = $this->input->post("asam_urat");

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

        if (empty($kunjungan)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Data kunjungan belum diisi",
                "data"                  => NULL
            ), REST_Controller::HTTP_OK);
        }

        if (empty($merokok)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Data Merokok belum diisi",
                "data"                  => NULL
            ), REST_Controller::HTTP_OK);
        }

        if (empty($dm)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Data DM belum diisi",
                "data"                  => NULL
            ), REST_Controller::HTTP_OK);
        }

        if (empty($hipertensi)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Data hipertensi belum diisi",
                "data"                  => NULL
            ), REST_Controller::HTTP_OK);
        }

        if (empty($jantung)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Data penyakit jantung belum diisi",
                "data"                  => NULL
            ), REST_Controller::HTTP_OK);
        }

        if (empty($asam_urat)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Data penyakit asam urat belum diisi",
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

        $cekInput = $this->trKesehatanLansia->where([
            "id_lansia" => $id_lansia,
            "bulan"     => $bulan,
            "tahun"     => $tahun,
        ])->get();

        $dataInput = [
            "id_lansia"     => $id_lansia,
            "kunjungan"     => $kunjungan,
            "gula_darah"    => $gula_darah,
            "sistole"       => $sistole,
            "diastole"      => $diastole,
            "merokok"       => $merokok,
            "dm"            => $dm,
            "hipertensi"    => $hipertensi,
            "jantung"       => $jantung,
            "asam_urat"     => $asam_urat,
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
                    $update = $this->trKesehatanLansia->where(["id" => $cekInput["id"]])->update($dataInput);
                    if ($update) {
                        return $this->response(array(
                            "status"                => true,
                            "response_code"         => REST_Controller::HTTP_OK,
                            "response_message"      => "Data Kesehatan lansia berhasil di perbaharui",
                            "data"                  => NULL
                        ), REST_Controller::HTTP_OK);
                    } else {
                        return $this->response(array(
                            "status"                => true,
                            "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                            "response_message"      => "Terjadi kesalahan saat memperbaharui data kesehatan lansia",
                            "data"                  => NULL
                        ), REST_Controller::HTTP_OK);
                    }
                }
            }

            $insert = $this->trKesehatanLansia->insert($dataInput);
            if ($insert) {
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_OK,
                    "response_message"      => "Data Kesehatan lansia berhasil di tambahkan",
                    "data"                  => NULL
                ), REST_Controller::HTTP_OK);
            } else {
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                    "response_message"      => "Terjadi kesalahan saat menambahkan data kesehatan lansia",
                    "data"                  => NULL
                ), REST_Controller::HTTP_OK);
            }
        } else {
            $cekInputUpdate = $this->trKesehatanLansia->where([
                "id"        => $id_edit,
            ])->get();
            if ($cekInputUpdate) {
                $cekInputX = $this->trKesehatanLansia->where([
                    "id"        => $id_edit,
                    "bulan"     => $bulan,
                    "tahun"     => $tahun,
                ])->get();
                if ($cekInputX) {
                    //TODO : UPDATE
                    $update = $this->trKesehatanLansia->where(["id" => $cekInputUpdate["id"]])->update($dataInput);
                    if ($update) {
                        return $this->response(array(
                            "status"                => true,
                            "response_code"         => REST_Controller::HTTP_OK,
                            "response_message"      => "Data Kesehatan lansia berhasil di perbaharui",
                            "data"                  => NULL
                        ), REST_Controller::HTTP_OK);
                    } else {
                        return $this->response(array(
                            "status"                => true,
                            "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                            "response_message"      => "Terjadi kesalahan saat memperbaharui data kesehatan lansia",
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
        $delete         = $this->trKesehatanLansia->where(["id" => $id])->delete();

        if ($delete) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Berhasil menghapus data kesehatan lansia",
            ), REST_Controller::HTTP_OK);
        } else {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Terjadi kesalahan saat menghapus data kesehatan lansia",
            ), REST_Controller::HTTP_OK);
        }
    }
}
