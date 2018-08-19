<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Admin_model extends CI_Model {

	    
		/**
		 * Verify if the user already exist by the social insurance number
		 * @since  10/5/2017
		 */
		public function verifyUser($arrData) 
		{
				$this->db->where($arrData["column"], $arrData["value"]);
				$query = $this->db->get("usuario");

				if ($query->num_rows() >= 1) {
					return true;
				} else{ return false; }
		}
		
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
		
		/**
		 * Add/Edit USER
		 * @since 10/5/2017
		 */
		public function saveUser($clave) 
		{
				$idUser = $this->input->post('hddId');
				
				$data = array(
					'tipo_documento' => $this->input->post('tipoDocumento'),
					'numero_documento' => $this->input->post('documento'),
					'nombres_usuario' => $this->input->post('firstName'),
					'apellidos_usuario' => $this->input->post('lastName'),
					'direccion_usuario' => $this->input->post('address'),
					'telefono_fijo' => $this->input->post('telefono'),
					'celular' => $this->input->post('movilNumber'),
					'email' => $this->input->post('email'),
					'log_user' => $this->input->post('documento'),
					'fk_id_rol' => $this->input->post('rol')
				);	

				//revisar si es para adicionar o editar
				if ($idUser == '') {
					$data['fecha_creacion'] = date("Y-m-d");
					$data['estado'] = 1;//si es para adicionar se coloca estado inicial como usuario ACTIVO
					$data['password'] = md5($clave);
					$data['clave'] = $clave;
					$query = $this->db->insert('usuario', $data);
					$idUser = $this->db->insert_id();
				} else {
					$data['estado'] = $this->input->post('estado');
					$this->db->where('id_usuario', $idUser);
					$query = $this->db->update('usuario', $data);
				}
				if ($query) {
					return $idUser;
				} else {
					return false;
				}
		}

	    /**
	     * Reset user´s password ---NO SE ESTA USANDO
	     * @since  11/1/2017
	     */
	    public function resetEmployeePassword($idUser)
		{
				$passwd = '123456';
				$passwd = md5($passwd);
				
				$data = array(
					'password' => $passwd,
					'state' => 0
				);

				$this->db->where('id_user', $idUser);
				$query = $this->db->update('user', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
	    }
		
	    /**
	     * Actualiar la contraseña del usuario
	     * @since  10/5/2017
	     */
	    public function updatePassword()
		{
				$idUser = $this->input->post("hddId");
				$newPassword = $this->input->post("inputPassword");
				$passwd = str_replace(array("<",">","[","]","*","^","-","'","="),"",$newPassword); 
				$passwd = md5($passwd);
				
				$data = array(
					'password' => $passwd,
					'clave' => $newPassword
				);

				$this->db->where('id_usuario', $idUser);
				$query = $this->db->update('usuario', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
	    }
		
		/**
		 * Cargar aplicacion pruebas
		 * @since 5/8/2018
		 */
		public function cargar_aplicaciones_pruebas($lista) 
		{
				$query = $this->db->insert('aplicacion_pruebas', $lista);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
		/**
		 * Add/Edit PRUEBA
		 * @since 10/5/2017
		 */
		public function savePrueba() 
		{
				$idPrueba = $this->input->post('hddId');
				
				$data = array(
					'nombre_prueba' => $this->input->post('nombrePrueba'),
					'codigo_prueba' => $this->input->post('codigoPrueba'),
					'anio_prueba' => $this->input->post('anio')
				);
				
				//revisar si es para adicionar o editar
				if ($idPrueba == '') {
					$query = $this->db->insert('param_pruebas', $data);
					$idPrueba = $this->db->insert_id();				
				} else {
					$this->db->where('id_prueba', $idPrueba);
					$query = $this->db->update('param_pruebas', $data);
				}
				if ($query) {
					return $idPrueba;
				} else {
					return false;
				}
		}
		
		/**
		 * Lista auditoria
		 * @since 19/8/2018
		 */
		public function get_auditoria($arrDatos) 
		{
				$this->db->select('nombres_usuario, apellidos_usuario, A.*');
				$this->db->join('usuario U', 'U.id_usuario = A.fk_id_usuario', 'INNER');
				
				$this->db->order_by('fecha', 'desc');
				$query = $this->db->get('auditoria A');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		
	    
	}