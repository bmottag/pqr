<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("admin_model");
		$this->load->library("validarsesion");
    }
	
	/**
	 * Evio de correo al usuario con la contraseña
     * @since 24/5/2017
	 */
	public function email($idUsuario)
	{
			$arrParam = array("idUsuario" => $idUsuario);
			$infoUsuario = $this->admin_model->get_users($arrParam);

			$subjet = "Ingreso APP ICFES - Pruebas PISA 2018";
			$user = $infoUsuario[0]["nombres_usuario"] . " " . $infoUsuario[0]["apellidos_usuario"];
			$to = $infoUsuario[0]["email"];
		
			//mensaje del correo
			$msj = "<p>Los datos para ingresar al APP ICFES - Pruebas PISA 2018, son los siguientes:</p>";
			$msj .= "<br><strong>Usuario: </strong>" . $infoUsuario[0]["numero_documento"];
			$msj .= "<br><strong>Contraseña: </strong>" . $infoUsuario[0]["clave"];
			$msj .= "<br><br><strong><a href='" . base_url() . "'>Enlace Aplicación </a></strong><br>";
				
			$mensaje = "<html>
						<head>
						  <title> $subjet </title>
						</head>
						<body>
							<p>Señor(a) $user:</p>
							<p>$msj</p>
							<p>Cordialmente,</p>
							<p><strong>Administrador aplicativo de Control Operativo pruebas ICFES</strong></p>
						</body>
						</html>";

						
			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$cabeceras .= 'To: ' . $user . '<' . $to . '>' . "\r\n";
			$cabeceras .= 'From: ICFES APP <administrador@operativoicfes.com>' . "\r\n";

			//enviar correo
			mail($to, $subjet, $mensaje, $cabeceras);
	}
	
	/**
	 * users List
     * @since 15/12/2016
     * @author BMOTTAG
	 */
	public function users()
	{
			$userRol = $this->session->rol;
			if ($userRol != 1 ) { 
				show_error('ERROR!!! - You are in the wrong place.');	
			}

			$arrParam = array();
			$data['info'] = $this->admin_model->get_users($arrParam);
			
			$data["view"] = 'users';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario Usuarios
     * @since 15/12/2016
     */
    public function cargarModalUser() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idUser"] = $this->input->post("idUser");

			$this->load->model("general_model");
			$arrParam = array(
				"table" => "param_roles",
				"order" => "nombre_rol",
				"id" => "x"
			);
			$data['roles'] = $this->general_model->get_basic_search($arrParam);			
			
			if ($data["idUser"] != 'x') 
			{
				$arrParam = array(
					"idUsuario" => $data["idUser"]
				);
				$data['information'] = $this->admin_model->get_users($arrParam);
			}
			
			$this->load->view("user_modal", $data);
    }
	
	/**
	 * Update user
     * @since 15/12/2016
     * @author BMOTTAG
	 */
	public function save_user()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idUser = $this->input->post('hddId');

			$msj = "Se adicionó un nuevo usuario.";
			if ($idUser != '') {
				$msj = "Se actualizó el usuario con exito.";
			}			

			$documento = $this->input->post('documento');

			$result_user = false;
			$clave = "";
			if ($idUser == '') {
				//Verify if the user already exist by the user name
				$arrParam = array(
					"column" => "numero_documento",
					"value" => $documento
				);
				$result_user = $this->admin_model->verifyUser($arrParam);
				//$clave = $this->generar_clave();
				$clave = $this->input->post('documento');
			}

			if ($result_user) {
				$data["result"] = "error";
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Este número de documento ya existe en la base de datos.');
			} else {
					if ($idUsuario = $this->admin_model->saveUser($clave)) {
						$data["result"] = true;					
						$this->session->set_flashdata('retornoExito', $msj);
						
						//a los usuarios nuevos les envio correo con contraseña
						if($idUser == '') {
							$this->email($idUsuario);
						}
					} else {
						$data["result"] = "error";					
						$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el administrador.');
					}
			}

			echo json_encode($data);
    }
	
	public function generar_clave()
	{
			$key = "";
			$caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			
			$length = 10;
			$max = strlen($caracteres) - 1;
			for ($i=0;$i<$length;$i++) {
				$key .= substr($caracteres, rand(0, $max), 1);
			}
			return $key;
	}
	
	/**
	 * Reset employee password
	 * Reset the password to '123456'
	 * And change the status to '0' to changue de password 
     * @since 11/1/2017
     * @author BMOTTAG
	 */
	public function resetPassword($idUser)
	{
			if ($this->admin_model->resetEmployeePassword($idUser)) {
				$this->session->set_flashdata('retornoExito', 'You have reset the Employee pasword to: 123456');
			} else {
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
			}
			
			redirect("/admin/employee/",'refresh');
	}
	
	/**
	 * Change password
     * @since 10/5/2017
	 */
	public function change_password($idUser)
	{
			if (empty($idUser)) {
				show_error('ERROR!!! - You are in the wrong place. The ID USER is missing.');
			}
						
			$arrParam = array(
				"idUsuario" => $idUser
			);
			$data['information'] = $this->admin_model->get_users($arrParam);
		
			$data["view"] = "form_password";
			$this->load->view("layout", $data);
	}
	
	/**
	 * Update user´s password
	 * @since 10/5/2017
	 */
	public function update_password()
	{
			$data = array();			
			$data["titulo"] = "ACTUALIZAR CONTRASEÑA";
			
			$newPassword = $this->input->post("inputPassword");
			$confirm = $this->input->post("inputConfirm");
			$passwd = str_replace(array("<",">","[","]","*","^","-","'","="),"",$newPassword); 
			
			$data['linkBack'] = "admin/users/";
			$data['titulo'] = "<i class='fa fa-unlock fa-fw'></i>CAMBIAR CONTRASEÑA";
			
			if($newPassword == $confirm)
			{					
					if ($this->admin_model->updatePassword()) {
						$data["msj"] = "Se actualizó la contraseña.";
						$data["msj"] .= "<br><strong>Número de documento: </strong>" . $this->input->post("hddUser");
						$data["msj"] .= "<br><strong>Contraseña: </strong>" . $passwd;
						$data["clase"] = "alert-success";
					}else{
						$data["msj"] = "<strong>Error!!!</strong> Contactarse con el administrador.";
						$data["clase"] = "alert-danger";
					}
			}else{
				//definir mensaje de error
				echo "pailas no son iguales";
			}
						
			$data["view"] = "template/answer";
			$this->load->view("layout", $data);
	}
	
	/**
	 * Vista para cargar aplicacion de pruebas
     * @since 5/8/2018
	 */
	public function subir_aplicaciones($error="", $success="")
	{		
			$data["error"] = $error;
			$data["success"] = $success;
			$data["view"] = 'cargar_aplicaciones';
			$this->load->view("layout", $data);
	}
	
	/**
	 * Subir archivo
     * @since 5/8/2018
	 */
	public function do_upload()
	{		
            $config['upload_path'] = './tmp/';
            $config['overwrite'] = true;
            $config['allowed_types'] = 'csv';
            $config['max_size'] = '5000';
            $config['file_name'] = 'cargar_aplicaciones_pruebas.csv';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = $this->upload->display_errors();
                $msgError = html_escape(substr($error, 3, -4));
                $this->subir_usuarios($msgError);
            }else {				
                $file_info = $this->upload->data();
                $data = array('upload_data' => $this->upload->data());

                $archivo = $file_info['file_name'];

				$registros = array();
				if (($fichero = fopen(FCPATH . 'tmp/' . $archivo, "a+")) !== FALSE) {
					// Lee los nombres de los campos
					$nombres_campos = fgetcsv($fichero, 0, ";");
					$num_campos = count($nombres_campos);
					// Lee los registros

					while (($datos = fgetcsv($fichero, 0, ";")) !== FALSE) {
						// Crea un array asociativo con los nombres y valores de los campos
						for ($icampo = 0; $icampo < $num_campos; $icampo++) {
							$registro[$nombres_campos[$icampo]] = $datos[$icampo];
						}
						// Añade el registro leido al array de registros
						$registros[] = $registro;
					}
					fclose($fichero);
					
					foreach ($registros as $lista) {
						$idUsuario = $this->admin_model->cargar_aplicaciones_pruebas($lista);
					}
				}

            }
			
			$success = 'El archivo se cargo correctamente.';
			$this->subir_aplicaciones('', $success);
    }

	/**
	 * Lista de PRUEBAS
     * @since 10/5/2017
	 */
	public function pruebas()
	{
			$this->load->model("general_model");
			$arrParam = array(
				"table" => "param_pruebas",
				"order" => "nombre_prueba",
				"id" => "x"
			);
			$data['info'] = $this->general_model->get_basic_search($arrParam);//lista pruebas; se filtra por año actual
			
			$data["view"] = 'prueba';
			$this->load->view("layout", $data);
	}
	
    /**
     * Cargo modal - formulario PRUEBAS
     * @since 10/5/2017
     */
    public function cargarModalPrueba() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idPrueba"] = $this->input->post("idPrueba");
			
			if ($data["idPrueba"] != 'x') {
				$this->load->model("general_model");
				$arrParam = array(
					"table" => "param_pruebas",
					"order" => "id_prueba",
					"column" => "id_prueba",
					"id" => $data["idPrueba"]
				);
				$data['information'] = $this->general_model->get_basic_search($arrParam);
			}
			
			$this->load->view("prueba_modal", $data);
    }
	
	/**
	 * Update Pruebas
     * @since 10/5/2017
	 */
	public function save_prueba()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idPrueba = $this->input->post('hddId');
			
			$msj = "Se adicionó la Prueba con exito.";
			if ($idPrueba != '') {
				$msj = "Se actualizó la Prueba con éxito.";
			}

			if ($idPrueba = $this->admin_model->savePrueba()) {
				$data["result"] = true;
				$data["idRecord"] = $idPrueba;
				
				$this->session->set_flashdata('retornoExito', $msj);
			} else {
				$data["result"] = "error";
				$data["idRecord"] = "";
				
				$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Contactarse con el Administrador.');
			}

			echo json_encode($data);
    }
	
	/**
	 * auditoria List
     * @since 19/8/2018
     * @author BMOTTAG
	 */
	public function auditoria()
	{
			$userRol = $this->session->rol;
			if ($userRol != 1 ) { 
				show_error('ERROR!!! - You are in the wrong place.');	
			}

			$arrParam = array();
			$data['info'] = $this->admin_model->get_auditoria($arrParam);
			
			$data["view"] = 'auditoria';
			$this->load->view("layout", $data);
	}

	
	
}