<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
		if($this->session->userdata('admin'))
		{
			$this->load->view('administrator/navbar');
			$this->load->view('administrator/manageusers');
		}
		else
		{
			redirect('Login');
		}
	}

	public function AddNewUser()
	{
		$this->load->model('UsersModel');

		$this->form_validation->set_rules('fullname', 'fullname', 'required');
		$this->form_validation->set_rules('username', 'username', 'required|alpha_dash|max_length[16]');
		$this->form_validation->set_rules('password', 'password', 'required|max_length[16]');
		$this->form_validation->set_rules('confirmpassword', 'confirmpassword', 'required|matches[password]|max_length[16]');
		$this->form_validation->set_rules('userrole', 'userrole', 'required');

		if($this->form_validation->run() == TRUE)
		{
			$hashpassword = $this->hash_password($this->input->post('password'));
			$hashconfirmpass = $this->hash_password($this->input->post('confirmpassword'));

			$newuser = array(
				'fullname'	=> $this->input->post('fullname'),
				'username'	=> $this->input->post('username'),
				'password'	=> $hashpassword,
				'userrole'	=> $this->input->post('userrole')
			);

			$this->UsersModel->AddNewUser($newuser);

			$this->session->set_flashdata('AddSuccess', 'User has been added successfully.');
			redirect('Users');
		}
		else
		{
			$this->session->set_flashdata('FieldError', validation_errors());
			redirect('Users');
		}
	}

	public function RemoveUser($loginid)
	{
		$this->load->model('UsersModel');
		$this->UsersModel->RemoveUser($loginid);

		$this->session->set_flashdata('RemoveSuccess', 'User has been successfully removed.');
		redirect('Users', 'refresh');
	}
}
