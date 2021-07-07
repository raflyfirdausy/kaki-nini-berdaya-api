<?php

class User_model extends Custom_model
{
    public $table           = 'user';
    public $primary_key     = 'id_user';
    public $soft_deletes    = TRUE;
    public $timestamps      = TRUE;
    public $return_as       = "object";

    public function __construct()
    {
        parent::__construct();
        $this->has_one['key'] = array(
            'foreign_model'     => 'Rest_keys_model',
            'foreign_table'     => 'rest_keys',
            'foreign_key'       => 'id_user',
            'local_key'         => 'id'
        );

        $this->has_one['prov'] = array(
            'foreign_model'     => 'Wilayah_provinsi_model',
            'foreign_table'     => 'wilayah_provinsi',
            'foreign_key'       => 'id_prov',
            'local_key'         => 'prov_id'
        );

        $this->has_one['kab'] = array(
            'foreign_model'     => 'Wilayah_kabupaten_model',
            'foreign_table'     => 'wilayah_kabupaten',
            'foreign_key'       => 'id_kab',
            'local_key'         => 'kab_id'
        );

        $this->has_one['kec'] = array(
            'foreign_model'     => 'Wilayah_kecamatan_model',
            'foreign_table'     => 'wilayah_kecamatan',
            'foreign_key'       => 'id_kec',
            'local_key'         => 'kec_id'
        );

        $this->has_one['kel'] = array(
            'foreign_model'     => 'Wilayah_kelurahan_model',
            'foreign_table'     => 'wilayah_kelurahan',
            'foreign_key'       => 'id_kel',
            'local_key'         => 'kel_id'
        );
    }

    public function list()
    {
        $q1 = "SELECT
            a.id_user,
            a.email_user as email,
            a.nama_user as nama,
            a.nohp_user as no_hp,
            a.created_at as tanggal_daftar,
            COUNT( t.id_user ) as selesai
        FROM
            user AS a
            LEFT JOIN transaksi AS t ON t.id_user = a.id_user 
            AND t.status_transaksi = 2	
        GROUP BY
            a.id_user";

        $user = $this->db->query(
            "SELECT utama.*, COUNT(t2.id_user) as batal 
            FROM ($q1) as utama
            LEFT JOIN transaksi AS t2 ON t2.id_user = utama.id_user 
            AND t2.status_transaksi = 3
            GROUP BY
            utama.id_user
            -- ORDER BY utama.selesai DESC, batal DESC, utama.tanggal_daftar DESC
            ORDER BY utama.tanggal_daftar DESC
            "
        )->result_array();

        return $user;
    }
}
