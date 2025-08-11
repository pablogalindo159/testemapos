<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Os_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        return $this->db->get('os')->result();
    }

    public function add($dados)
    {
        $this->db->insert('os', $dados);
        return $this->db->insert_id();
    }

    public function update($id, $dados)
    {
        $this->db->where('id', $id)->update('os', $dados);
    }

    public function getById($id)
    {
        return $this->db->where('id', $id)->get('os')->row();
    }

    public function getByEquipamento($equipamento_id)
    {
        return $this->db->where('equipamento_id', $equipamento_id)->get('os')->result();
    }
}