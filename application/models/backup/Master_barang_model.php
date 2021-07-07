<?php

class Master_barang_model extends Custom_model
{
    public $table           = 'master_barang';
    public $primary_key     = 'id_masterbarang';
    public $soft_deletes    = TRUE;
    public $timestamps      = TRUE;
    public $return_as       = "array";

    public function __construct()
    {
        parent::__construct();
        $this->has_one['kategori'] = array(
            'foreign_model'     => 'Kategori_barang_model',
            'foreign_table'     => 'kategori_barang',
            'foreign_key'       => 'id_kategori_barang',
            'local_key'         => 'id_kategori_barang'
        );
    }
}
