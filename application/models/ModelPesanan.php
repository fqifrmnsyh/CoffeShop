<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ModelPesanan extends CI_Model
{
    public function getData($table)
    {
        return $this->db->get($table)->row();
    }
    public function getDataPesananDetail($table)
    {
        return $this->db->get($table)->row();
    }

    public function getDataWhere($table, $where)
    {
        $this->db->where($where);
        return $this->db->get($table);
    }

    public function getOrderByLimit($table, $order, $limit)
    {
        $this->db->order_by($order, 'desc');
        $this->db->limit($limit);
        return $this->db->get($table);
    }

    public function joinOrder($where)
    {
        $this->db->select('*');
        $this->db->from('pesanan pes');
        $this->db->join('pesanan_detail d', 'd.id_pesanan=pes.id_pesanan');
        $this->db->join('produk p ', 'p.id=d.id_produk');
        $this->db->where($where);

        return $this->db->get();
    }

    public function simpanDetail($where = null)
    {
        $sql = "INSERT INTO pesanan_detail (id_pesanan,id_produk) SELECT pesanan.id_pesanan,temp.id_produk FROM pesanan, temp WHERE temp.id_user=pesanan.id_user AND pesanan.id_user='$where'";
        //$sql = "INSERT INTO pesanan_detail (id_pesanan,id_produk) SELECT pesanan.id_pesanan,temp.id_produk FROM pesanan, temp WHERE temp.id_user=pesanan.id_user AND pesanan.id_user='$where'";
        $this->db->query($sql);
    }

    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function updateData($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }

    public function deleteData($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function deleteOrder($id_produk)
    {
        $this->db->where('id_produk', $id_produk);
        $this->db->delete('temp');
    }

    public function find($where)
    {
        //Query mencari record berdasarkan ID-nya
        $this->db->limit(1);
        return $this->db->get('produk', $where);
    }

    public function kosongkanData($table)
    {
        return $this->db->truncate($table);
    }

    public function createTemp()
    {
        $this->db->query('CREATE TABLE IF NOT EXISTS temp(id_pesanan varchar(12), tgl_pesan DATETIME, email_user varchar(128), id_produk int)');
        //$this->db->query('CREATE TABLE IF NOT EXISTS temp(id_pesanan varchar(12), tgl_pesanan DATETIME, email_user varchar(128), id_produk int)');
    }

    public function createBookTemp()
    {
        $this->db->query('CREATE TABLE IF NOT EXISTS pesanan_temp(id_pesanan varchar(12), tgl_pesan DATETIME, email_user varchar(128), id_produk int)');
        //$this->db->query('CREATE TABLE IF NOT EXISTS temp(id_pesanan varchar(12), tgl_pesanan DATETIME, email_user varchar(128), id_produk int)');
    }

    public function selectJoin()
    {
        $this->db->select('*');
        $this->db->from('pesanan');
        $this->db->join('pesanan_detail', 'pesanan_detail.id_pesanan=pesanan.id_pesanan');
        $this->db->join('produk', 'pesanan_detail.id_produk=produk.id');
        return $this->db->get();
    }

    public function showtemp($where)
    {
        return $this->db->get('temp', $where);
    }

    public function getPesananById($id_pesanan)
    {
        return $this->db->get_where('pesanan', ['id_pesanan' => $id_pesanan])->row_array();
    }
    public function updateStatusPesanan($id_pesanan, $status)
    {
        $this->db->set('status', $status);
        $this->db->where('id_pesanan', $id_pesanan);
        return $this->db->update('pesanan');
    }

    public function getDetailPesananById($id_detail_pesanan)
    {
        return $this->db->get_where('pesanan_detail', ['id' => $id_detail_pesanan])->row_array();
    }

    public function getDetailPesananByPesananId($id_pesanan)
    {
        $this->db->where('id_pesanan', $id_pesanan);
        $query = $this->db->get('pesanan_detail');
        return $query->result_array();
    }



    public function updateStatusDetailPesanan($id_detail_pesanan, $status)
    {
        $this->db->where('id', $id_detail_pesanan);
        return $this->db->update('pesanan_detail', ['status' => $status]);
    }

    public function total()
    {
        $this->db->where('status', 'complete');
        $this->db->from('pesanan');
        return $this->db->count_all_results();
    }

    public function getAllOrders()
    {
        return $this->db->get('pesanan');
    }

    public function getCompletedOrders() {
        $this->db->where('status', 'Complete');
        return $this->db->get('pesanan')->result_array();
    }

}
