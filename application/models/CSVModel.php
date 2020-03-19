<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CSVModel extends CI_Model {

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
	public function GPINOYInsert($memData)
	{
		$gpinoyserv = $this->load->database('gpinoyserv', TRUE);

		$gpinoyserv->insert('gsatdigital.cards', $memData);
	}

	public function GSATInsert($memData)
	{
		$gsatserv = $this->load->database('gsatserv', TRUE);

		$gsatserv->insert('gsatdigital.cards', $memData);
	}

	public function CSVSelect()
	{
		/*$gsatserv = $this->load->database('gsatserv', TRUE);

		$gsatserv->order_by('id', 'DESC');
		$query = $gsatserv->get('gsatdigital.cards');
		return $query;*/
	}
}
