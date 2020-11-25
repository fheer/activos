<div class="col-md-10">
	<div class="content-box-large">
		<div class="panel-body">
			<div class="panel-title">Generar Etiquetas</div>
			<br>
			<br><br><br>
			<?php echo form_open(base_url().'etiqueta/CEtiqueta/print_labels',array("class"=>"form-inline")); ?>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
				<thead>
				<tr>
					<th width="5%" align="center">No</th>
					<th width="10%">Código</th>
					<th width="15%">Nombre</th>
					<th width="10%" align="center">Código QR</th>
					<th width="10%" align="center">Seleccionar</th>
				</tr>
				</thead>
				<tbody>
				<?php $i = 1; foreach ($activofijo  as $row) { ?>
					<tr class="gradeA">
						<td align="center"><?php echo $i; ?></td>
						<td><?php echo $row['codigo']; ?></td>
						<td><?php echo $row['nombre']; ?></td>
						<td align="center"><img src="<?php echo base_url().'fotos/qr/'.$row['qr'];?>" width="100" height="100"></td>
						<td style="vertical-align:middle;" align="center"><input type="checkbox" name="asignado[]"
							value="<?php echo $row['idActivofijo'];?>" />
						</td>
					</tr>
					<?php $i++;	} ?>
				</tbody>
			</table>
			<div class="box-footer">
				<button type="submit" class="btn btn-success btn-md pull-left">
					<span class="glyphicon glyphicon-print"></span> Imprimir</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>

	<script type="text/javascript">
		var baseurl = "<?php echo base_url(); ?>";
	</script>


