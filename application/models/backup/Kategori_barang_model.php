<?php

class Kategori_barang_model extends Custom_model
{
    public $table           = 'kategori_barang';
    public $primary_key     = 'id_kategori_barang';
    public $soft_deletes    = TRUE;
    public $timestamps      = TRUE;
    public $return_as       = "array";

    public function __construct()
    {            
        parent::__construct();               
    }
}
