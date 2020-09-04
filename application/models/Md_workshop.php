<?php 
/**
* 
*/
class Md_workshop extends CI_Model	{

public $table = 'workshop';

	function getDataById($id){ 
		$query = $this->db->get_where($this->table, array('id_workshop' => $id));
		return $query->row();
	}

	function updateWorkshop($data, $id)
    {
        $this->db->where('id_workshop', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
	
	function addWorkshop($data){
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }
    
    function getAllData()
	{
		$query = $this->db->get($this->table);
		return $query->result();
    }
    
    function getNamaWorkshop($id)
    {
        $this->db->where('id_workshop', $id);
        $query = $this->db->get($this->table);

        $out = '';
        foreach ($query->result() as $row) {
            $out .= $row->harga_jual;
        }
        return $out;
    }

    function getAllDataTables()
    {
        return $this->datatables
            ->select('ws.id_workshop, ws.name, ws.cover_workshop, ws.description')
            ->from($this->table . ' ws')
            ->generate();
    }
	
	function deleteWorkshop($id)
    {
        $this->db->delete($this->table, array('id_workshop' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    
}
 ?>