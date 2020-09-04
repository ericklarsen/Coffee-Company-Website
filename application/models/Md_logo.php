<?php

/**
 * 
 */
class Md_logo extends CI_Model
{

	public $table = 'logo';

	function cek_login($where)
	{
		return $this->db->get_where($this->table, $where);
	}

	function getDataById()
	{
		$query = $this->db->get_where($this->table, array('id_logo' => '1'));
		return $query->row();
	}

	function updateLogo($data, $id)
	{
		$this->db->where('id_logo', $id);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}

	function addLogo($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
	}

	function deleteLogo($id)
	{
		$this->db->delete($this->table, array('id_logo' => $id));
		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}
}
