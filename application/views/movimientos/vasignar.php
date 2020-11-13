<div class="col-md-10">
	<div class="content-box-large">
		<div class="panel-body">
			<div class="panel-title">Asignar</div>
			<br>
			<div class="pull-left">
			</div>
			<br><br><br>

			<?php $i = 1;
			echo form_open_multipart(base_url().'movimientos/CMovimiento/add',array("class"=>"form-horizontal"));
			?>
			<div class="form-group">
				<label for="tipo" class="col-md-3 control-label"><span class="text-danger">*</span> Tipo</label>
				<div class="col-md-6">
					<select name="idActivofijo" id="idActivofijo" class="form-control">
						<?php
						foreach ($activo  as $row)
						{
							echo '<option value="'.$row['idActivofijo'].'" >'.$row['nombre'].'</option>';
						}
						?>
					</select>
					<span class="text-danger"><?php echo form_error('cargo');?></span>
				</div>
			</div>
			<div class="form-group">
				<label for="tipo" class="col-md-3 control-label"><span class="text-danger">*</span> Tipo</label>
				<div class="col-md-6">
					<select name="idLugar" id="idLugar" class="form-control">
						<?php
						foreach ($lugar  as $lugarRow)
						{
							echo '<option value="'.$lugarRow['idLugar'].'" >'.$lugarRow['lugar'].'</option>';
						}
						?>
					</select>
					<input type="hidden" id="idLugar1" name="idLugar1" class="form-control" value="<?php //echo $idLugar;?>">

				</div>
			</div>
			<div class="form-group">
				<label for="numeroSerie" class="col-md-3 control-label"><span class="text-danger">*</span> Número de serie</label>
				<div class="col-md-5">
					<input type="date" id="fechaDe" name="fechaDe" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label for="numeroSerie" class="col-md-3 control-label"><span class="text-danger">*</span> Número de serie</label>
				<div class="col-md-5">
					<input type="date" id="fechaHasta" name="fechaHasta" class="form-control">

				</div>
			</div>
			<div class="box-footer">
				<a href="<?php echo base_url();?>movimientos/Cmovimiento/listaLugares/1" class="btn btn btn-default btn-md pull-right">
					<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Cancelar
				</a>
				<button type="submit" class="btn btn-info btn-md"> <span class="glyphicon glyphicon-ok-circle"></span> Guardar</button>
			</div>


					<?php
					echo form_close();
					?>
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

