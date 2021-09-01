<?php

class Tr_kesehatan_lansia_model extends Custom_model
{
    public $table           = 'tr_kesehatan_lansia';
    public $primary_key     = 'id';
    public $soft_deletes    = TRUE;
    public $timestamps      = TRUE;
    public $return_as       = "array";

    public function __construct()
    {
        parent::__construct();

        $this->has_one['lansia'] = array(
            'foreign_model'     => 'Lansia_model',
            'foreign_table'     => 'm_lansia',
            'foreign_key'       => 'id',
            'local_key'         => 'id_lansia'
        );       

        $this->has_one['admin'] = array(
            'foreign_model'     => 'Admin_model',
            'foreign_table'     => 'm_admin',
            'foreign_key'       => 'id',
            'local_key'         => 'created_by'
        );
    }
}
