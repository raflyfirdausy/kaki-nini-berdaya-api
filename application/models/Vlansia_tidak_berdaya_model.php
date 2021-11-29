<?php

class Vlansia_tidak_berdaya_model extends Custom_model
{
    public $table           = 'v_lansia_tidak_berdaya';
    public $primary_key     = 'id';
    public $soft_deletes    = TRUE;
    public $timestamps      = TRUE;
    public $return_as       = "array";

    public function __construct()
    {
        parent::__construct();
    }
}
