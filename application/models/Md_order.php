<?php

/**
 * 
 */
class Md_order extends CI_Model
{

    public $table = 'order_form';
    public $table2 = 'order_detail';
    public $table3 = 'order_item';

    function getDataById($id)
    {
        $this->db->select('or.*, od.*');
        $this->db->join('order_detail od', 'or.id_order_detail = od.id_order_detail');
        $this->db->where('or.id_order_form', $id);
        $this->db->from($this->table . ' or');
        return $this->db->get()->row();
    }

    function getDataById_another($id)
    {
        $this->db->select('ora.*, it.name_item');
        $this->db->join('item it', 'ora.id_item = it.id_item');
        $this->db->where('ora.id_order_item', $id);
        $this->db->from($this->table3 . ' ora');
        return $this->db->get()->row();
    }

    function updateOrder($data, $id)
    {
        $this->db->where('id_order_form', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function updateOrder_Another($data, $id)
    {
        $this->db->where('id_order_item', $id);
        $this->db->update($this->table3, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function addOrder($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    function addOrderItem($data)
    {
        $this->db->insert($this->table3, $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    function addOrderDetail($data)
    {
        $this->db->insert($this->table2, $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    function getAllData()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function getAllDataDetail()
    {
        $query = $this->db->get($this->table2);
        return $query->result();
    }

    function getAllDataTables()
    {
        return $this->datatables
            ->select('or.id_order_form, or.id_order_detail,or.nama_pengirim, or.nama_pemesan, or.tanggal, or.status,or.opsiPesanan')
            ->from($this->table . ' or')
            ->generate();
    }

    function getAllDataTables2()
    {
        return $this->datatables
            ->select('ora.id_order_item, ora.nama_pemesan, ora.nama_pengirim, ora.telp, ora.tanggal, ora.status, it.name_item,ora.opsiPesanan')
            ->join('item it', 'ora.id_item = it.id_item')
            ->from($this->table3 . ' ora')
            ->generate();
    }

    function deleteOrder($id)
    {
        $this->db->delete($this->table, array('id_order_form' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    function deleteOrderAnother($id)
    {
        $this->db->delete($this->table3, array('id_order_item' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function deleteOrderDetail($id)
    {
        $this->db->delete($this->table, array('id_order_form' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
}
