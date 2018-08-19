<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
					<i class="fa fa-gear fa-fw"></i> CONFIGURACIONES - AUDITORÍA
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
				<div class="panel-heading">
					<i class="fa fa-users"></i> LISTA DE CONSULTAS
				</div>
				<div class="panel-body">

				<?php		
					if($info){
				?>				
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Usuario</th>
								<th class="text-center">Fecha consulta</th>
								<th class="text-center">Año consultado</th>
								<th class="text-center">Código prueba consultado</th>
								<th class="text-center">SNP registro consultado</th>								
								<th class="text-center">No. documento consultado</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
									echo "<tr>";
									echo "<td>$lista[nombres_usuario]  $lista[apellidos_usuario]</td>";
									echo "<td class='text-center'>$lista[fecha]</td>";
									echo "<td class='text-center'>$lista[anio]</td>";
									echo "<td class='text-center'>$lista[codigo_prueba]</td>";
									echo "<td class='text-center'>$lista[snp_registro]</td>";
									
									if($lista['numero_documento'] == 0){
										$noDocumento = '';
									}else{
										$noDocumento = $lista['numero_documento'];
									}
									echo "<td class='text-center'>$noDocumento</td>";
									echo "</tr>";
							endforeach;
						?>
						</tbody>
					</table>
				<?php } ?>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->
		
				
<!--INICIO Modal para adicionar HAZARDS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal para adicionar HAZARDS -->

<!-- Tables -->
<script>
$(document).ready(function() {
	$('#dataTables').DataTable({
		responsive: true,
		"order": [[ 0, "asc" ]],
		"pageLength": 25
	});
});
</script>