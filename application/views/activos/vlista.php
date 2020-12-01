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
					<th width="10%">Código</th>
					<th width="15%">Número de serie</th>
					<th width="15%">Nombre</th>
					<th width="15%">Fecha</th>
					<th width="10%">Valor inicial</th>
					<th width="10%">Imagen</th>
					<th width="10%">Código QR</th>
					<th width="10%">Opciones</th>
				</tr>
				</thead>
				<tbody>
				<?php $i = 1; foreach ($activofijo  as $row) { ?>
					<tr class="gradeA">
						<td align="center"><?php echo $i; ?></td>
						<td><?php echo $row['codigo']; ?></td>
						<td><?php echo $row['numeroSerie']; ?></td>
						<td><?php echo $row['nombre']; ?></td>
						<td><?php echo $row['fechaCompra']; ?></td>
						<td><?php echo $row['valorInicial']; ?></td>
						<td><img src="<?php echo base_url().'fotos/activos/'.$row['imagen'];?>" width="100" height="100"></td>
						<td><img src="<?php echo base_url().'fotos/qr/'.$row['qr'];?>" width="100" height="100"></td>
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
											 <a href="<?php echo base_url().'activos/Cactivofijo/select_activofijo/'.$row['idActivofijo']; ?>"
												title="Modificar informacion" onClick="">
												 <i style="color:#555;" class="glyphicon glyphicon-edit"></i> Modificar
											 </a>
										 </li>
                      					 <li>
											 <a href=""data-toggle="modal" data-target="#modalDelete"
												data-whatever="<?php echo $row['idActivofijo']; ?>"
												title="Eliminar Activo Fijo">
											 <i style="color:red;" class="glyphicon glyphicon-remove"></i> Eliminar
											 </a>
										 </li>
										 <li><a href="<?php echo base_url().'activos/Cactivofijo/get_data_depreciacion/'.$row['idActivofijo']; ?>"
												title="Imprimir formato">
												 <i class="glyphicon glyphicon-print" style="color:#006699"></i>
												 Ver Depreciación
											 </a>
										 </li>
                      				     <li><a href="<?php echo base_url().'activos/Cactivofijo/Creport'.$row['idActivofijo']; ?>"
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

