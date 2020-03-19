<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CSVFileUpload extends CI_Controller {

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
	function __construct()
	{
		parent::__construct();
		$this->load->model('CSVModel');
	}

	public function index()
	{
		if($this->session->userdata('admin'))
		{
			$this->load->view('administrator/navbar');

			if($this->session->flashdata('ImportSuccess'))
			{
				echo "<div class = 'alert alert-success alert-dismissible'>
					<button class = 'close' data-dismiss = 'alert' aria-label = 'close'> &times; </button>
					<strong>" . $this->session->flashdata('ImportSuccess') . "</strong>
				</div>";
			}
		}
		elseif($this->session->userdata('user'))
		{
			$this->load->view('user/navbar');

			if($this->session->flashdata('ImportSuccess'))
			{
				echo "<div class = 'alert alert-success alert-dismissible'>
					<button class = 'close' data-dismiss = 'alert' aria-label = 'close'> &times; </button>
					<strong>" . $this->session->flashdata('ImportSuccess') . "</strong>
				</div>";
			}
		}
		else
		{
			redirect('Login');
		}
	}

	public function GPINOYView()
	{
		if($this->session->userdata('admin'))
		{
			$this->load->view('administrator/navbar');
			$this->load->view('gpinoyview/gpinoyview');
		}
		elseif($this->session->userdata('user'))
		{
			$this->load->view('user/navbar');
			$this->load->view('gpinoyview/gpinoyview');
		}
		else
		{
			redirect('Login');
		}
	}

	public function GSATView()
	{
		if($this->session->userdata('admin'))
		{
			$this->load->view('administrator/navbar');
			$this->load->view('gsatview/gsatview');
		}
		elseif($this->session->userdata('user'))
		{
			$this->load->view('user/navbar');
			$this->load->view('gsatview/gsatview');
		}
		else
		{
			redirect('Login');
		}
	}

	public function GPINOYImport()
	{
		$this->load->library('CSVReader');

		$data = array();
		$memData = array();

		//IF FILE IS UPLOADED
		if(is_uploaded_file($_FILES['csvfile']['tmp_name']))
		{
			//PARSE DATA FROM CSV FILE
			$csvdata = $this->csvreader->parse_csv($_FILES['csvfile']['tmp_name']);

			//INSERT CSV DATA INTO DATABASE
			if(!empty($csvdata))
			{
				//print_r($csvdata);

				foreach($csvdata as $key => $row)
				{
					//PREPARE DATA FOR DB INSERTION
					$memData = array(
						'securitycode'	=> $row['securitycode'],
						'dealer_id'		=> $this->input->post('dealer'),
						'cardnum'		=> $row['cardnum']
					);

					$this->CSVModel->GPINOYInsert($memData);
				}

				$this->session->set_flashdata('ImportSuccess', 'File has been imported successfully.');
				redirect('CSVFileUpload', 'refresh');
			}
			else
			{
				echo "File is empty";
			}
		}
	}

	public function GSATImport()
	{
		$this->load->library('CSVReader');

		$data = array();
		$memData = array();

		//IF FILE IS UPLOADED
		if(is_uploaded_file($_FILES['csvfile']['tmp_name']))
		{
			//PARSE DATA FROM CSV FILE
			$csvdata = $this->csvreader->parse_csv($_FILES['csvfile']['tmp_name']);

			//INSERT CSV DATA INTO DATABASE
			if(!empty($csvdata))
			{
				//print_r($csvdata);

				foreach($csvdata as $key => $row)
				{
					//PREPARE DATA FOR DB INSERTION
					$memData = array(
						'securitycode'	=> $row['securitycode'],
						'dealer_id'		=> $this->input->post('dealer'),
						'cardnum'		=> $row['cardnum']
					);

					$this->CSVModel->GSATInsert($memData);
				}

				$this->session->set_flashdata('ImportSuccess', 'File has been imported successfully.');
				redirect('CSVFileUpload', 'refresh');

			}
			else
			{
				echo "File is empty";
			}
		}
	}
}
