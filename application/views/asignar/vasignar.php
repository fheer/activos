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
						<div class="panel-body">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
								<thead>
								<tr>
									<th width="5%" align="center">No</th>
									<th width="20%">Código</th>
									<th width="35%">Nombre</th>
									<th width="10%">Imagen</th>
									<th width="10%">Código QR</th>
									<th width="10%">Asignar</th>
								</tr>
								</thead>
								<tbody>
								<?php $i = 1; foreach ($activofijo  as $row) { ?>
									<tr class="gradeA">
										<td align="center"><?php echo $i; ?></td>
										<td><?php echo $row['codigo']; ?></td>
										<td><?php echo $row['nombre']; ?></td>
										<td><img src="<?php echo base_url().'fotos/activos/'.$row['imagen'];?>"
												 width="60" height="80">
										</td>
										<td><img src="<?php echo base_url().'fotos/qr/'.$row['qr'];?>" width="60"
												 height="80">
										</td>
										<td style="vertical-align:middle;" align="center"><input type="checkbox" name="asignado[]"
										  value="<?php echo $row['idActivofijo'];?>" />
										</td>
									</tr>
									<?php $i++;	} ?>
								</tbody>
							</table>
							<div class="box-footer">
								<button type="submit" class="btn btn-success btn-md pull-left">
									<span class="glyphicon glyphicon-ok-circle"></span> Asignar</button>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
			<!--  Page content -->
		</div>
	</div>
</div>

