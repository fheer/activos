<div class="col-md-10">
	<div class="content-box-large">
		<div class="panel-body">
			<div class="panel-title">Lista de Activos Fijos</div>
			<br>
			<div class="pull-left">

				<a href="<?php echo site_url('activos/Cactivofijo/baja_activo'); ?>" class="btn btn-primary btn-md ">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nueva Baja</a>
				<a href="<?php echo base_url();?>reportes/CReporteBaja/datos_baja/" target="_blank" class="btn btn-success btn-md">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir Lista Bajas
				</a>
			</div>
			<br><br><br><br/><br/>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
				<thead>
				<tr>
					<th width="5%" align="center">No</th>
					<th width="10%">Activo Fijo</th>
					<th width="10%">Codigo</th>
					<th width="15%">Motivo</th>
					<th width="15%">Fecha</th>
				</tr>
				</thead>
				<tbody>
				<?php $i = 1; foreach ($bajas  as $row) { ?>
					<tr class="gradeA">
						<td align="center"><?php echo $i; ?></td>
						<td><?php echo $row['nombre']; ?></td>
						<td><?php echo $row['codigo']; ?></td>
						<td><?php echo $row['motivo']; ?></td>
						<td><?php echo $row['fecha']; ?></td>
					<?php $i++;	} ?>
				</tbody>
			</table>
		</div>
	</div>

