<?php 
/**
* 
*/
class Md_item extends CI_Model	{

public $table = 'item';
public $table2 = 'itemPhoto';

	function getDataById($id){ 
        $this->db->select('it.*, ik.name');
        $this->db->join('itemKind ik', 'ik.id_itemKind = it.id_itemKind');
        $this->db->where('it.id_item', $id);
        $this->db->from($this->table . ' it');
        return $this->db->get()->row();
	}

	function updateItem($data, $id)
    {
        $this->db->where('id_item', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
	
	function addItem($data){
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }
    
    function getAllData()
	{
		$this->db->select('it.*, ik.name');
        $this->db->join('itemKind ik', 'ik.id_itemKind = it.id_itemKind');
        $this->db->from($this->table . ' it');
        return $this->db->get()->result();
    }

    function getAllItem($limit='', $start='')
    {
        $this->db->select('it.*, ik.name');
        $this->db->join('itemKind ik', 'ik.id_itemKind = it.id_itemKind');
        $this->db->order_by('it.tanggal', 'desc');
        if ($limit) {
        $this->db->limit($limit, $start);
        }
        $this->db->from($this->table . ' it');
        return $this->db->get()->result();
    }

    function getAllItem_filter($where='',$limit='', $start='')
    {
        $this->db->select('it.*, ik.name');
        $this->db->join('itemKind ik', 'ik.id_itemKind = it.id_itemKind');
        $this->db->order_by('it.tanggal', 'desc');
        if ($limit) {
        $this->db->limit($limit, $start);
        }
        $this->db->where('it.id_itemKind', $where);
        $this->db->from($this->table . ' it');
        return $this->db->get()->result();
    }


    function getAllData_Limit($param1){
        $this->db->select('it.*, ik.name');
        $this->db->join('itemKind ik', 'ik.id_itemKind = it.id_itemKind');
        $this->db->order_by('rand()');
        $this->db->limit($param1);
        $this->db->order_by('it.id_item', 'DESC');
        $this->db->from($this->table . ' it');
        return $this->db->get()->result();
    }
    
    function getNamaItem($id)
    {
        $this->db->where('id_item', $id);
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
            ->select('it.id_item,ik.name , it.name_item, it.price_item, it.disc_item, it.desc_item, it.stock_item, it.cover_item, it.weight_item')
            ->join('itemKind ik', 'ik.id_itemKind = it.id_itemKind')
            ->from($this->table . ' it')
            ->generate();
	}
	
	function deleteItem($id)
    {
        $this->db->delete($this->table, array('id_item' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function addItemPhotoBatch($data){
        $this->db->insert_batch($this->table2, $data);
    }

    function deleteItemPhoto($id)
    {
        $this->db->delete($this->table2, array('id_item' => $id));
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function getPhotoById($id){ 
        $this->db->select('*');
        $this->db->where('id_item', $id);
        $this->db->from($this->table2);
        return $this->db->get()->result();
	}
    
}
 ?>