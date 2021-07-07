<?php

class Jenistoko_model extends Custom_model
{
    public $table           = 'jenis_toko';
    public $primary_key     = 'id';
    public $soft_deletes    = TRUE;
    public $timestamps      = TRUE;
    public $return_as       = "array";

    public function __construct()
    {            
        parent::__construct();              
    }
}
