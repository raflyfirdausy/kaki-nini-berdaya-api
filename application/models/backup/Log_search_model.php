<?php

class Log_search_model extends Custom_model
{
    public $table           = 'log_search';
    public $primary_key     = 'id';
    public $soft_deletes    = TRUE;
    public $timestamps      = TRUE;
    public $return_as       = "array";

    public function __construct()
    {            
        parent::__construct();
        $this->has_one['user'] = array(
            'foreign_model'     => 'User_model',
            'foreign_table'     => 'user',
            'foreign_key'       => 'id_user',
            'local_key'         => 'id_user'
        );

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
            'local_key'         => 'id_kategori'
        );  

        $this->has_one['jenis_toko'] = array(
            'foreign_model'     => 'Jenistoko_model',
            'foreign_table'     => 'jenis_toko',
            'foreign_key'       => 'id',
            'local_key'         => 'jenis_toko'
        );  
    }
}
