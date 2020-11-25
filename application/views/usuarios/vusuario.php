
		<div class="col-md-10">
			<div class="content-box-large">
				<?php
				if (!empty($mensaje))
				{
				?>
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $mensaje; ?>
					</div>
				<?php
				}
				?>
				<div class="panel-body">
					<section class="content">
						<div class="row">
							<div class="box box-success">
								<div class="box-header">
									<h3 class="box-title">Crear Usuario</h3>
								</div>
								<div class="box-body col-md-10">
									<?php echo form_open(base_url().'usuarios/CUsuario/add',array("class"=>"form-inline")); ?>
									<div class="form-group col-md-10">
										<label for="idPersona" class="control-label">Personal</label>
										<br>
										<select id="idPersona" name="idPersona" class="col-md-6 form-control select2">
											<?php
											foreach ($persona as $row)
											{
											?>
												<option value="<?php echo $row['idPersona']; ?>"><?php echo $row['nombre']; ?></option>
											<?php
											}
											?>
										</select>
									</div>
									<div class="form-group col-md-4">
										<label for="user" class="col-md-6 control-label">Usuario</label>
										<input class="form-control" id="user" name="user" type="text" >
										<span class="text-danger"><?php echo form_error('user');?></span>
									</div>
									<div class="form-group col-md-4">
										<label for="clave" class="col-md-6 control-label">Contraseña</label>
										<input class="form-control" id="clave" name="clave" type="text">
										<span class="text-danger"><?php echo form_error('clave');?></span>
									</div>
									<div class="form-group col-md-10">
										<label hidden for="claveHash" class="col-md-6 control-label">clave Hash</label>
										<input  type="hidden" class="form-control" id="claveHash" name="claveHash">
									</div>
									<br>
									<div class="form-group col-md-4">
										<label hidden for="clave" class="col-md-6 control-label">email</label>
										<input type="hidden" class="form-control" id="email" name="email" >
									</div>
									<script type="text/javascript">
										var baseurl = "<?php echo base_url(); ?>";
										var pass;
										var usser;
										document.getElementById('idPersona').onchange = function() {
											/* Referencia al option seleccionado */
											var mOption = this.options[this.selectedIndex];
											/* Referencia a los atributos data de la opción seleccionada */
											var mData = mOption.dataset;
											/* Referencia al input */
											var elUser = document.getElementById('user');
											var psw = document.getElementById('clave');
											var pswHash = document.getElementById('claveHash');
											var emailPersona = document.getElementById('email');
											$.ajax({
												url: baseurl+"usuarios/CUsuario/generate_user_name/" + this.value,
												method:"POST",
												success: function(data) {
													usser = data;
													elUser.value = data ;
												}
											});
											$.ajax({
												url: baseurl+"usuarios/CUsuario/generate_password/",
												method:"POST",
												success: function(data) {
													pass = data;
													psw.value = data ;
												}
											});
											$.ajax({
												url: baseurl+"usuarios/CUsuario/hash_generate_password_for_js/"+ pass.trim(),
												method:"POST",
												success: function(data) {
													pswHash.value = data.trim() ;
												}
											});
											$.ajax({
												url: baseurl+"usuarios/CUsuario/get_email_persona/" + this.value,
												method:"POST",
												success: function(data) {
													emailPersona.value = data ;
												}
											});
										};
									</script>
								</div>
								<!-- /.box-body -->
							</div>
							<!-- Form Element sizes -->
						</div>
						<div class="row">
							<div class="box box-success">
								<div class="box-header">
									<h3 class="box-title">Acceso a:</h3>
								</div>
								<div class="box-body col-md-4">
									<div class="col-md-6">
										<div class="form-group">
											<label>
												<input type="checkbox" id="perfil" name="perfil" class="flat-green"
													   readonly="readonly" checked onclick="javascript: return false;">
												Perfil
											</label>
										</div>
										<div class="form-group">
											<label>
												<input type="checkbox" id="personal" name="personal" class="flat-green">
												Personal
											</label>
										</div>
										<div class="form-group">
											<label>
												<input type="checkbox" id="activos" name="activos" class="flat-green">
												Activos
											</label>
										</div>
										<div class="form-group">
											<label>
												<input type="checkbox" id="movimientos" name="movimientos" class="flat-green">
												Movimientos
											</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>
												<input type="checkbox" id="usuarios" name="usuarios" class="flat-green">
												Usuarios
											</label>
										</div>
										<div class="form-group">
											<label>
												<input type="checkbox" id="reportes" name="reportes" class="flat-green">
												Reportes
											</label>
										</div>
										<div class="form-group">
											<label>
												<input type="checkbox" id="opciones" name="opciones" class="flat-green">
												Opciones
											</label>
										</div>
									</div>
								</div>
								<!-- /.box-body -->
							</div>
						</div>

						<div class="">
							<button type="submit" class="btn btn-info btn-md ">
								<span class="glyphicon glyphicon-ok-circle"></span> Crear Usuario
							</button>
							<a href="<?php echo base_url();?>usuarios/CUsuario" class="btn btn btn-default btn-md pull-right">
								<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Cancelar
							</a>
						</div>
						<?php echo form_close(); ?>

					</section>
				</div>
			</div>
		</div>
	</div>
</div>

