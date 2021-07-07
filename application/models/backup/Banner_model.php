<?php

class Banner_model extends Custom_model
{
    public $table           = 'banner';
    public $primary_key     = 'id_banner';
    public $soft_deletes    = TRUE;
    public $timestamps      = TRUE;
    public $return_as       = "array";

    public function __construct()
    {            
        parent::__construct();
    }
}
