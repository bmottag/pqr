        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				
			<a class="navbar-brand" href="<?php echo base_url("login/redireccionarUsuario"); ?>"><img src="<?php echo base_url("images/logo.png"); ?>" class="img-rounded" width="87" height="32" /></a>
				
            </div>
            <!-- /.navbar-header -->

		


            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->	

				<li>
					<a href="<?php echo base_url("login/redireccionarUsuario"); ?>"><i class="fa fa-home fa-fw"></i> Inicio</a>
				</li>
				
				<li>
					<a href="<?php echo base_url("consulta"); ?>"><i class="fa fa-building-o fa-fw"></i> Consulta</a>
				</li>
		
<?php 
$userRol = $this->session->userdata("rol");

if($userRol==1){ //ADMIN
?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-gear"></i> Configuraciones <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
				
						<li>
							<a href="<?php echo base_url("admin/users"); ?>"><i class="fa fa-users fa-fw"></i> Usuarios</a>
						</li>
						
						<li>
							<a href="<?php echo base_url("admin/subir_aplicaciones"); ?>"><i class="fa fa-users fa-fw"></i> Cargar aplicaciones</a>
						</li>

                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
<?php
}
?>

				<li>
					<a href="<?php echo base_url("menu/salir"); ?>"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
				</li>
				
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

        </nav>