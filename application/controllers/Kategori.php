<?php
class Kategori extends CI_Controller {

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

	public function insert(){
		if($_SESSION['role'] == 'admin'){
		
		$this->load->model('kategori_model');
		$kategori = $_POST['newKategori'];
		$this->kategori_model->insertKategori($kategori);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('kategori');
		}else {
    	redirect('dashboard/forbid');
    	}

	}

	public function index(){
		if($_SESSION['role'] == 'admin'){


		$this->load->database();
		$this->load->model('kategori_model');
        $config['base_url'] = site_url('kategori/index'); //site url
        $config['total_rows'] = $this->db->count_all('kategori'); //total row
        $config['per_page'] = 10;  //show record per halaman
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


		
		$data['kategori'] = $this->kategori_model->showKategori();


		$data['fullname'] = $_SESSION['fullname'];

		$this->load->view('dashboard/header', $data);
        $this->load->view('kategori/index', $data);
        $this->load->view('dashboard/footer', $data);
    }else {
    	redirect('dashboard/forbid');
    }
	}

	public function delete($id){
		if($_SESSION['role'] == 'admin'){
		$this->load->model('kategori_model');
		$this->kategori_model->delKategori($id);
		
		redirect('kategori');
		}else {
    	redirect('dashboard/forbid');
    }
	}

	public function edit($id){
		if($_SESSION['role'] == 'admin'){
		$newName = $_POST['modifiedKategori'];
		$this->load->model('kategori_model');
		$this->kategori_model->edit($id,$newName);
		}else {
    	redirect('dashboard/forbid');
    }
	}


	

}
?>