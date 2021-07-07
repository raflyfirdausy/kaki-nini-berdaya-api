<?php

class Pembayarandiskon_model extends Custom_model
{
    public $table           = 'pembayaran_diskon';
    public $primary_key     = 'id_pembayaran_diskon';
    public $soft_deletes    = TRUE;
    public $timestamps      = TRUE;
    public $return_as       = "object";

    public function __construct()
    {            
        parent::__construct();     
        $this->has_one['toko'] = array(
            'foreign_model'     => 'Toko_model',
            'foreign_table'     => 'toko',
            'foreign_key'       => 'id_toko',
            'local_key'         => 'id_toko'
        );   

        $this->has_one['pembayaran'] = array(
            'foreign_model'     => 'Pembayaran_model',
            'foreign_table'     => 'pembayaran',
            'foreign_key'       => 'id_pembayaran',
            'local_key'         => 'id_pembayaran'
        );
    }
}
