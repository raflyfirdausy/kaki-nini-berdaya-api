<?php

class Jamkirim_model extends Custom_model
{
    public $table           = 'jam_kirim';
    public $primary_key     = 'id';
    public $soft_deletes    = TRUE;
    public $timestamps      = TRUE;
    public $return_as       = "array";

    public function __construct()
    {            
        parent::__construct();              
    }
}
