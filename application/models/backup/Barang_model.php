<?php

class Barang_model extends Custom_model
{
    public $table           = 'barang';
    public $primary_key     = 'id_barang';
    public $soft_deletes    = TRUE;
    public $timestamps      = TRUE;
    public $return_as       = "array";

    public function __construct()
    {
        parent::__construct();
        $this->has_one['toko'] = array(
            'foreign_model'     => 'Toko_model',
            'foreign_table'     => 'toko',
            'foreign_key'       => 'id_toko',
            'local_key'         => 'id_toko'
        );
        $this->has_one['kategori'] = array(
            'foreign_model'     => 'Kategori_barang_model',
            'foreign_table'     => 'kategori_barang',
            'foreign_key'       => 'id_kategori_barang',
            'local_key'         => 'id_kategori_barang'
        );
    }
}
