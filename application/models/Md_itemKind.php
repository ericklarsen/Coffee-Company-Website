<?php 
/**
* 
*/
class Md_itemKind extends CI_Model	{

public $table = 'itemKind';

	function getDataById($id){ 
		$query = $this->db->get_where($this->table, array('id_itemKind' => $id));
		return $query->row();
	}

	function updateItemKind($data, $id)
    {
        $this->db->where('id_itemKind', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
	
	function addItemKind($data){
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }
    
    function getAllData()
	{
		$query = $this->db->get($this->table);
		return $query->result();
    }
    

    function getAllDataTables()
    {
        return $this->datatables
            ->select('it.id_itemKind , it.name')
            ->from($this->table . ' it')
            ->generate();
	}
	
	function deleteItemKind($id)
    {
        $this->db->delete($this->table, array('id_itemKind' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    
}
 ?>