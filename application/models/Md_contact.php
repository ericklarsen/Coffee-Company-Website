<?php

/**
 * 
 */
class Md_contact extends CI_Model
{

    public $table = 'contact';

    function getDataById($id)
    {
        $query = $this->db->get_where($this->table, array('id_contact' => $id));
        return $query->row();
    }

    function updateContact($data, $id)
    {
        $this->db->where('id_contact', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function addContact($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    function getAllDataTables()
    {
        return $this->datatables
            ->select('ct.id_contact, ct.first_name, ct.last_name, ct.email, ct.phone, ct.message, ct.tanggal')
            ->from($this->table . ' ct')
            ->generate();
    }

    function deleteContact($id)
    {
        $this->db->delete($this->table, array('id_contact' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
}
