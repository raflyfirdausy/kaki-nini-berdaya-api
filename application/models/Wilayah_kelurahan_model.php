<?php

class Wilayah_kelurahan_model extends Custom_model
{
    public $table           = 'wilayah_kelurahan';
    public $primary_key     = 'id_kel';
    public $soft_deletes    = FALSE;
    public $timestamps      = FALSE;
    public $return_as       = "array";

    public function __construct()
    {
        parent::__construct();
    }
}
