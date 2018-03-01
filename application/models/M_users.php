<?php

include_once 'M_records.php';

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_users extends M_records
{
    protected $table = 'users';

    public function __construct()
    {
        $this->setTableName($this->table);
        parent::__construct();
    }
}