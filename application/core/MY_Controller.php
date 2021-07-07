<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class MY_Controller extends CI_Controller
{
    private $global_data;
    public function __construct()
    {
        parent::__construct();
        $CI = &get_instance(); //MENGGANTI $this

        // $this->global_data = [
        //     "app_name"          => "Doomu",            
        //     "CI"                => $CI,
        //     "_session"          => $CI->session->userdata(INNO_SESSION),
        //     "title"             => ucwords($this->router->fetch_class())            
        // ];
    }

    public function loadView($view = NULL, $local_data = array(), $asData = FALSE)
    {
        if (!file_exists(APPPATH . "views/$view" . ".php")) {
            show_404();
        }
        $data = array_merge($this->global_data, $local_data);
        return $this->load->view($view, $data, $asData);
    }
}