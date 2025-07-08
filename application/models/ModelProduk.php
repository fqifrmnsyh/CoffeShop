<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelProduk extends CI_Model
{
    //manajemen produk
    public function getProduk()
    {
        return $this->db->get('produk');
    }

    public function get_produk_by_kategori_id($id_kategori) {
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->join('kategori', 'produk.id_kategori = kategori.id');
        $this->db->where('produk.id_kategori', $id_kategori);
        $this->db->order_by('produk.nama', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function produkWhere($where)
    {
        return $this->db->get_where('produk', $where);
    }

    public function simpanProduk($data = null)
    {
        $this->db->insert('produk', $data);
    }

    public function updateProduk($data = null, $where = null)
    {
        $this->db->update('produk', $data, $where);
    }

    public function hapusProduk($where = null)
    {
        $this->db->delete('produk', $where);
    }

    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if (!empty($where) && count($where) > 0) {
            $this->db->where($where);
        }
        $this->db->from('produk');
        return $this->db->get()->row($field);
    }

    //manajemen kategori
    public function getKategori()
    {
        return $this->db->get('kategori');
    }

    public function kategoriWhere($where)
    {
        return $this->db->get_where('kategori', $where);
    }

    public function simpanKategori($data = null)
    {
        $this->db->insert('kategori', $data);
    }

    public function hapusKategori($where = null)
    {
        $this->db->delete('kategori', $where);
    }

    public function updateKategori($where = null, $data = null)
    {
        $this->db->update('kategori', $data, $where);
    }

    //join
    public function joinKategoriProduk($where)
    {
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id = produk.id_kategori');
        $this->db->where($where);
        return $this->db->get();
    }
    public function getLimitProduk()
    {
        $this->db->limit(5);
        return $this->db->get('produk');
    }
}