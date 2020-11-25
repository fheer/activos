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
		</div>
	</div>
	<div class="row">
			<div class="col-md-6">
				<div class="content-box-large">
					<div class="panel-heading">
						<div class="form-group col-sm-6">
							<img src="<?php echo base_url().'fotos/personas/'.$persona['foto'];?>" width="60" height="80">
							<br><br>
							<h5>
								<strong><?php echo $persona['apellidoPaterno'].' '.$persona['apellidoMaterno'].' '.$persona['nombres']; ?></php></strong>
								<br>
								<?php echo $cargoNombre['cargo']; ?>
							</h5>
						</div>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form">
							<div class="form-group pull-left col-sm-6">
								<label>
									C.I.: <br><?php echo $persona['ci']; ?> <?php echo $persona['expedido']; ?>
									<br>
									Dirección:<br> <?php echo $persona['direccion']; ?>
									<br>
									Telefono: <br><?php echo $persona['telefono']; ?>
									<br>
									E-mail: <br><?php echo $persona['email']; ?>
									<br>
									Departamento: <br><?php echo $dpto['departamento']; ?>
									<br>
								</label>

							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="content-box-large">
					<div class="panel-heading">
						<div class="panel-title"><strong>Opciones</strong></div>
					</div>
					<div class="panel-body">
						<?php echo form_open(base_url().'CPersona/updatePerson/'.$persona['idPersona'],
							array("class"=>"form-inline")); ?>
							<input type="hidden" name="destino" id="destino" value="P">
							<button type="submit" class="btn btn-primary"><i class="fa fa-male"></i>
								Cambiar Datos Personales
							</button>
						<?php echo form_close(); ?>
						<br>
						<?php echo form_open(base_url().'perfil/CPerfil/edit/'.$persona['idPersona'],
							array("class"=>"form-inline")); ?>
						<button type="submit" class="btn btn-primary"><i class="fa fa-user"></i>
							Cambiar Datos Inicio de Sesión
						</button>
						<?php echo form_close(); ?>
						<br>
						<?php echo form_open(base_url().'perfil/CPerfil/edit/'.$persona['idPersona'],
							array("class"=>"form-inline")); ?>
						<div class="btn btn-primary">
							<i class="fa fa-desktop"></i>
							Ver Activos Fijos Asignados
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--  Page content -->
</div>
</div>
</div>

