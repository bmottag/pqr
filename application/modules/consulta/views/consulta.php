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

					<form  name="form" id="form" class="form-horizontal" method="post" action="<?php echo base_url("admin/update_password"); ?>" >
												
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword">Contraseña</label>
							<div class="col-sm-5">
								<input type="text" id="inputPassword" name="inputPassword" class="form-control" >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputConfirm">Confirmar contraseña</label>
							<div class="col-sm-5">
								<input type="text" id="inputConfirm" name="inputConfirm" class="form-control" >
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