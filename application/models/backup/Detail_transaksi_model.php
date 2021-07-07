<?php

class Detail_transaksi_model extends Custom_model
{
    public $table           = 'detail_transaksi';
    public $primary_key     = 'id_detailtransaksi';
    public $soft_deletes    = TRUE;
    public $timestamps      = TRUE;
    public $return_as       = "array";

    public function __construct()
    {            
        parent::__construct();       
        $this->has_one['transaksi'] = array(
            'foreign_model'     => 'Transaksi_model',
            'foreign_table'     => 'transaksi',
            'foreign_key'       => 'id_transaksi',
            'local_key'         => 'id_transaksi'
        );   
        $this->has_one['barang'] = array(
            'foreign_model'     => 'Barang_model',
            'foreign_table'     => 'barang',
            'foreign_key'       => 'id_barang',
            'local_key'         => 'id_barang'
        );     
    }
}
