<?php

class Admin_model extends Custom_model
{
    public $table           = 'm_admin';
    public $primary_key     = 'id';
    public $soft_deletes    = TRUE;
    public $timestamps      = TRUE;
    public $return_as       = "array";

    public function __construct()
    {
        parent::__construct();

        $this->has_one['prov'] = array(
            'foreign_model'     => 'Wilayah_provinsi_model',
            'foreign_table'     => 'wilayah_provinsi',
            'foreign_key'       => 'id_prov',
            'local_key'         => 'id_prov'
        );

        $this->has_one['kab'] = array(
            'foreign_model'     => 'Wilayah_kabupaten_model',
            'foreign_table'     => 'wilayah_kabupaten',
            'foreign_key'       => 'id_kab',
            'local_key'         => 'id_kab'
        );

        $this->has_one['kec'] = array(
            'foreign_model'     => 'Wilayah_kecamatan_model',
            'foreign_table'     => 'wilayah_kecamatan',
            'foreign_key'       => 'id_kec',
            'local_key'         => 'id_kec'
        );

        $this->has_one['kel'] = array(
            'foreign_model'     => 'Wilayah_kelurahan_model',
            'foreign_table'     => 'wilayah_kelurahan',
            'foreign_key'       => 'id_kel',
            'local_key'         => 'id_kel'
        );
    }
}
