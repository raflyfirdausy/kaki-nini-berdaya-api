<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Admin_model", "admin");
    }

    public function cek_credential_post()
    {
        $email = trim($this->input->post("email", TRUE));
        $cek = $this->admin
            ->with_prov()
            ->with_kab()
            ->with_kec()
            ->with_kel()
            ->where(["email" => $email])
            ->get();

        if ($cek) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Email Sudah terdaftar",
                "data"                  => $cek
            ), REST_Controller::HTTP_OK);
        } else {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Email Belum terdaftar",
                "data"                  => NULL
            ), REST_Controller::HTTP_OK);
        }
    }

    public function login_post()
    {
        $no_hp      = $this->input->post("no_hp", TRUE);
        $password   = $this->input->post("password", TRUE);

        $cek = $this->admin
            ->with_prov()
            ->with_kab()
            ->with_kec()
            ->with_kel()
            ->where(["no_hp" => $no_hp, "password" => md5($password)])
            ->get();

        if ($cek) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Login Sudah benar",
                "data"                  => $cek
            ), REST_Controller::HTTP_OK);
        } else {
            $cek = $this->admin
            ->with_prov()
            ->with_kab()
            ->with_kec()
            ->with_kel()
            ->where(["no_hp" => $no_hp, "password" => $password])
            ->get();
            if ($cek) {
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_OK,
                    "response_message"      => "Login Sudah benar",
                    "data"                  => $cek
                ), REST_Controller::HTTP_OK);
            } else {
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                    "response_message"      => "No HP atau Password yang kamu masukan salah",
                    "data"                  => NULL
                ), REST_Controller::HTTP_OK);
            }           
        }
    }
}
