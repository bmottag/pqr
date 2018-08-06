<script type="text/javascript" src="<?php echo base_url("assets/js/validate/password.js"); ?>"></script>

<div id="page-wrapper">

	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						<i class="fa fa-gear fa-fw"></i> FORMULARIO DE CONSULTA
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->				
	</div>
			
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">

				<div class="panel-body">
				
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-success">
								<div class="panel-heading">
									<strong>Información: </strong>
									Seleccionar el año, el código prueba y el SNP registro o el No. documento para poder realizar la consulta.
								</div>
							</div>
						</div>
					</div>

					<form  name="form" id="form" class="form-horizontal" method="post" action="<?php echo base_url("consulta/resultado"); ?>" >
												
						<div class="form-group">
							<label class="col-sm-4 control-label" for="ano">Año : </label>
							<div class="col-sm-5">
								<select name="ano" id="ano" class="form-control" >
									<option value=''>Select...</option>
									<?php for ($i = 0; $i < count($anos); $i++) { ?>
										<option value="<?php echo $anos[$i]["anos"]; ?>"><?php echo $anos[$i]["anos"]; ?></option>	
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="prueba">Código prueba :</label>
							<div class="col-sm-5">
								<select name="prueba" id="prueba" class="form-control" >
									<option value=''>Select...</option>
									<?php for ($i = 0; $i < count($prueba); $i++) { ?>
										<option value="<?php echo $prueba[$i]["codigo_prueba"]; ?>"><?php echo $prueba[$i]["codigo_prueba"]; ?></option>	
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="snp_registro">SNP registro :</label>
							<div class="col-sm-5">
								<input type="text" id="snp_registro" name="snp_registro" class="form-control" >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="no_documento">No. documento :</label>
							<div class="col-sm-5">
								<input type="text" id="no_documento" name="no_documento" class="form-control" >
							</div>
						</div>
						
						<div class="row" align="center">
							<div style="width:50%;" align="center">
								 <button type="submit" class="btn btn-primary" id='btnSubmit' name='btnSubmit'>Consultar </button>
							</div>
						</div>

					</form>

				</div>
				<!-- /.row (nested) -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->