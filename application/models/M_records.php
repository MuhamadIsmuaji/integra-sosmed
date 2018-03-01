<?php

class M_records extends CI_Model
{
    const RELATION_HAS_MANY = 20;
    const RELATION_HAS_ONE = 10;

    protected $tableName;
    protected $listColumnName = [];
    protected $listTableFilterName = [];
    protected $listLikeName = [];
    protected $relations = [];
    protected $order_byName;

    public function __construct()
    {
        parent::__construct();
    }

    public function setTableName($name)
    {
        $this->tableName = $name;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setRelations($table, $relations)
    {
        $this->relations[$table] = $relations;
    }

    public function getRelations()
    {
        return $this->relations;
    }

    public function setListColumn($listColumn)
    {
        $this->listColumnName = $listColumn;
    }

    public function getListColumn()
    {
        return $this->listColumnName;
    }

    public function setListLike($listLike)
    {
        $this->listLikeName = $listLike;
    }

    public function getListLike()
    {
        return $this->listLikeName;
    }

    public function setOrderBy($order_by)
    {
        $this->order_byName = $order_by;
    }

    /*
     * $param = array('nama_kolom' => $nilai);  > data parameter untuk mendapatkan record tertentu
     */
    public function findOne($param)
    {
        $this->db->from($this->getTableName());
        $this->db->where($param);
        return $this->db->get()->row();
    }

    public function findAllByCondition($param)
    {
        $this->db->from($this->getTableName());
        $this->db->where($param);
        return $this->db->get()->result();
    }

    public function findAll()
    {
        return $this->db->get($this->tableName)->result();
    }

    public function findCustom($limit = null, $offset = null, $filter = null, $keyword = null)
    {
        foreach ($this->listColumnName as $value) :
            $this->db->select($value);
        endforeach;

        //relations
        if ($this->relations > 0) :
            foreach ($this->relations as $key => $value) :
                $this->db->join($key, $value);
        endforeach;
        endif;

        if ($filter) :
            foreach ($filter as $where) :
                $this->db->where($where);
        endforeach;
        endif;

        // pencarian berdasar keyword
        if ($keyword) :
            $counter = 0;
        $like = '(';
        foreach ($this->listLikeName as $value) :
                if (!$counter) :
                    $like .= $value . ' LIKE "%' . $keyword . '%"'; else :
                    $like .= ' OR ' . $value . ' LIKE "%' . $keyword . '%"';
        endif;
        $counter++;
        endforeach;
        $like .= ')';
        $this->db->where($like);
        endif;

        // limit
        if ($limit) :
            $this->db->limit($limit, $offset);
        endif;

        $this->db->order_by($this->order_byName);

        return $this->db->get($this->tableName)->result();
    }

    /*
     * $data = array('nama_kolom' => $nilai);   > data untuk dimasukkan ke DB
     */
    public function insert($data)
    {
        return $this->db->insert($this->tableName, $data);
    }

    /*
     * $data = array('nama_kolom' => $nilai);   > data untuk dimasukkan ke DB
     * $param = array('nama_kolom' => $nilai);  > data parameter untuk mendapatkan record tertentu
     */
    public function update($data, $param)
    {
        return $this->db->update($this->tableName, $data, $param);
    }

    public function delete($param)
    {
        return $this->db->delete($this->tableName, $param);
    }
}