<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta extends MX_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("consulta_model");
		$this->load->library("validarsesion");
    }
	
	/**
	 * Consulta
     * @since 5/8/2018
	 */
	public function index()
	{						
			$data["view"] = "consulta";
			$this->load->view("layout", $data);
	}
	
	
	
	

	
	
}