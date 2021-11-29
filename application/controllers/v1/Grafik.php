<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Grafik extends REST_Controller
{
    private $adminX;
    public function __construct()
    {
        parent::__construct();
        $this->minSarapan = 5;
        $this->load->model("Vwilayah_lansia_model", "vWilayahLansia");
        $this->load->model("Admin_model", "admin");
        $this->load->model("Tr_peranan_lansia_model", "trPeranan");
        $this->load->model("Lansia_model", "lansia");
        $this->load->model("Vkesehatan_lansia_model", "vKesLansia");
        $this->load->model("Vremaja_model", "vRemaja");
        $this->load->model("Vbayi_balita_model", "vBayiBalita");
    }

    public function peta_get()
    {
        $cilacap    = "3301";
        $banyumas   = "3302";

        $id_kab     = $this->input->get("id_kab");
        $kondisi = [];
        if (!empty($id_kab)) {
            $kondisi["id_kab"] = $id_kab;
        }

        $data = $this->lansia
            ->fields(["id", "nama", "latitude", "longitude", "id_prov", "id_kab", "id_kec", "id_kel"])
            ->where($kondisi)
            ->get_all();

        return $this->response(array(
            "status"                => true,
            "response_code"         => REST_Controller::HTTP_OK,
            "response_message"      => "Data ditemukan",
            "data"                  => $data
        ), REST_Controller::HTTP_OK);
    }

    public function peta_new_get()
    {
        $this->load->model("Vlansia_berdaya_model", "vBerdaya");
        $this->load->model("Vlansia_tidak_berdaya_model", "vTidakBerdaya");

        $id_kab     = $this->input->get("id_kab");
        $tahun      = $this->input->get("tahun") ?: date("Y");
        $bulan      = $this->input->get("bulan") ?: (int) date("m");

        $kondisi["tahun"] = $tahun;
        $kondisi["bulan"] = $bulan;
        if (!empty($id_kab)) {
            $kondisi["id_kab"] = $id_kab;
        }

        $result     = [];

        $berdaya    = $this->vBerdaya
            ->fields(["nama", "latitude", "longitude"])
            ->where($kondisi)
            ->get_all();
        if ($berdaya) {
            for ($i = 0; $i < sizeof($berdaya); $i++) {
                $berdaya[$i]["keterangan"] = "Lansia Berdaya";
                $berdaya[$i]["is_berdaya"] = "YA";
                array_push($result, $berdaya[$i]);
            }
        }

        $tidakBerdaya    = $this->vTidakBerdaya
            ->fields(["nama", "latitude", "longitude"])
            ->where($kondisi)
            ->get_all();

        if ($tidakBerdaya) {
            for ($i = 0; $i < sizeof($tidakBerdaya); $i++) {
                $tidakBerdaya[$i]["keterangan"] = "Lansia Kurang Berdaya";
                $tidakBerdaya[$i]["is_berdaya"] = "TIDAK";
                array_push($result, $tidakBerdaya[$i]);
            }
        }

        return $this->response(array(
            "status"                => true,
            "response_code"         => REST_Controller::HTTP_OK,
            "response_message"      => "Data ditemukan",
            "data"                  => [
                "waktu"         => [
                    "tahun"     => $tahun,
                    "bulan"     => $bulan
                ],
                "result"        => $result
            ]
        ), REST_Controller::HTTP_OK);
    }

    public function desa_get()
    {

        $cilacap    = "3301";
        $banyumas   = "3302";

        $tahun      = $this->input->get("tahun") ?: date("Y");
        $bulan      = $this->input->get("bulan") ?: (int) date("m");
        $id_kab     = $this->input->get("id_kab");


        $wilayahLansia = $this->lansia
            ->fields()
            ->select('DISTINCT id_prov,id_kab,id_kec,id_kel', FALSE)
            ->where("id_kab", "=", $id_kab)
            ->with_prov("fields:nama")
            ->with_kab("fields:nama")
            ->with_kec("fields:nama")
            ->with_kel("fields:nama")
            ->order_by("id_prov", "ASC")
            ->order_by("id_kab", "ASC")
            ->order_by("id_kec", "ASC")
            ->order_by("id_kel", "ASC")
            ->get_all() ?: [];

        $result["waktu"] = [
            "tahun"         => $tahun,
            "bulan"         => $bulan,
        ];
        $result["detail"] = [];

        for ($i = 0; $i < sizeof($wilayahLansia); $i++) {
            $kondisi["id_kel"]  = $wilayahLansia[$i]["id_kel"];

            $kondisiX           = $kondisi;
            $kondisiX["tahun"]  = $tahun;
            $kondisiX["bulan"]  = $bulan;

            $lansiaBerdaya = $this->db
                ->select(["COUNT(*) as total"])
                ->where($kondisiX)
                ->get("v_lansia_berdaya")
                ->row_array()["total"];

            $lansiaTidakBerdaya = $this->db
                ->select(["COUNT(*) as total"])
                ->where($kondisiX)
                ->get("v_lansia_tidak_berdaya")
                ->row_array()["total"];

            $totalLansia = $this->lansia->where($kondisi)->count_rows();

            $data_tmp = [
                "wilayah"   => [
                    "prov"  => $wilayahLansia[$i]["prov"],
                    "kab"   => $wilayahLansia[$i]["kab"],
                    "kec"   => $wilayahLansia[$i]["kec"],
                    "kel"   => $wilayahLansia[$i]["kel"],
                ],
                "lansia"    => [
                    "berdaya"           => (int) $lansiaBerdaya,
                    "tidak_berdaya"     => (int) $lansiaTidakBerdaya,
                    "total"             => (int) $totalLansia,
                    "persentase"        => (float) number_format(($lansiaBerdaya / $totalLansia * 100), 2)
                ],
            ];

            array_push($result["detail"], $data_tmp);
        }

        return $this->response(array(
            "status"                => true,
            "response_code"         => REST_Controller::HTTP_OK,
            "response_message"      => "Data ditemukan",
            "data"                  => $result
        ), REST_Controller::HTTP_OK);
    }

    public function kunjungan_get()
    {
        $cilacap    = "3301";
        $banyumas   = "3302";

        $tahun      = $this->input->get("tahun") ?: date("Y");
        $bulan      = $this->input->get("bulan") ?: (int) date("m");
        $id_kab     = $this->input->get("id_kab");


        $wilayahLansia = $this->lansia
            ->fields()
            ->as_array()
            ->select('DISTINCT id_prov,id_kab,id_kec,id_kel', FALSE)
            ->where("id_kab", "=", $id_kab)
            ->with_prov("fields:nama")
            ->with_kab("fields:nama")
            ->with_kec("fields:nama")
            ->with_kel("fields:nama")
            ->order_by("id_prov", "ASC")
            ->order_by("id_kab", "ASC")
            ->order_by("id_kec", "ASC")
            ->order_by("id_kel", "ASC")
            ->get_all() ?: [];

        $result["waktu"] = [
            "tahun"         => $tahun,
            "bulan"         => $bulan,
        ];
        $result["detail"] = [];

        for ($i = 0; $i < sizeof($wilayahLansia); $i++) {
            $kondisi["id_kel"]  = $wilayahLansia[$i]["id_kel"];

            $kondisiX           = $kondisi;
            $kondisiX["tahun"]  = $tahun;
            $kondisiX["bulan"]  = $bulan;

            $kondisiYa      = $kondisiX;
            $kondisiTidak   = $kondisiX;

            $kondisiYa["kunjungan"]     = "YA";
            $kondisiTidak["kunjungan"]  = "TIDAK";


            $kunjungan_ya = $this->vKesLansia
                ->where($kondisiYa)
                ->as_array()
                ->count_rows();

            $kunjungan_tidak = $this->vKesLansia
                ->where($kondisiTidak)
                ->as_array()
                ->count_rows();

            $data_tmp = [
                "wilayah"   => [
                    "prov"  => $wilayahLansia[$i]["prov"],
                    "kab"   => $wilayahLansia[$i]["kab"],
                    "kec"   => $wilayahLansia[$i]["kec"],
                    "kel"   => $wilayahLansia[$i]["kel"],
                ],
                "kunjungan"    => [
                    "ya"      => $kunjungan_ya,
                    "tidak"   => $kunjungan_tidak
                ],
            ];

            array_push($result["detail"], $data_tmp);
        }

        return $this->response(array(
            "status"                => true,
            "response_code"         => REST_Controller::HTTP_OK,
            "response_message"      => "Data ditemukan",
            "data"                  => $result
        ), REST_Controller::HTTP_OK);
    }

    public function penyakit_get()
    {
        $cilacap    = "3301";
        $banyumas   = "3302";

        $tahun      = $this->input->get("tahun") ?: date("Y");
        $bulan      = $this->input->get("bulan") ?: (int) date("m");
        $id_kab     = $this->input->get("id_kab");


        $wilayahLansia = $this->lansia
            ->fields()
            ->as_array()
            ->select('DISTINCT id_prov,id_kab,id_kec,id_kel', FALSE)
            ->where("id_kab", "=", $id_kab)
            ->with_prov("fields:nama")
            ->with_kab("fields:nama")
            ->with_kec("fields:nama")
            ->with_kel("fields:nama")
            ->order_by("id_prov", "ASC")
            ->order_by("id_kab", "ASC")
            ->order_by("id_kec", "ASC")
            ->order_by("id_kel", "ASC")
            ->get_all() ?: [];

        $result["waktu"] = [
            "tahun"         => $tahun,
            "bulan"         => $bulan,
        ];
        $result["detail"] = [];


        for ($i = 0; $i < sizeof($wilayahLansia); $i++) {
            $kondisi["id_kel"]  = $wilayahLansia[$i]["id_kel"];

            $kondisiX           = $kondisi;
            $kondisiX["tahun"]  = $tahun;
            $kondisiX["bulan"]  = $bulan;

            $kondisiYa      = $kondisiX;
            $kondisiTidak   = $kondisiX;

            $kondisiTidak["dm"]             = "TIDAK";
            $kondisiTidak["hipertensi"]     = "TIDAK";
            $kondisiTidak["jantung"]        = "TIDAK";
            $kondisiTidak["asam_urat"]      = "TIDAK";

            $semua = $this->vKesLansia
                ->where($kondisiX)
                ->as_array()
                ->count_rows();

            $tidak = $this->vKesLansia
                ->where($kondisiTidak)
                ->as_array()
                ->count_rows();

            $ya = $semua - $tidak;

            $data_tmp = [
                "wilayah"   => [
                    "prov"  => $wilayahLansia[$i]["prov"],
                    "kab"   => $wilayahLansia[$i]["kab"],
                    "kec"   => $wilayahLansia[$i]["kec"],
                    "kel"   => $wilayahLansia[$i]["kel"],
                ],
                "keterangan"    => [
                    "semua"   => $semua,
                    "ya"      => $ya,
                    "tidak"   => $tidak
                ],
            ];

            array_push($result["detail"], $data_tmp);
        }

        return $this->response(array(
            "status"                => true,
            "response_code"         => REST_Controller::HTTP_OK,
            "response_message"      => "Data ditemukan",
            "data"                  => $result
        ), REST_Controller::HTTP_OK);
    }

    public function merokok_get()
    {
        $cilacap    = "3301";
        $banyumas   = "3302";

        $tahun      = $this->input->get("tahun") ?: date("Y");
        $bulan      = $this->input->get("bulan") ?: (int) date("m");
        $id_kab     = $this->input->get("id_kab");


        $wilayahLansia = $this->lansia
            ->fields()
            ->as_array()
            ->select('DISTINCT id_prov,id_kab,id_kec,id_kel', FALSE)
            ->where("id_kab", "=", $id_kab)
            ->with_prov("fields:nama")
            ->with_kab("fields:nama")
            ->with_kec("fields:nama")
            ->with_kel("fields:nama")
            ->order_by("id_prov", "ASC")
            ->order_by("id_kab", "ASC")
            ->order_by("id_kec", "ASC")
            ->order_by("id_kel", "ASC")
            ->get_all() ?: [];

        $result["waktu"] = [
            "tahun"         => $tahun,
            "bulan"         => $bulan,
        ];
        $result["detail"] = [];


        for ($i = 0; $i < sizeof($wilayahLansia); $i++) {
            $kondisi["id_kel"]  = $wilayahLansia[$i]["id_kel"];

            $kondisiX           = $kondisi;
            $kondisiX["tahun"]  = $tahun;
            $kondisiX["bulan"]  = $bulan;

            $kondisiYa      = $kondisiX;
            $kondisiTidak   = $kondisiX;

            $kondisiYa["merokok"]           = "YA";
            $kondisiTidak["merokok"]        = "TIDAK";

            $semua = $this->vKesLansia
                ->where($kondisiX)
                ->as_array()
                ->count_rows();

            $tidak = $this->vKesLansia
                ->where($kondisiTidak)
                ->as_array()
                ->count_rows();

            $ya = $this->vKesLansia
                ->where($kondisiYa)
                ->as_array()
                ->count_rows();

            $data_tmp = [
                "wilayah"   => [
                    "prov"  => $wilayahLansia[$i]["prov"],
                    "kab"   => $wilayahLansia[$i]["kab"],
                    "kec"   => $wilayahLansia[$i]["kec"],
                    "kel"   => $wilayahLansia[$i]["kel"],
                ],
                "keterangan"    => [
                    "semua"   => $semua,
                    "ya"      => $ya,
                    "tidak"   => $tidak
                ],
            ];

            array_push($result["detail"], $data_tmp);
        }

        return $this->response(array(
            "status"                => true,
            "response_code"         => REST_Controller::HTTP_OK,
            "response_message"      => "Data ditemukan",
            "data"                  => $result
        ), REST_Controller::HTTP_OK);
    }

    public function merokok_remaja_get()
    {
        $cilacap    = "3301";
        $banyumas   = "3302";

        $tahun      = $this->input->get("tahun") ?: date("Y");
        $bulan      = $this->input->get("bulan") ?: (int) date("m");
        $id_kab     = $this->input->get("id_kab");


        $wilayahLansia = $this->lansia
            ->fields()
            ->as_array()
            ->select('DISTINCT id_prov,id_kab,id_kec,id_kel', FALSE)
            ->where("id_kab", "=", $id_kab)
            ->with_prov("fields:nama")
            ->with_kab("fields:nama")
            ->with_kec("fields:nama")
            ->with_kel("fields:nama")
            ->order_by("id_prov", "ASC")
            ->order_by("id_kab", "ASC")
            ->order_by("id_kec", "ASC")
            ->order_by("id_kel", "ASC")
            ->get_all() ?: [];

        $result["waktu"] = [
            "tahun"         => $tahun,
            "bulan"         => $bulan,
        ];
        $result["detail"] = [];


        for ($i = 0; $i < sizeof($wilayahLansia); $i++) {
            $kondisi["id_kel"]  = $wilayahLansia[$i]["id_kel"];

            $kondisiX           = $kondisi;
            $kondisiX["tahun"]  = $tahun;
            $kondisiX["bulan"]  = $bulan;

            $kondisiYa      = $kondisiX;
            $kondisiTidak   = $kondisiX;

            $kondisiYa["merokok"]           = "YA";
            $kondisiTidak["merokok"]        = "TIDAK";

            $semua = $this->vRemaja
                ->where($kondisiX)
                ->as_array()
                ->count_rows();

            $tidak = $this->vRemaja
                ->where($kondisiTidak)
                ->as_array()
                ->count_rows();

            $ya = $this->vRemaja
                ->where($kondisiYa)
                ->as_array()
                ->count_rows();

            $data_tmp = [
                "wilayah"   => [
                    "prov"  => $wilayahLansia[$i]["prov"],
                    "kab"   => $wilayahLansia[$i]["kab"],
                    "kec"   => $wilayahLansia[$i]["kec"],
                    "kel"   => $wilayahLansia[$i]["kel"],
                ],
                "keterangan"    => [
                    "semua"   => $semua,
                    "ya"      => $ya,
                    "tidak"   => $tidak
                ],
            ];

            array_push($result["detail"], $data_tmp);
        }

        return $this->response(array(
            "status"                => true,
            "response_code"         => REST_Controller::HTTP_OK,
            "response_message"      => "Data ditemukan",
            "data"                  => $result
        ), REST_Controller::HTTP_OK);
    }

    public function sarapan_get()
    {
        $cilacap    = "3301";
        $banyumas   = "3302";

        $tahun      = $this->input->get("tahun") ?: date("Y");
        $bulan      = $this->input->get("bulan") ?: (int) date("m");
        $id_kab     = $this->input->get("id_kab");


        $wilayahLansia = $this->lansia
            ->fields()
            ->as_array()
            ->select('DISTINCT id_prov,id_kab,id_kec,id_kel', FALSE)
            ->where("id_kab", "=", $id_kab)
            ->with_prov("fields:nama")
            ->with_kab("fields:nama")
            ->with_kec("fields:nama")
            ->with_kel("fields:nama")
            ->order_by("id_prov", "ASC")
            ->order_by("id_kab", "ASC")
            ->order_by("id_kec", "ASC")
            ->order_by("id_kel", "ASC")
            ->get_all() ?: [];

        $result["waktu"] = [
            "tahun"         => $tahun,
            "bulan"         => $bulan,
        ];
        $result["detail"] = [];


        for ($i = 0; $i < sizeof($wilayahLansia); $i++) {
            $kondisi["id_kel"]  = $wilayahLansia[$i]["id_kel"];

            $kondisiX           = $kondisi;
            $kondisiX["tahun"]  = $tahun;
            $kondisiX["bulan"]  = $bulan;

            $kondisiYa      = $kondisiX;
            $kondisiTidak   = $kondisiX;

            // $kondisiYa["merokok"]           = "YA";
            // $kondisiTidak["merokok"]        = "TIDAK";

            $semua = $this->vRemaja
                ->where($kondisiX)
                ->as_array()
                ->count_rows();

            $tidak = $this->vRemaja
                ->where($kondisiTidak)
                ->where("CAST(sarapan AS UNSIGNED)", "<=", $this->minSarapan)
                ->as_array()
                ->count_rows();

            $ya = $semua - $tidak;

            $data_tmp = [
                "wilayah"   => [
                    "prov"  => $wilayahLansia[$i]["prov"],
                    "kab"   => $wilayahLansia[$i]["kab"],
                    "kec"   => $wilayahLansia[$i]["kec"],
                    "kel"   => $wilayahLansia[$i]["kel"],
                ],
                "keterangan"    => [
                    "semua"   => $semua,
                    "ya"      => $ya,
                    "tidak"   => $tidak
                ],
            ];

            array_push($result["detail"], $data_tmp);
        }

        return $this->response(array(
            "status"                => true,
            "response_code"         => REST_Controller::HTTP_OK,
            "response_message"      => "Data ditemukan",
            "data"                  => $result
        ), REST_Controller::HTTP_OK);
    }

    public function imunisasi_get()
    {
        $cilacap    = "3301";
        $banyumas   = "3302";

        $tahun      = $this->input->get("tahun") ?: date("Y");
        $bulan      = $this->input->get("bulan") ?: (int) date("m");
        $id_kab     = $this->input->get("id_kab");


        $wilayahLansia = $this->lansia
            ->fields()
            ->as_array()
            ->select('DISTINCT id_prov,id_kab,id_kec,id_kel', FALSE)
            ->where("id_kab", "=", $id_kab)
            ->with_prov("fields:nama")
            ->with_kab("fields:nama")
            ->with_kec("fields:nama")
            ->with_kel("fields:nama")
            ->order_by("id_prov", "ASC")
            ->order_by("id_kab", "ASC")
            ->order_by("id_kec", "ASC")
            ->order_by("id_kel", "ASC")
            ->get_all() ?: [];

        $result["waktu"] = [
            "tahun"         => $tahun,
            "bulan"         => $bulan,
        ];
        $result["detail"] = [];


        for ($i = 0; $i < sizeof($wilayahLansia); $i++) {
            $kondisi["id_kel"]  = $wilayahLansia[$i]["id_kel"];

            $kondisiX           = $kondisi;
            $kondisiX["tahun"]  = $tahun;
            $kondisiX["bulan"]  = $bulan;

            $kondisiYa      = $kondisiX;
            $kondisiTidak   = $kondisiX;

            $kondisiYa["imunisasi"]           = "YA";
            $kondisiTidak["imunisasi"]        = "TIDAK";

            $semua = $this->vBayiBalita
                ->where($kondisiX)
                ->as_array()
                ->count_rows();

            $tidak = $this->vBayiBalita
                ->where($kondisiTidak)
                ->as_array()
                ->count_rows();

            $ya =  $this->vBayiBalita
                ->where($kondisiYa)
                ->as_array()
                ->count_rows();

            $data_tmp = [
                "wilayah"   => [
                    "prov"  => $wilayahLansia[$i]["prov"],
                    "kab"   => $wilayahLansia[$i]["kab"],
                    "kec"   => $wilayahLansia[$i]["kec"],
                    "kel"   => $wilayahLansia[$i]["kel"],
                ],
                "keterangan"    => [
                    "semua"   => $semua,
                    "ya"      => $ya,
                    "tidak"   => $tidak
                ],
            ];

            array_push($result["detail"], $data_tmp);
        }

        return $this->response(array(
            "status"                => true,
            "response_code"         => REST_Controller::HTTP_OK,
            "response_message"      => "Data ditemukan",
            "data"                  => $result
        ), REST_Controller::HTTP_OK);
    }
}
