<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
					<i class="fa fa-search fa-fw"></i> RESULTADO DE LA CONSULTA
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
					<i class="fa fa-search"></i> RESULTADO DE LA CONSULTA
				</div>
				<div class="panel-body">

				<?php
					if($info){
				?>				
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Código prueba</th>
								<th class="text-center">Nombre prueba</th>
								<th class="text-center">Fecha aplicación</th>
								<th class="text-center">Departamento</th>
								<th class="text-center">Municipio</th>
								<th class="text-center">Código sitio</th>								
								<th class="text-center">Nombre sitio</th>
								<th class="text-center">SNP registro</th>
								<th class="text-center">Tipo documento</th>
								<th class="text-center">No. documento</th>
								<th class="text-center">Sesión</th>								
								<th class="text-center">HR_F</th>
								<th class="text-center">HR_A</th>
								<th class="text-center">PA_F</th>
								<th class="text-center">PA_A</th>
								<th class="text-center">LF</th>
								<th class="text-center">MU</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
									echo "<tr>";
									echo "<td class='text-center'>" . $lista['codigo_prueba'] . "</td>";
									echo "<td>$lista[nombre_prueba]</td>";
									echo "<td class='text-center'>$lista[fecha_aplicacion]</td>";
									echo "<td class='text-center'>$lista[departamento]</td>";
									echo "<td class='text-center'>$lista[municipio]</td>";
									echo "<td class='text-center'>$lista[codigo_sitio]</td>";
									echo "<td>$lista[nombre_sitio]</td>";
									echo "<td class='text-center'>$lista[snp_registro]</td>";
									echo "<td>$lista[tipo_documento]</td>";
									echo "<td class='text-right'>$lista[numero_documento]</td>";
									echo "<td class='text-center'>$lista[sesion]</td>";
									echo "<td>$lista[hr_f]</td>";
									echo "<td>$lista[hr_a]</td>";
									echo "<td>$lista[pa_f]</td>";
									echo "<td>$lista[pa_a]</td>";
									echo "<td>$lista[lf]</td>";
									echo "<td>$lista[mu]</td>";
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