<?php

class Toko_model extends Custom_model
{
    public $table           = 'toko';
    public $primary_key     = 'id_toko';
    public $soft_deletes    = TRUE;
    public $timestamps      = TRUE;
    public $return_as       = "array";

    public function __construct()
    {            
        parent::__construct(); 
    }
}
