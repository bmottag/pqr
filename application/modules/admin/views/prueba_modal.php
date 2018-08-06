<script type="text/javascript" src="<?php echo base_url("assets/js/validate/admin/prueba.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Prueba
	<br><small>Adicionar/Editar Pruebas</small>
	</h4>
</div>

<div class="modal-body">

	<p class="text-danger text-left">Los campos con * son obligatorios.</p>
	
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_prueba"]:""; ?>"/>
		
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
						<label for="type" class="control-label">Nombre Prueba : *</label>
						<input type="text" id="nombrePrueba" name="nombrePrueba" class="form-control" value="<?php echo $information?$information[0]["nombre_prueba"]:""; ?>" placeholder="Nombre Prueba" required >
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label for="type" class="control-label">Código prueba : *</label>
					<input type="text" id="codigoPrueba" name="codigoPrueba" class="form-control" value="<?php echo $information?$information[0]["codigo_prueba"]:""; ?>" placeholder="Código Prueba" required >
				</div>
			</div>
		
			<div class="col-sm-6">				
				<div class="form-group text-left">
					<label for="type" class="control-label">Año : *</label>
					<select name="anio" id="anio" class="form-control" required>
						<option value='' >Select...</option>
						<?php
						for ($i = 2017; $i < 2030; $i++) {
							?>
							<option value='<?php echo $i; ?>' <?php
							if ($information && $i == $information[0]["anio_prueba"]) {
								echo 'selected="selected"';
							}
							?>><?php echo $i; ?></option>
								<?php } ?>									
					</select>
				</div>
			</div>
		</div>
				
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<input type="button" id="btnSubmit" name="btnSubmit" value="Guardar" class="btn btn-primary"/>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div id="div_load" style="display:none">		
				<div class="progress progress-striped active">
					<div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
						<span class="sr-only">45% completado</span>
					</div>
				</div>
			</div>
			<div id="div_error" style="display:none">			
				<div class="alert alert-danger"><span class="glyphicon glyphicon-remove" id="span_msj">&nbsp;</span></div>
			</div>	
		</div>
			
	</form>
</div>