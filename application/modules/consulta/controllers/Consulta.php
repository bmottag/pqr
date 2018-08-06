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
			$this->load->model("general_model");
			$arrParam = array(
				"table" => "param_anos",
				"order" => "anos",
				"id" => "x"
			);
			$data['anos'] = $this->general_model->get_basic_search($arrParam);

			$arrParam = array(
				"table" => "param_pruebas",
				"order" => "codigo_prueba",
				"id" => "x"
			);
			$data['prueba'] = $this->general_model->get_basic_search($arrParam);
	
			$data["view"] = "form_consulta";
			$this->load->view("layout", $data);
	}
	
	/**
	 * resultado consulta
     * @since 6/8/2018
     * @author BMOTTAG
	 */
	public function resultado()
	{
			$data['info'] = $this->consulta_model->get_resultado();
	
			$data["view"] = 'resultado_consulta';
			$this->load->view("layout", $data);
	}
	
	
	
	

	
	
}