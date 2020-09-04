<?php 
/**
* 
*/
class Md_sosmed extends CI_Model	{

public $table = 'sosmed';

	function getDataById($id){ 
		$query = $this->db->get_where($this->table, array('id_sosmed' => $id));
		return $query->row();
	}

	function updateSosmed($data, $id)
    {
        $this->db->where('id_sosmed', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
	
	function addSosmed($data){
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }
    
    function getAllData()
	{
		$query = $this->db->get($this->table);
		return $query->result_array();
    }

    function getAllDataTables()
    {
        return $this->datatables
            ->select('sm.id_sosmed, sm.name, sm.link')
            ->from($this->table . ' sm')
            ->generate();
    }
	
	function deleteSosmed($id)
    {
        $this->db->delete($this->table, array('id_sosmed' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    
}
 ?>