<?php

include_once 'M_records.php';

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_statuses extends M_records
{
    protected $table = 'statuses';

    public function __construct()
    {
        $this->setTableName($this->table);
        parent::__construct();
    }
}