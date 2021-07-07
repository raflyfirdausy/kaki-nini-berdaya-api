<?php

class Riwayat_saldo_model extends Custom_model
{
    public $table           = 'riwayat_saldo';
    public $primary_key     = 'id';
    public $soft_deletes    = TRUE;
    public $timestamps      = TRUE;
    public $return_as       = "array";

    public function __construct()
    {            
        parent::__construct();              
    }
}
