<?php

class Wilayah_kecamatan_model extends Custom_model
{
    public $table           = 'wilayah_kecamatan';
    public $primary_key     = 'id_kec';
    public $soft_deletes    = FALSE;
    public $timestamps      = FALSE;
    public $return_as       = "array";

    public function __construct()
    {
        parent::__construct();
    }
}
