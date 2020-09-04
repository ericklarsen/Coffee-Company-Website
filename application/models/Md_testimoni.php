<?php 
/**
* 
*/
class Md_testimoni extends CI_Model	{

public $table = 'testimoni';

	function getDataById($id){ 
		$query = $this->db->get_where($this->table, array('id_testimoni' => $id));
		return $query->row();
	}

	function updateTestimoni($data, $id)
    {
        $this->db->where('id_testimoni', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
	
	function addTestimoni($data){
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
            ->select('ts.id_testimoni, ts.name, ts.description')
            ->from($this->table . ' ts')
            ->generate();
    }
	
	function deleteTestimoni($id)
    {
        $this->db->delete($this->table, array('id_testimoni' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    
}
 ?>