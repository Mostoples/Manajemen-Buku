<?php

class User_model extends CI_Model {

	// method untuk membaca data profile user
	public function getUserProfile($username){
		$query = $this->db->get_where('users', array('username' => $username));
		return $query->row_array();
	}

	public function showUser(){
		
		
		$query = $this->db->get('users');
		return $query->result_array();
		
	}


	public function delete($username){
		$this->db->delete('users', array("username" => $username));
	}

	
	public function insert($username,$password,$fullname,$role){
		$data = array(
					"username" => $username,
					"password" => $password,
					"fullname" => $fullname,
					"role" => $role
		);
		$query = $this->db->insert('users', $data);
	}

	public function edit($nUsername,$nPassword,$nFullname,$nRole,$oUsername){
			
			$this->db->set('username', $nUsername);
			$this->db->set('password', $nPassword);
			$this->db->set('fullname', $nFullname);
			$this->db->set('role', $nRole);
			$this->db->where('username', $oUsername);
			$this->db->update('users');
			redirect('user');
	}
}

?>