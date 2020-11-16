<div class="col-md-10">
	<div class="content-box-large">
		<div class="panel-body">
			<div class="panel-title">Lista del personal</div>
			<br>
			<div class="pull-left">
				<a href="<?php echo base_url();?>CPersona/insertPerson" class="btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo Registro
				</a>
				<a href="<?php echo base_url();?>reportes/CreportePersona/datosPersona" target="_blank" class="btn btn-success btn-sm">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir Lista
				</a>
				<br/><br/>
			</div>
			<br><br><br>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
				<thead>
				<tr>
					<th width="5%" align="center">No</th>
					<th width="5%">Ci</th>
					<th width="15%">Nombres</th>
					<th width="15%">Apellido Paterno</th>
					<th width="15%">Apellido Materno</th>
					<th width="20%">Dirección</th>
					<th width="5%">Telefono</th>
					<th width="10%">Correo Electrónico</th>
					<th width="10%">Foto</th>
					<th width="10%"></th>
				</tr>
				</thead>
				<tbody>
				<?php $i = 1; foreach ($persona as $p) { ?>
					<tr class="gradeA">
						<td align="center"><?php echo $i; ?></td>
						<td><?php echo $p['ci']; ?></td>
						<td><?php echo $p['nombres']; ?></td>
						<td><?php echo $p['apellidoPaterno']; ?></td>
						<td><?php echo $p['apellidoMaterno']; ?></td>
						<td><?php echo $p['direccion']; ?></td>
						<td><?php echo $p['telefono']; ?></td>
						<td><?php echo $p['email']; ?></td>
						<td><img src="<?php echo base_url().'fotos/personas/'.$p['foto'];?>" width="60" height="80"></td>
						<td>
							<span class="pull-right">
								  <div class="dropdown">
									<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
											data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									Acciones
									<span class="caret"></span>
									</button>
									 <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
										 <li>
											 <a href="<?php echo base_url().'CPersona/updatePerson/'.$p['idPersona']; ?>"
												title="Modificar informacion" onClick="">
												 <i style="color:#555;" class="glyphicon glyphicon-edit"></i> Modificar
											 </a>
										 </li>
                      					 <li>
											 <a href=""data-toggle="modal" data-target="#modalDelete"
												data-whatever="<?php echo $p['idPersona']; ?>"
												title="Eliminar Cdte">
											 <i style="color:red;" class="glyphicon glyphicon-remove"></i> Eliminar
											 </a>
										 </li>
                      				     <li><a href="<?php echo base_url().'CreportePersona/Creport'.$p['idPersona']; ?>"
												title="Imprimir formato">
												 <i class="glyphicon glyphicon-print" style="color:#006699"></i>
												 Imprimir
											 </a>
										 </li>
									 </ul>
								  </div>
							</span>
						</td>
					</tr>
					<?php $i++;	} ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- Delete modal -->
	<div class="modal fade" id="modalDelete" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalDeleteLabel">Eliminar</h4>
				</div>
				<div class="modal-body">
					<?php echo form_open(base_url().'CPersona/removeNew'); ?>
					<h4 align="center"></h4>
					<div class="form-group">
						<input type="hidden"  class="form-control" name="idPersonaDelete" id="idPersonaDelete">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="btnEliminar" class="btn btn-primary pull-left">Eliminar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var baseurl = "<?php echo base_url(); ?>";
	</script>



