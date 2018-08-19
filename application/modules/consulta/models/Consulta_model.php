<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Consulta_model extends CI_Model {

	    
		/**
		 * Consulta de la busqueda
		 * @since 6/8/2018
		 */
		public function get_resultado() 
		{
				$ano = $this->input->post('anio');
				$prueba = $this->input->post('prueba');
				$snpRegistro = $this->input->post('snp_registro');
				$noDocumento = $this->input->post('no_documento');
			
			
				$this->db->select();
				if ($ano && $ano != '') {
					$where = "fecha_aplicacion like '%$ano%'";
					$this->db->where($where);
				}
				if ($prueba && $prueba != '') {
					$this->db->where('codigo_prueba', $prueba);
				}
				if ($snpRegistro && $snpRegistro != '') {
					$this->db->where('snp_registro', $snpRegistro);
				}
				if ($noDocumento && $noDocumento != '') {
					$this->db->where('numero_documento', $noDocumento);
				}
				
				$query = $this->db->get('aplicacion_pruebas');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Guardo auditoria
		 * @since 19/8/2018
		 */
		public function save_auditoria() 
		{
			$idUser = $this->session->userdata("id");
		
			$data = array(
				'fk_id_usuario' => $idUser ,
				'fecha' => date("Y-m-d G:i:s"),
				'anio' => $this->input->post('anio'),
				'codigo_prueba' => $this->input->post('prueba'),
				'snp_registro' => $this->input->post('snp_registro'),
				'numero_documento' => $this->input->post('no_documento')
			);
						
			$query = $this->db->insert('auditoria', $data);
			
			if ($query) {
				return true;
			} else {
				return false;
			}
		}
		
		/**
		 * Consulta informacion
		 * @since 19/8/2018
		 */
		public function get_info_aplicacion_prueba($idAplicacionPrueba) 
		{		
				$this->db->select();
				$this->db->where('id_aplicacion_prueba', $idAplicacionPrueba);

				$query = $this->db->get('aplicacion_pruebas');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		

		
	    
	}