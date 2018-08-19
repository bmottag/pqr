<div id="page-wrapper">
	<br>

	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="glyphicon glyphicon-picture"></i> Imagen
				</div>
				<div class="panel-body">
					
					<div class="col-lg-4">	
						<div class="alert alert-info">
							<strong>Código prueba: </strong><?php echo $info[0]['codigo_prueba']; ?><br>
							<strong>Nombre prueba: </strong><?php echo $info[0]['nombre_prueba']; ?>
						</div>
					</div>
					<div class="col-lg-4">	
						<div class="alert alert-info">
							<strong>Departemanto: </strong><?php echo $info[0]['departamento']; ?><br>
							<strong>Municipio: </strong><?php echo $info[0]['municipio']; ?>
						</div>
					</div>
					<div class="col-lg-4">	
						<div class="alert alert-info">
							<strong>SNP registro: </strong><?php echo $info[0]['snp_registro']; ?><br>
							<strong>No. documento: </strong><?php echo $info[0]['numero_documento']; ?>
						</div>
					</div>
					
					<div class="col-lg-12">	
						

<a class='btn btn-primary btn-xs' href='<?php echo base_url("consulta/imagen/" . $info[0]['id_aplicacion_prueba'] . "/hr_f"); ?>'>
	HR F <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
</a>						

<a class='btn btn-primary btn-xs' href='<?php echo base_url("consulta/imagen/" . $info[0]['id_aplicacion_prueba'] . "/hr_a"); ?>'>
	HR A <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
</a>

<a class='btn btn-primary btn-xs' href='<?php echo base_url("consulta/imagen/" . $info[0]['id_aplicacion_prueba'] . "/pa_f"); ?>'>
	PA F <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
</a>

<a class='btn btn-primary btn-xs' href='<?php echo base_url("consulta/imagen/" . $info[0]['id_aplicacion_prueba'] . "/pa_a"); ?>'>
	PA A <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
</a>

<a class='btn btn-primary btn-xs' href='<?php echo base_url("consulta/imagen/" . $info[0]['id_aplicacion_prueba'] . "/lf"); ?>'>
	LF <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
</a>

<a class='btn btn-primary btn-xs' href='<?php echo base_url("consulta/imagen/" . $info[0]['id_aplicacion_prueba'] . "/mu"); ?>'>
	MU <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
</a>

					</div>
									
				</div>
					
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->								
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Imagen - <?php echo $imagen; ?></strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
				

				
					<div class="row" align="center">
<img src="<?php echo base_url("images/2018/" . $info[0]['codigo_prueba'] . "/" . $info[0][$imagen]); ?>" class="img-rounded" width="700" />
					</div>
				</div>
			</div>
		</div>
	</div>
		
</div>
<!-- /#page-wrapper -->