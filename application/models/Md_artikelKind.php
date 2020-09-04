<?php 
/**
* 
*/
class Md_artikelKind extends CI_Model	{

public $table = 'artikelKind';

	function getDataById($id){ 
		$query = $this->db->get_where($this->table, array('id_artikelKind' => $id));
		return $query->row();
	}

	function updateArtikelKind($data, $id)
    {
        $this->db->where('id_artikelKind', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
	
	function addArtikelKind($data){
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
            ->select('ak.id_artikelKind , ak.name')
            ->from($this->table . ' ak')
            ->generate();
	}
	
	function deleteArtikelKind($id)
    {
        $this->db->delete($this->table, array('id_artikelKind' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    
}
 ?>