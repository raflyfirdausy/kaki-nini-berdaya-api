<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Admin extends REST_Controller
{
    private $adminX;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Admin_model", "admin");
    }

    public function index_get()
    {
        $page       = $this->input->get("page", TRUE) ?: "1";
        $perPage    = $this->input->get("perpage", TRUE) ?: "10";

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

        $model      = $this->admin;
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
        $id_admin   = $this->input->get("id_admin", TRUE);
        $level      = $this->input->get("level", TRUE);

        $data       = $model;

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
            $data = $data->where("LOWER(nama)", "LIKE", strtolower($search));
            $data = $data->where("LOWER(email)", "LIKE", strtolower($search));
        }

        if (!empty($level)) {
            $data = $data->where("LOWER(level)", "=", strtolower($level));
        }

        // if (!empty($id_admin)) {
        //     $data = $data->where(["id" => $id_admin]);
        // }

        return $data;
    }

    public function index_post()
    {
        $email      = $this->input->post("email");
        $nama       = $this->input->post("nama");
        $level      = $this->input->post("level");
        $created_by = $this->input->post("created_by");

        $no_hp      = $this->input->post("no_hp");
        $password   = $this->input->post("password");

        $id_prov    = $this->input->post("id_prov");
        $id_kab     = $this->input->post("id_kab");
        $id_kec     = $this->input->post("id_kec");
        $id_kel     = $this->input->post("id_kel");

        if (empty($email) && empty($no_hp)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Email atau No Hp admin tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($nama)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Nama admin tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($level)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Level admin tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else {
            //TODO : CEK NO HP NYA UDAH KEDAFTAR BELUM
            if (!empty($no_hp)) {
                if (empty($password)) {
                    return $this->response(array(
                        "status"                => true,
                        "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                        "response_message"      => "Password tidak boleh kosong",
                    ), REST_Controller::HTTP_OK);
                }
                $cekHp = $this->admin->where(["no_hp" => $no_hp])->get();
                if ($cekHp) {
                    return $this->response(array(
                        "status"                => true,
                        "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                        "response_message"      => "No HP Sudah digunakan oleh admin " . $cekHp["nama"] . " Silahkan gunakan yang lain",
                    ), REST_Controller::HTTP_OK);
                }
            }

            if (!empty($email)) {
                //TODO : CEK EMAILNYA UDAH KEDAFTAR BELUM
                $cek = $this->admin->where(["email" => $email])->get();
                if ($cek) {
                    return $this->response(array(
                        "status"                => true,
                        "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                        "response_message"      => "Email sudah terdaftar atas nama " . $cek["nama"] . " dengan level admin " . $cek["level"] . ". Silahkan gunakan email lain.",
                    ), REST_Controller::HTTP_OK);
                }
            }

            $dataInsert = [
                "email"         => $email,
                "nama"          => $nama,

                "no_hp"         => $no_hp,
                "password"      => md5($password),

                "level"         => $level,
                "id_prov"       => $id_prov,
                "id_kab"        => $id_kab,
                "id_kec"        => $id_kec,
                "id_kel"        => $id_kel,
                "created_by"    => $created_by,
            ];
            $insert = $this->admin->insert($dataInsert);
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
                    "response_message"      => "Terjadi kesalahan saat menambahkan data admin",
                ), REST_Controller::HTTP_OK);
            }
        }
    }

    public function update_post()
    {
        $id         = $this->input->post("id");

        $email      = $this->input->post("email");
        $nama       = $this->input->post("nama");
        $level      = $this->input->post("level");
        $created_by = $this->input->post("created_by");

        $no_hp      = $this->input->post("no_hp");
        $password   = $this->input->post("password");

        $id_prov    = $this->input->post("id_prov");
        $id_kab     = $this->input->post("id_kab");
        $id_kec     = $this->input->post("id_kec");
        $id_kel     = $this->input->post("id_kel");

        if (empty($email) && empty($no_hp)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Email atau No Hp admin tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($nama)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Nama admin tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else if (empty($level)) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_BAD_REQUEST,
                "response_message"      => "Level admin tidak boleh kosong",
            ), REST_Controller::HTTP_OK);
        } else {
            $dataUpdate = [
                "email"         => $email,
                "nama"          => $nama,
                
                "no_hp"         => $no_hp,                

                "level"         => $level,
                "id_prov"       => $id_prov,
                "id_kab"        => $id_kab,
                "id_kec"        => $id_kec,
                "id_kel"        => $id_kel,
                "created_by"    => $created_by,
            ];

            if($password){
                $dataUpdate["password"] = md($password);
            }
            $update = $this->admin->where(["id" => $id])->update($dataUpdate);
            if ($update) {
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_OK,
                    "response_message"      => "Berhasil mengubah admin $nama",
                ), REST_Controller::HTTP_OK);
            } else {
                return $this->response(array(
                    "status"                => true,
                    "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                    "response_message"      => "Terjadi kesalahan saat mengubah data admin",
                ), REST_Controller::HTTP_OK);
            }
        }
    }

    public function delete_post()
    {
        $id             = $this->input->post("id");
        $delete         = $this->admin->where(["id" => $id])->delete();
        if ($delete) {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_OK,
                "response_message"      => "Berhasil menghapus data admin",
            ), REST_Controller::HTTP_OK);
        } else {
            return $this->response(array(
                "status"                => true,
                "response_code"         => REST_Controller::HTTP_NOT_FOUND,
                "response_message"      => "Terjadi kesalahan saat menghapus data admin",
            ), REST_Controller::HTTP_OK);
        }
    }
}
