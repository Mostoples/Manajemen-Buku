<?php

class Book_model extends CI_Model {

	// method untuk menampilkan data buku
	public function showBook($id = false){
		// membaca semua data buku dari tabel 'books'
		if ($id == false){
			$query = $this->db->get('books');
			return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$query = $this->db->get_where('books', array("idbuku" => $id));
			return $query->row_array();
		}
	}

	// method untuk hapus data buku berdasarkan id
	public function delBook($id){
		$this->db->delete('books', array("idbuku" => $id));
	}

	// method untuk mencari data buku berdasarkan key
	public function findBook($key){

		$query = $this->db->query("SELECT * FROM books WHERE judul LIKE '%$key%' 
									OR pengarang LIKE '%$key%' 
									OR penerbit LIKE '%$key%'
									OR sinopsis LIKE '%$key%'
									OR thnterbit LIKE '%$key%'");
		return $query->result_array();
	}

	// method untuk insert data buku ke tabel 'books'
	public function insert($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename){
		$data = array(
					"judul" => $judul,
					"pengarang" => $pengarang,
					"penerbit" => $penerbit,
					"sinopsis" => $sinopsis,
					"idkategori" => $idkategori,
					"thnterbit" => $thnterbit,
					"imgfile" => $filename
		);
		$query = $this->db->insert('books', $data);
	}

	// method untuk membaca data kategori buku dari tabel 'kategori'
	public function getKategori(){
		$query = $this->db->get('kategori');
		return $query->result_array();
	}

	// method untuk menghitung jumlah buku berdasarkan idkategori
	public function countByCat($kategori){
		$i = 0;
		foreach($kategori as $cat_item){
			$idkategori = $cat_item['idkategori'];
			$query = $this->db->query("SELECT count(*) as jum FROM books WHERE idkategori = '$idkategori'");
			$cat2['idkategori'] = $cat_item['idkategori'];
			$cat2['kategori'] = $cat_item['kategori'];
			$cat2['jum'] = $query->row()->jum;
			$cate[$i] = $cat2;
			$i++;
		}

		
		return $cate;
	}

	public function getDetail($idbuku){
		$this->db->where('idbuku',$idbuku);
		$query = $this->db->get('books');
		return $query->result_array();
	}

	public function edit($idbuku, $judul, $pengarang, $penerbit, $idkategori, $imgfile, $sinopsis, $thnterbit){
			
			$this->db->set('judul', $judul);
			$this->db->set('pengarang', $pengarang);
			$this->db->set('penerbit', $penerbit);
			$this->db->set('idkategori', $idkategori);
			$this->db->set('imgfile', $imgfile);
			$this->db->set('sinopsis', $sinopsis);
			$this->db->set('thnterbit', $thnterbit);
			$this->db->where('idbuku', $idbuku);
			$this->db->update('books');

			redirect('dashboard/books');
	}


	function get_books_list($limit, $start){
        $query = $this->db->get('books', $limit, $start);
        return $query->result_array();
    }

}
?>