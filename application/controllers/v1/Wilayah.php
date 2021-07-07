<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Wilayah extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Wilayah_provinsi_model", "prov");
        $this->load->model("Wilayah_kabupaten_model", "kab");
        $this->load->model("Wilayah_kecamatan_model", "kec");
        $this->load->model("Wilayah_kelurahan_model", "kel");
    }

    public function prov_get()
    {
        $id_prov    = $this->input->get("id_prov");
        $kondisi    = [];
        if ($id_prov) {
            $kondisi["id_prov"] = $id_prov;
        }

        $data       = $this->prov->where($kondisi)->order_by("nama", "ASC")->get_all();
        if ($data) {
            return $this->response([
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Provinsi ditemukan",
                "data"                  => $data
            ], REST_Controller::HTTP_OK);
        } else {
            return $this->response([
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Provinsi tidak ditemukan",
                "data"                  => NULL
            ], REST_Controller::HTTP_OK);
        }
    }

    public function kab_get()
    {
        $id_prov    = $this->input->get("id_prov");
        $id_kab     = $this->input->get("id_kab");

        $kondisi["id_prov"] = $id_prov;

        if ($id_kab) {
            $kondisi["id_kab"] = $id_kab;
        }

        $data       = $this->kab->where($kondisi)->order_by("nama", "ASC")->get_all();
        if ($data) {
            return $this->response([
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Kabupaten ditemukan",
                "data"                  => $data
            ], REST_Controller::HTTP_OK);
        } else {
            return $this->response([
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Kabupaten tidak ditemukan",
                "data"                  => NULL
            ], REST_Controller::HTTP_OK);
        }
    }

    public function kec_get()
    {
        $id_kab    = $this->input->get("id_kab");
        $id_kec     = $this->input->get("id_kec");

        $kondisi["id_kab"] = $id_kab;

        if ($id_kec) {
            $kondisi["id_kec"] = $id_kec;
        }

        $data       = $this->kec->where($kondisi)->order_by("nama", "ASC")->get_all();
        if ($data) {
            return $this->response([
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Kecamatan ditemukan",
                "data"                  => $data
            ], REST_Controller::HTTP_OK);
        } else {
            return $this->response([
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Kecamatan tidak ditemukan",
                "data"                  => NULL
            ], REST_Controller::HTTP_OK);
        }
    }

    public function kel_get()
    {
        $id_kec     = $this->input->get("id_kec");
        $id_kel    = $this->input->get("id_kel");

        $kondisi["id_kec"] = $id_kec;

        if ($id_kel) {
            $kondisi["id_kel"] = $id_kel;
        }

        $data       = $this->kel->where($kondisi)->order_by("nama", "ASC")->get_all();
        if ($data) {
            return $this->response([
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Desa / Kelurahan ditemukan",
                "data"                  => $data
            ], REST_Controller::HTTP_OK);
        } else {
            return $this->response([
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Desa / Kelurahan tidak ditemukan",
                "data"                  => NULL
            ], REST_Controller::HTTP_OK);
        }
    }
}
