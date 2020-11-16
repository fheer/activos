<div class="col-md-10">
	<div class="row">
		<div class="col-md-12 panel-info">
			<?php
			if (!empty($mensaje)) {
				?>
				<div class="alert alert-danger alert-dismissible" align="center">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="icon fa fa-ban"></i>
					<?php echo $mensaje; ?>
				</div>
				<?php
			}
			?>
			<div class="panel-body">
				<div class="panel-title "><b>Lista Activos fijos Asignados</b></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="content-box-large">
				<div class="panel-body">
					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
						   id="example">
						<thead>
						<tr>
							<th width="5%" align="center">No</th>
							<th width="10%">Código</th>
							<th width="15%">Número de serie</th>
							<th width="15%">Nombre</th>
							<th width="15%">Fecha de compra</th>
							<th width="10%">Valor inicial</th>
							<th width="10%">Imagen</th>
							<th width="10%">Código QR</th>
							<th width="10%">Opciones</th>
						</tr>
						</thead>
						<tbody>
						<?php $i = 1;
						//foreach ($activofijo as $row)
						 { ?>
							<tr class="gradeA">
								<td align="center"><?php echo $i; ?></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>
								</td>
							</tr>
							<?php $i++;
						} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--  Page content -->
</div>
</div>
</div>

