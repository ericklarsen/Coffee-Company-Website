<?php 
/**
* 
*/
class Md_gallery extends CI_Model	{

public $table = 'gallery';

	function getDataById($id){ 
		$query = $this->db->get_where($this->table, array('id_gallery' => $id));
		return $query->row();
	}

	function updateGallery($data, $id)
    {
        $this->db->where('id_gallery', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
	
	function addGallery($data){
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
            ->select('gl.id_gallery, gl.kind, gl.cover_gallery, gl.title, gl.description')
            ->from($this->table . ' gl')
            ->generate();
    }
	
	function deleteGallery($id)
    {
        $this->db->delete($this->table, array('id_gallery' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    
}
 ?>