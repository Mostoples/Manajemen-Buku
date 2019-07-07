<?php

class Kategori_model extends CI_Model {


	public function showKategori(){
		
		
		$query = $this->db->get('kategori');
		return $query->result_array();
		
	}


	public function delKategori($id){
		$this->db->delete('kategori', array("idkategori" => $id));
	}

	
	public function insertKategori($kategori){
		$data = array(
					"kategori" => $kategori
		);
		$query = $this->db->insert('kategori', $data);
	}

	public function edit($idkategori,$modifiedName){
			
			$this->db->set('kategori', $modifiedName);
			$this->db->where('idkategori', $idkategori);
			$this->db->update('kategori');
			redirect('kategori');
	}

	function get_cat_list($limit, $start){
        $query = $this->db->get('kategori', $limit, $start);
        return $query;
    }

}

?>