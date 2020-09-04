<?php

/**
 * 
 */
class Md_user extends CI_Model
{

	public $table = 'admin';

	function cek_login($where)
	{
		return $this->db->get_where($this->table, $where);
	}

	function getDataById($id)
	{
		$query = $this->db->get_where($this->table, array('username' => $id));
		return $query->row();
	}

	function updateUser($data, $id)
	{
		$this->db->where('username', $id);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}

	function addUser($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
	}

	function getAllDataTables()
	{
		return $this->datatables
			->select('usr.username, usr.name, usr.password')
			->from($this->table . ' usr')
			->generate();
	}

	function deleteUser($id)
	{
		$this->db->delete($this->table, array('username' => $id));
		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}
}
