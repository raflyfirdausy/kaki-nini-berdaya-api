<?php

class Admin_model extends Custom_model
{
    public $table           = 'admin';
    public $primary_key     = 'id_admin';
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
    }
}
