<div class="col-md-10">
	<div class="content-box-large">
		<div class="panel-body">
			<div class="panel-title">Lista de Activos Fijos</div>
			<br>
			<div class="pull-left">
				<a href="<?php echo site_url('activos/Cactivofijo/insertActivo'); ?>" class="btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo Activo Fijo
				</a>
				<a href="<?php echo base_url();?>reportes/CreporteActivo/datosActivo" target="_blank" class="btn btn-success btn-sm">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir Lista
				</a>
				<br/><br/>
			</div>
			<br><br><br>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
				<thead>
				<tr>
					<th width="10%">Código</th>
					<th width="15%">Número de serie</th>
					<th width="15%">Nombre</th>
					<th width="15%">Descripcion</th>
					<th width="10%">Valor inicial</th>
					<th width="10%">Imagen</th>
				</tr>
				</thead>
				<tbody>
					<tr class="gradeA">
						<td><?php echo $activofijo['codigo']; ?></td>
						<td><?php echo $activofijo['numeroSerie']; ?></td>
						<td><?php echo $activofijo['nombre']; ?></td>
						<td><?php echo $activofijo['descripcion']; ?></td>
						<td><?php echo $activofijo['valorInicial']; ?></td>
						<td><img src="<?php echo base_url().'fotos/activos/'.$activofijo['imagen'];?>" width="60" height="80"></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
