<?php
class Dashboard extends CI_Controller {

		public function __construct(){
			parent::__construct();

			// cek keberadaan session 'username'	
			if (!isset($_SESSION['username'])){
				// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
				redirect('login');
			}

            $this->load->library('pagination');
         
            // load URL helper
            $this->load->helper('url');
		}

		// halaman index dari dashboard -> menampilkan grafik statistik jumlah data buku berdasarkan kategori

        public function forbid(){
            $data['fullname'] = $_SESSION['fullname'];

            $this->load->view('dashboard/header', $data);
            $this->load->view('errors/index');
            $this->load->view('dashboard/footer', $data);
        }

        public function contact(){
            $data['fullname'] = $_SESSION['fullname'];
            
            $this->load->view('dashboard/header', $data);
            $this->load->view('errors/contact');
            $this->load->view('dashboard/footer', $data);
        }

        public function index($pageCat = 5){

            $this->load->database();
            $this->load->model('kategori_model');
            $config['base_url'] = site_url('dashboard/index'); //site url
            $config['total_rows'] = $this->db->count_all('kategori'); //total row
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
 
            //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
            $data['data'] = $this->kategori_model->get_cat_list($config["per_page"], $data['page']);           
 
            $data['pagination'] = $this->pagination->create_links();
 

            $data['pageCat'] = $pageCat;

            $data['kategori'] = $this->book_model->getKategori();
        	
        	$data['countCat'] = $this->book_model->countByCat($data['kategori']);
            
            $jumlahBuku = 0;
            foreach($data['countCat'] as $countCat){
                $jumlahBuku += $countCat['jum'];
                
            }
            $data['jumlahBuku'] = $jumlahBuku;
        	$data['fullname'] = $_SESSION['fullname'];

            

        	$this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/index');
            $this->load->view('dashboard/footer', $data);
        }

        

        // method untuk menambah data buku
		public function add(){
			// panggil method getKategori() di model_book untuk membaca data list kategori dari tabel kategori untuk ditampilkan ke view
			$data['kategori'] = $this->book_model->getKategori();

			// menghitung jumlah data buku per kategori untuk ditampilkan di view
			

        	// baca data session 'fullname' untuk ditampilkan di view
        	$data['fullname'] = $_SESSION['fullname'];

        	// tampilkan view 'dashboard/add'
        	$this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/add', $data);
            $this->load->view('dashboard/footer', $data);
        }

        // method untuk menampilkan seluruh data buku
        public function books(){
            $_SESSION['key'] = $key = "";
            $key = "";

            if(isset($_POST['key'])){
                $key = $_POST['key'];
                $_SESSION['key'] = $key;
            }else{
                $key = $_SESSION['key'];
            }

            $data['keya'] = $key;
            $this->load->database();
            $config['base_url'] = site_url('dashboard/books'); //site url
            $config['total_rows'] = $this->db->count_all('books'); //total row
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
 
            //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
            $data['data'] = $this->book_model->get_books_list($config["per_page"], $data['page']);           
 
            $data['pagination'] = $this->pagination->create_links();
 
            

            $data['kategori'] = $this->book_model->getKategori();
            
            $data['countCat'] = $this->book_model->countByCat($data['kategori']);
            
            
            $jumlahBuku = 0;
            foreach($data['countCat'] as $countCat){
                $jumlahBuku += $countCat['jum'];
                
            }
            $data['jumlahBuku'] = $jumlahBuku;
        	// panggil method showBook() dari book_model untuk membaca seluruh data buku
        	$data['book'] = $this->book_model->showBook();

      		

        	// baca data session 'fullname' untuk ditampilkan di view
        	$data['fullname'] = $_SESSION['fullname'];

        	// tampilkan view 'dashboard/books'
        	$this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/books', $data);
            $this->load->view('dashboard/footer', $data);
        } 



        // method untuk proses logout
        public function logout(){
        	// hapus seluruh data session
        	session_destroy();
        	// redirect ke kontroller 'login'
        	redirect('login');
        }
}