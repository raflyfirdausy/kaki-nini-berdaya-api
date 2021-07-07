<?php

class Notifikasi_model extends Custom_model
{
    public $table           = 'notifikasi';
    public $primary_key     = 'id_notifikasi';
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
            'local_key'         => 'personal_id'
        );              
    }
}
