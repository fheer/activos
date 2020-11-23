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
					<th width="5%" align="center">No</th>
					<th width="10%">Acta</th>
					<th width="15%">Tipo</th>
					<th width="15%">Fecha</th>
					<th width="10%">Opciones</th>
				</tr>
				</thead>
				<tbody>
				<?php $i = 1; foreach ($actas as $row) { ?>
					<tr class="gradeA">
						<td align="center"><?php echo $i; ?></td>
						<td><?php echo $row['url']; ?></td>
						<td>
						<?php
						if ($row['tipo'] == 'E'){
							echo 'Entrega';
						}else if ($row['tipo'] == 'L'){
							echo utf8_encode('Liberación');
						}else if ($row['tipo'] == 'R'){
							echo utf8_encode('Reposición');
						}
						?>
						</td>
						<td><?php echo $row['fecha']; ?></td>
						<td>
							<button type="submit" class="btn btn-default">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>
						</td>
					</tr>
					<?php $i++;	} ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- Delete modal -->
	<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalDeleteLabel">Eliminar</h4>
				</div>
				<div class="modal-body">
					<?php echo form_open(base_url().'activos/Cactivofijo/remove'); ?>
					<h4 align="center"></h4>
					<div class="form-group">
						<input type="hidden"  class="form-control" name="idActivoDelete" id="idActivoDelete">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="btnEliminar" class="btn btn-primary">Eliminar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var baseurl = "<?php echo base_url(); ?>";
	</script>

