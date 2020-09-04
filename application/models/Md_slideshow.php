<?php 
/**
* 
*/
class Md_slideshow extends CI_Model	{

public $table = 'slideshow';

	function getDataById($id){ 
		$query = $this->db->get_where($this->table, array('id_slideshow' => $id));
		return $query->row();
    }
    function getDataByIdAr($id){ 
		$query = $this->db->get_where($this->table, array('id_artikel' => $id));
		return $query->row();
	}

	function updateSlideshow($data, $id)
    {
        $this->db->where('id_slideshow', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
	
	function addSlideshow($data){
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
            ->select('ss.id_slideshow, ss.id_artikel, ss.title, ss.description, ss.cover_slideshow')
            ->from($this->table . ' ss')
            ->generate();
    }
	
	function deleteSlideshow($id)
    {
        $this->db->delete($this->table, array('id_slideshow' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function deleteSlideshow_idArtikel($id)
    {
        $this->db->delete($this->table, array('id_artikel' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    
}
 ?>