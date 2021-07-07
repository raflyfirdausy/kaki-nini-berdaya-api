<?php

class Pembayaran_model extends Custom_model
{
    public $table           = 'pembayaran';
    public $primary_key     = 'id_pembayaran';
    public $soft_deletes    = TRUE;
    public $timestamps      = TRUE;
    public $return_as       = "array";

    public function __construct()
    {            
        parent::__construct();              
    }
}
