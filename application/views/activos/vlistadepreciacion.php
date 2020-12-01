<div class="col-md-10">
	<div class="callout callout-default">
		<h4>Depreciación</h4>
		<h4>Activo Fijo: <?php echo $activofijo['nombre'];?></h4>
		<h4>Código: <?php echo $activofijo['codigo'];?></h4>
		<h4>Valor Inicial: <?php echo $activofijo['valorInicial'];?></h4>
		<h4>Vida Util: <?php echo $vidautil['vidautil'];?></h4>
	</div>
	<div class="content-box-large">
		<div class="panel-body">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
				<thead>
				<tr>
					<th width="5%" align="center">Año</th>
					<th width="15%">Valor Depreciacion</th>
					<th width="15%">Valor Acumulada Depreciacion</th>
				</tr>
				</thead>
				<tbody>
				<?php $i = 1; foreach ($depreciacion  as $row) { ?>
				<tr class="gradeA">
					<td align="center"><?php echo 'Año '.$i; ?></td>
					<td><?php echo $row['valorDepreciacion']; ?></td>
					<td><?php echo $row['valorAcumuladoDepreciacion']; ?></td>
					<?php $i++;	} ?>
				</tbody>
			</table>
		</div>
	</div>
