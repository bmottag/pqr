<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Consulta_model extends CI_Model {

	    
		/**
		 * Lista de usuarios
		 * @since 10/5/2017
		 */
		public function get_users($arrDatos) 
		{
				$this->db->select();
				$this->db->join('param_roles R', 'R.id_rol = U.fk_id_rol', 'INNER');
				if (array_key_exists("idUsuario", $arrDatos)) {
					$this->db->where('id_usuario', $arrDatos["idUsuario"]);
				}
				if (array_key_exists("idRol", $arrDatos)) {
					$this->db->where('fk_id_rol', $arrDatos["idRol"]);
				}
				if (array_key_exists("codigo_dane", $arrDatos)) {
					$where = "fk_codigo_dane is not NULL";
					$this->db->where($where);
				}
				
				$this->db->order_by('nombres_usuario', 'asc');
				$query = $this->db->get('usuario U');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		

		
	    
	}