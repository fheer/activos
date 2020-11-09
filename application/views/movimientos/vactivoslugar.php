<div class="col-md-10">
	<div class="content-box-large">
		<div class="panel-body">
			<div class="panel-title">Lista de Activos fijos de:	<?php echo $nombre; ?>
			</div>
			<section class="content">
				<div class="row">
					<div class="col-md-10">
						<!-- ./col -->
						<?php
						foreach ($foto as $imagen) {
							?>
							<div class="col-lg-4 col-xs-6">
								<!-- small box -->
								<div class="small-box bg-blue">
									<div class="inner" align="center">
										<img src="<?php echo base_url().'fotos/activos/'.$imagen['imagen'];?>" width="140"
											 height="80" >
										<h4 align="center"><?php echo $imagen['nombre']; ?><sup style="font-size: 20px"></sup></h4>
									</div>
									<a href="<?php echo base_url();?>Cpersona/<?php echo $imagen['idActivofijo']; ?>"
									   class="small-box-footer"> Mover <i class="fa fa-arrow-circle-right"></i></a>

								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
				<div class="box-footer">
					<a href="<?php echo base_url();?>movimientos/CMovimiento/listaLugares/1" class="btn btn btn-default btn-lg">
						<span class="fa fa-chevron-left" aria-hidden="true"></span> Volver
					</a>
				</div>
			</section>
		</div>
	</div>
</div>
</div>
</div>
