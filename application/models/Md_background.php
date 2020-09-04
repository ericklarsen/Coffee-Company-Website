<?php 
/**
* 
*/
class Md_background extends CI_Model	{

public $table = 'background';

	function getDataById($id){ 
		$query = $this->db->get_where($this->table, array('id_background' => $id));
		return $query->row();
	}

	function updateBackground($data, $id)
    {
        $this->db->where('id_background', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
	
	function addBackground($data){
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
            ->select('bg.id_background, bg.name, bg.cover_background')
            ->from($this->table . ' bg')
            ->generate();
    }
	
	function deleteBackground($id)
    {
        $this->db->delete($this->table, array('id_background' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function deleteBackground_idArtikel($id)
    {
        $this->db->delete($this->table, array('id_artikel' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    
}
 ?>