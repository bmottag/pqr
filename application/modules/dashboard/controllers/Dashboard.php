<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
    }
	
	/**
	 * Lista de sitios
     * @since 14/12/2017
     * @author BMOTTAG
	 */
	public function index()
	{
			$data["view"] = 'dashboard';
			$this->load->view("layout", $data);
	}
	
	
}