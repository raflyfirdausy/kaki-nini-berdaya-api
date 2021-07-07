<?php

class Transaksi_model extends Custom_model
{
    public $table           = 'transaksi';
    public $primary_key     = 'id_transaksi';
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
        $this->has_many['detail_transaksi'] = array(
            'foreign_model'     => 'Detail_transaksi_model',
            'foreign_table'     => 'detail_transaksi',
            'foreign_key'       => 'id_transaksi',
            'local_key'         => 'id_transaksi'
        );
        $this->has_one['pembayaran'] = array(
            'foreign_model'     => 'Pembayaran_model',
            'foreign_table'     => 'pembayaran',
            'foreign_key'       => 'id_pembayaran',
            'local_key'         => 'id_pembayaran'
        );
    }
}
