<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_model", "user");
        $this->load->model("Rest_keys_model", "key");
    }

    public function update_token_post()
    {
        $id_user    = $this->input->post("id_user");
        $token_user = $this->input->post("token_user");
        $update     = $this->user->update(["token_user" => $token_user], $id_user);
        if ($update) {
            return $this->response("Sukses Update Token", REST_Controller::HTTP_OK);
        } else {
            return $this->response("Gagal Update Token", REST_Controller::HTTP_OK);
        }
    }

    public function update_user_post()
    {
        $id_user    = $this->input->post("id_user");
        $nama_user  = $this->input->post("nama_user");
        $nohp_user  = $this->input->post("nohp_user");

        $dataUpdate = [
            "nama_user"     => $nama_user,
            "nohp_user"     => $nohp_user
        ];

        $update = $this->user->where(["id_user" => $id_user])->update($dataUpdate);
        if($update){
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Data berhasil di update",                
            ), REST_Controller::HTTP_OK);
        } else {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                "response_message"      => "Nomer Handphone sudah terdaftar, silahkan gunakan yang lainya",                
            ), REST_Controller::HTTP_OK);
        }
    }

    public function get_user_get()
    {
        $id_user    = $this->input->get("id_user");
        $user       = $this->user->get($id_user);
        if ($id_user) {
            if ($user) {
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_OK,
                    "response_message"      => "User ditemukan",
                    "data"                  => $user
                ), REST_Controller::HTTP_OK);
            } else {
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                    "response_message"      => "User tidak ditemukan",
                    "data"                  => null
                ), REST_Controller::HTTP_OK);
            }
        } else {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_EXPECTATION_FAILED,
                "response_message"      => "User tidak ditemukan",
                "data"                  => null
            ), REST_Controller::HTTP_OK);
        }
    }

    public function cek_credential_post()
    {
        $email = trim($this->input->post("email", TRUE));
        $cek = $this->user->get(["email_user" => $email]);
        if ($cek) {
            $key = $this->key->get(["user_id" => $cek->id_user]);
            $cek->api_key = $key;
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

    public function register_post()
    {
        $email_user = $this->input->post("email_user", TRUE);
        $nama_user  = $this->input->post("nama_user", TRUE);
        $nohp_user  = $this->input->post("nohp_user", TRUE);
        // $token_user = $this->input->post("token_user", TRUE);

        $datainsertUser = [
            "email_user"        => $email_user,
            "nama_user"         => $nama_user,
            "nohp_user"         => $nohp_user,
            // "token_user"        => $token_user
        ];

        $insertUser = $this->user->insert($datainsertUser);
        if ($insertUser) {
            $key = $this->_generateKey();
            $dataInsertKey = [
                "user_id"           => $insertUser,
                "key"               => $key,
                "level"             => 1,
                "ignore_limits"     => 0,
                "is_private_key"    => 0,
                "ip_addresses"      => $this->input->ip_address(),
                "date_created"      => now()
            ];
            $this->key->insert($dataInsertKey);

            $datainsertUser["key"]  = $key;
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Berhasil melakukan pendaftaran",
                "data"                  => $datainsertUser
            ), REST_Controller::HTTP_OK);
        } else {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_INTERNAL_SERVER_ERROR,
                "response_message"      => "Nomer Handphone sudah digunakan orang lain. Silahkan gunakan yang lain.",
                "data"                  => NULL
            ), REST_Controller::HTTP_OK);
        }
    }   
}
