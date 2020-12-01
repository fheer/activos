<div class="col-md-10">
	<div class="content-box-large">
		<div class="panel-body">
			<div class="panel-title">Depreciación Activo Fijo:</div>
			<br>
			<div class="pull-left">
				<div class="container">
					<div >
					</div>
				</div>
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
				<?php $i = 1; foreach ($depreciacion  as $row) { ?>
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

