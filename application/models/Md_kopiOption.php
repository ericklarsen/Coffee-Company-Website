<?php

/**
 * 
 */
class Md_kopiOption extends CI_Model
{

    public $table = 'kopiOption';

    function getDataById($id)
    {
        $this->db->select('it.*, ik.title');
        $this->db->join('artikel ik', 'ik.id_artikel = it.id_artikel');
        $this->db->where('it.id_kopiOption', $id);
        $this->db->from($this->table . ' it');
        return $this->db->get()->row();
    }
    function getDataByIdAr($id)
    {
        $query = $this->db->get_where($this->table, array('id_artikel' => $id));
        return $query->row();
    }
    function getDataByOption($id)
    {
        $this->db->select('*');
        $this->db->where('option', $id);
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function updateKopiOption($data, $id)
    {
        $this->db->where('id_kopiOption', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function addKopiOption($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    function getAllData()
    {
        $this->db->select('it.*');
        $this->db->from($this->table . ' it');
        return $this->db->get()->result();
    }

    function getAllDataTables()
    {
        return $this->datatables
            ->select('it.id_kopiOption, ik.title , it.name, it.option, it.description')
            ->join('artikel ik', 'ik.id_artikel = it.id_artikel')
            ->from($this->table . ' it')
            ->generate();
    }

    function deleteKopiOption($id)
    {
        $this->db->delete($this->table, array('id_kopiOption' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
}
