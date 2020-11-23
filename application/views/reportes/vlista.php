	<div class="col-md-10">
		<div class="row">
			<div class="col-md-12 panel-info">
				<?php
				if (!empty($mensaje))
				{
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
					<div class="panel-title "><b>Asignar Activos fijos</b></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="content-box-large">
					<?php echo form_open(base_url().'asignar/CAsignar/add',array("class"=>"form-inline")); ?>
					<div class="panel-body">
						<div class="pull-left">
							<a href="<?php echo base_url();?>reportes/CEntrega/entrega_actas_pdf" target="_blank" class="btn btn-success btn-sm">
								<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir Lista
							</a>
							<br/><br/>
						</div>
						<br><br><br>
						<div class="form-group col-md-6 ">
							<label>Seleccione al Empleado</label>
							<br>
							<select id="idPersona" name="idPersona" class="form-control select2">
								<?php
								foreach ($persona as $row)
								{
									?>
									<option value="<?php echo $row['idPersona']; ?>">
										<?php echo $row['apellidoPaterno'].' '.$row['apellidoMaterno'].' '. $row['nombres']; ?>
									</option>
									<?php
								}
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--  Page content -->
	</div>
</div>
</div>
