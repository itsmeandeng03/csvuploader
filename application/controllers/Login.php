<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	private function hash_password($password)
	{
		return password_hash($password, PASSWORD_BCRYPT);
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function LoginUser()
	{
		$this->load->model('LoginModel');

		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		if($this->form_validation->run() == TRUE)
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$userdata = $this->LoginModel->UserLogin($username, $password);

			if($userdata['userrole'] == 'Administrator')
			{
				$this->session->set_userdata('admin', $userdata['fullname']);
				redirect('CSVFileUpload/GPINOYView');
			}
			elseif($userdata['userrole'] == 'User')
			{
				$this->session->set_userdata('user', $userdata['fullname']);
				redirect('CSVFileUpload/GPINOYView');
			}
			else
			{
				redirect('Login');
			}
		}
		else
		{
			$this->session->set_flashdata('ErrorLogin', validation_errors());
			redirect('login');
		}
	}

	public function LogoutUser()
	{
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('admin');
		$this->session->sess_destroy();

		redirect('Login');
	}
}
