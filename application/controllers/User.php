<?php
class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}

	public function insert(){
		if($_SESSION['role'] == 'admin'){
		
		$this->load->model('user_model');
		$username = $_POST['username'];
		$password = $_POST['password'];
		$fullname = $_POST['fullname'];
		$role= $_POST['role'];

		$this->user_model->insert($username,$password,$fullname,$role);
		redirect('user');
		}else {
    	redirect('dashboard/forbid');
    }
	}

	public function index(){
		if($_SESSION['role'] == 'admin'){
		$this->load->model('user_model');
		$data['user'] = $this->user_model->showUser();


		$data['fullname'] = $_SESSION['fullname'];

		$this->load->view('dashboard/header', $data);
        $this->load->view('user/index');
        $this->load->view('dashboard/footer', $data);
        }else {
    	redirect('dashboard/forbid');
    }
	}

	public function delete($id){
		if($_SESSION['role'] == 'admin'){
		$this->load->model('user_model');
		$this->user_model->delete($id);
		
		redirect('user');
		}else {
    	redirect('dashboard/forbid');
    }
	}

	public function edit($nUsername,$nPassword,$nFullname,$nRole,$oUsername){
		if($_SESSION['role'] == 'admin'){
		$newUsername = str_replace('%20', ' ', $nUsername);
		$newPassword = str_replace('%20', ' ', $nPassword);
		$newFullname = str_replace('%20', ' ', $nFullname);
		$newRole = str_replace('%20', ' ', $nRole);
		$oldUsername = str_replace('%20', ' ', $oUsername);

		$this->load->model('user_model');
		$data['user'] = $this->user_model->edit($newUsername,$newPassword,$newFullname,$newRole,$oldUsername);

		}else {
    	redirect('dashboard/forbid');
    }
	}


	

}
?>