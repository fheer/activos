<div class="col-md-10">
	<div class="content-box-large">
		<?php
		if (!empty($mensaje)) {
			?>
			<div class="alert alert-danger alert-dismissible col-md-6 control-label" align="center">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="icon fa fa-ban"></i><?php echo $mensaje; ?>
			</div>
			<?php
		}
		?>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<?php echo form_open_multipart(base_url() . 'estado/CEstado/edit', array("class" => "form-horizontal")); ?>
					<div class="form-group">
						<label for="cargo" class="col-md-4 control-label"><span class="text-danger">*</span>
							Estado</label>
						<div class="col-md-4">
							<input type="hidden" class="form-control input-sm" name="idEstado" id="idEstado"
								   value="<?php echo $estado['idEstado']; ?>"/>
							<input type="text" class="form-control input-sm" name="estado" id="estado"
								   value="<?php echo $estado['estado']; ?>"/>
							<span class="text-danger"><?php echo form_error('cargo'); ?></span>
						</div>
					</div>

					<div class="box-footer">
						<a href="<?php echo base_url(); ?>estado/CEstado/"
						   class="btn btn btn-default btn-md pull-right">
							<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Cancelar
						</a>
						<button type="submit" class="btn btn-info btn-md"><span
								class="glyphicon glyphicon-ok-circle"></span> Guardar
						</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>


