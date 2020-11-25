		<div class="col-md-10">
			<div class="content-box-large">
				<div class="panel-body">
					<section class="content">
						<div class="row">
							<div class="col-md-10">
								<div class="col-md-4 col-xs-6">
									<div class="info-box">
										<span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

										<div class="info-box-content">
											<span class="fa fa-users fa-2x"></span>
											<span class="info-box-text">Personal <?php echo $countPersona;?></span>
											<span class="info-box-number">
												<a href="<?php echo base_url();?>Cpersona" class="small-box-footer">Mostrar <i class="fa fa-arrow-circle-right"></i></a>
											</span>
										</div>
										<!-- /.info-box-content -->
									</div>
									<!-- /.info-box -->
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
</div>
		<?php
		if(strtolower($this->session->userdata('s_nuevo')) == 's') :
			?>
			<script>
				$(document).ready(function(){
					$("#modalNuevo").modal("show");
				});
			</script>
		<?php endif; ?>
		<!-- Modal -->
		<div class="modal fade" id="modalNuevo" data-backdrop="static" data-keyboard="false" role="dialog">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title">Gestión de Activos Fijos</h6>
					</div>
					<div class="modal-body">
						<h5 align="center">Debe cambiar su contraseña por ser la primera ves que inicia sesión</h5>
					</div>
					<div class="modal-footer">
						<?php echo form_open(base_url()."perfil/CPerfil/change_password/"); ?>
						<button type="submit" class="btn btn-success center-block">Aceptar</button>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
