<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelMeja extends CI_Model
{
    //manajemen buku
    public function getMeja()
    {
        return $this->db->get('meja');
    }


    public function mejaWhere($where)
    {
        return $this->db->get_where('meja', $where);
    }

    public function simpanMeja($data = null)
    {
        $this->db->insert('meja', $data);
    }

    public function updateMeja($data = null, $where = null)
    {
        $this->db->update('meja', $data, $where);
    }

    public function hapusMeja($where = null)
    {
        $this->db->delete('meja', $where);
    }
}