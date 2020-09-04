<?php 
/**
* 
*/
class Md_itemHighlight extends CI_Model	{

public $table = 'itemHighlight';

	function getDataById($id){ 
		$query = $this->db->get_where($this->table, array('id_itemHighlight' => $id));
		return $query->row();
	}

	function updateItemHighlight($data, $id)
    {
        $this->db->where('id_itemHighlight', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
	
	function addItemHighlight($data){
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }
    
    function getAllData()
	{
		$this->db->select('ih.*, it.*');
        $this->db->join('item it', 'it.id_item = ih.id_item');
        $this->db->from($this->table . ' ih');
        return $this->db->get()->result();
    }
    
    function getNamaItemHighlight($id)
    {
        $this->db->where('id_itemHighlight', $id);
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
            ->select('ws.id_itemHighlight, it.name_item, ws.type')
            ->join('item it', 'it.id_item = ws.id_item')
            ->from($this->table . ' ws')
            ->generate();
    }
	
	function deleteItemHighlight($id)
    {
        $this->db->delete($this->table, array('id_itemHighlight' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    
}
 ?>