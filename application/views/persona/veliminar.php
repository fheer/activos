<div class="col-md-10">
	<div class="content-box-large">
		<div class="panel-body">
			<div class="panel-title">Lista del personal</div>
			<br>
			<div class="pull-left">
				<!-- <?php //echo site_url('CPersona/insertPerson'); ?> -->

				<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalRegistro"
				   class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Nuevo Personal</a>
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
											  <a href="" data-toggle="modal" data-target="#modalUpdate"
												 title="Modficar Persona"
												 onClick="mostrarDatos('<?php echo $p['idPersona']; ?>');">
											 	 <i style="color:darkgreen;" class="glyphicon glyphicon-edit"></i>
												  Modificar
											  </a>
										  <li>
											 <a href="" data-toggle="modal" data-target="#modalDelete"
												data-whatever="<?php echo $p['idPersona']; ?>"
												title="Eliminar Persona">
											 	<i style="color:red;" class="glyphicon glyphicon-remove"></i> Eliminar
											 </a>
										  </li>
										  <li>
											  <a href="<?php echo site_url('CPersona/print/' . $p['idPersona']); ?>"
												 title="Imprimir formato"><i class="glyphicon glyphicon-print"
																			 style="color:#006699"></i> Imprimir</a>
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
	<script type="text/javascript">
		var baseurl = "<?php echo base_url(); ?>";
	</script>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://code.jquery.com/jquery.js"></script>
	<!-- <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> -->
	<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<link href="<?php echo base_url(); ?>assets/vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

	<!-- Include all compiled plugins (below), or include individual files as needed <script src="<?php //echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>-->
	<script src="<?php echo base_url(); ?>assets/vendors/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/datatables/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/tables.js"></script>
