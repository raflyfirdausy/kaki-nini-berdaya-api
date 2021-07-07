<?php

class Rest_keys_model extends Custom_model
{
    public $table           = 'rest_keys';
    public $primary_key     = 'id';
    public $soft_deletes    = FALSE;
    public $timestamps      = FALSE;
    public $return_as       = "object";

    public function __construct()
    {            
        parent::__construct();
    }
}
