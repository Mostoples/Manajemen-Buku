<?php

class Book extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
		$this->load->database();
		$this->load->library('pagination');
	}

	public function viewDetail($idbuku,$state){
            $this->load->model('book_model');
            $this->load->model('kategori_model');

			$data['kategori'] = $this->kategori_model->showKategori();
            $data['book'] = $this->book_model->getDetail($idbuku);
            $data['idbuku'] = $idbuku;
            $data['fullname'] = $_SESSION['fullname'];
            $_SESSION['states'] = $state;

            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/detail', $data);
            $this->load->view('dashboard/footer', $data);
    }


	// method hapus data buku berdasarkan id
	public function delete($id){
		$this->book_model->delBook($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

	// method untuk tambah data buku
	public function insert(){
		
        $nextIndex = $this->db->count_all('books') + 1;
		// target direktori fileupload
		if(isset($_FILES["imgcover"])){
			$target_dir = "assets/images/";
			$filename = $_FILES["imgcover"]["name"];
			$ext = end((explode(".", $filename))); 
			$filename = $nextIndex.".".$ext;
			$target_file = $target_dir . basename($filename);
			move_uploaded_file($_FILES["imgcover"]["tmp_name"], $target_file);
		}
		
		// baca data dari form insert buku
		$judul = $_POST['judul'];
		$pengarang = $_POST['pengarang'];
		$penerbit = $_POST['penerbit'];
		$sinopsis = $_POST['sinopsis'];
		$thnterbit = $_POST['thnterbit'];
		$idkategori = $_POST['idkategori'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->book_model->insert($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
		
	}

	// method untuk edit data buku berdasarkan id
	public function edit(){
		$filename = "";
		if($_FILES['image']['error'] > 0){
			$filename = $_POST['image2'];
			echo $filename;
		}else {
			$target_dir = "assets/images/";
			$filename = str_replace("-","_", $_FILES["image"]["name"]);
			$target_file = $target_dir . basename($filename);
			move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
		}

		
		$idbuku = $_POST['idbuku'];
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        $idkategori = $_POST['idkategori'];
        $imgfile = $filename;
        $sinopsis = $_POST['sinopsis'];
        $thnterbit = $_POST['thnterbit'];

        $this->book_model->edit($idbuku, $judul, $pengarang, $penerbit, $idkategori, $imgfile, $sinopsis, $thnterbit);	
			
			

				
    	

	}

	// method untuk mencari data buku berdasarkan 'key'
	public function findbooks($pageCat = 5){
		
			// baca key dari form cari data
			$key = "";
			if(isset($_POST['key'])){
				$key = $_POST['key'];
				$_SESSION['key'] = $key;
			}else{
				$key = $_SESSION['key'];
			}

			$data['keya'] = $key;

			

			$this->load->database();
           	$this->load->model('kategori_model');

           	$datasemen = $this->book_model->findBook($key);

           	$data['pageCat'] = $pageCat;

            $data['kategori'] = $this->book_model->getKategori();
        	
        	$data['countCat'] = $this->book_model->countByCat($data['kategori']);

           	$jumlahBuku = 0;
            foreach($data['countCat'] as $countCat){
                $jumlahBuku += $countCat['jum'];
                
            }

            $data['jumlahBuku'] = $jumlahBuku;
        	$data['fullname'] = $_SESSION['fullname'];
            
            $config['base_url'] = site_url('book/findbooks'); //site url
            $config['total_rows'] = count($datasemen); //total row
            $config['per_page'] = 5;  //show record per halaman
            $config["uri_segment"] = 3;  // uri parameter
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);
 
            // Membuat Style pagination untuk BootStrap v4
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
            $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close']    = '</span></li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close']  = '</span>Next</li>';
            $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close']  = '</span></li>';
 
            $this->pagination->initialize($config);

            $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data['data'] = array_slice($datasemen, $data['page'], $config["per_page"]);
 
                   
 
            $data['pagination'] = $this->pagination->create_links();

			// panggil method findBook() dari model book_model untuk menjalankan query cari data
			

			// tampilkan hasil pencarian di view 'dashboard/books'
			$this->load->view('dashboard/header',$data);
        	$this->load->view('dashboard/books', $data);
        	$this->load->view('dashboard/footer',$data);
	}

}
?>