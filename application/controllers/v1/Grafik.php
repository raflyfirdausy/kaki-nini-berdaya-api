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
        $this->load->model("Vwilayah_lansia_model", "vWilayahLansia");
        $this->load->model("Admin_model", "admin");
        $this->load->model("Tr_peranan_lansia_model", "trPeranan");
        $this->load->model("Lansia_model", "lansia");
    }

    public function desa_get()
    {

        $cilacap    = "3301";
        $banyumas   = "3302";

        $tahun      = $this->input->get("tahun") ?: date("Y");
        $bulan      = $this->input->get("bulan") ?: (int) date("m");
        $id_kab     = $this->input->get("id_kab") ?: $cilacap;


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
}
