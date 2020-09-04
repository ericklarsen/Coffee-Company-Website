<?php 
/**
* 
*/
class Md_email extends CI_Model	{

public $table = 'email';

	function getDataById($id){ 
		$query = $this->db->get_where($this->table, array('id_email' => $id));
		return $query->row();
	}

	function updateEmail($data, $id)
    {
        $this->db->where('id_email', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
	
	function addEmail($data){
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
            ->select('em.id_email, em.email, em.password, em.keterangan')
            ->from($this->table . ' em')
            ->generate();
    }
	
	function deleteEmail($id)
    {
        $this->db->delete($this->table, array('id_email' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    
}
 ?>