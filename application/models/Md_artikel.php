<?php 
/**
* 
*/
class Md_artikel extends CI_Model	{

public $table = 'artikel';

	function getDataById($id){ 
        $this->db->select('ar.*, ak.name');
        $this->db->join('artikelKind ak', 'ak.id_artikelKind = ar.id_artikelKind');
        $this->db->where('ar.id_artikel', $id);
        $this->db->from($this->table . ' ar');
        return $this->db->get()->row();
	}

    function getDataByTopPage($id){ 
        $this->db->select('ar.*, ak.name');
        $this->db->join('artikelKind ak', 'ak.id_artikelKind = ar.id_artikelKind');
        $this->db->where('ar.top_page', $id);
        $this->db->from($this->table . ' ar');
        return $this->db->get()->row();
    }

    function updateArtikelTo0($data, $id)
    {
        $this->db->where('top_page', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

	function updateArtikel($data, $id)
    {
        $this->db->where('id_artikel', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
	
	function addArtikel($data){
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }
    
    function getAllData()
	{
		$query = $this->db->get($this->table);
		return $query->result();
    }

    function getAllArtikel($limit='', $start='')
    {
        $this->db->select('ar.*, ak.name');
        $this->db->join('artikelKind ak', 'ak.id_artikelKind = ar.id_artikelKind');
        $this->db->order_by('ar.date', 'desc');
        if ($limit) {
        $this->db->limit($limit, $start);
        }
        $this->db->from($this->table . ' ar');
        return $this->db->get()->result();
    }

    function getAllData_Limit($param1){
        $this->db->select('ar.*, ak.name');
        $this->db->join('artikelKind ak', 'ak.id_artikelKind = ar.id_artikelKind');
        $this->db->order_by('rand()');
        $this->db->limit($param1);
        $this->db->from($this->table . ' ar');
        return $this->db->get()->result_array();
    }
    
    function getAllDataTables()
    {
        return $this->datatables
            ->select('ar.id_artikel,ak.name , ar.title, ar.write_by, ar.content, ar.date,  ar.cover_artikel,ar.top_page')
            ->join('artikelKind ak', 'ak.id_artikelKind = ar.id_artikelKind')
            ->from($this->table . ' ar')
            ->generate();
	}
	
	function deleteArtikel($id)
    {
        $this->db->delete($this->table, array('id_artikel' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    
}
 ?>