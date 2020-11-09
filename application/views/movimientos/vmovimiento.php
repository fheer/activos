			<div class="col-md-10">
				<div class="content-box-large">
					<div class="panel-body">
						<div class="panel-title">Oficinas/Laboratorios/Aulas</div>
						<section class="content">
							<div class="row">
								<div class="col-md-10">
									<!-- ./col -->
									<?php
									foreach ($lugares as $lugar) {
									?>
									<div class="col-lg-4 col-xs-6">
										<!-- small box -->
										<div class="small-box bg-green">
											<div class="inner">
												<h4 class="fa fa-building-o fa-2x">
												<?php //echo $lugar['lugar']; ?><sup style="font-size: 20px"></sup>
												</h4>
												<br>
												<h4><?php echo $lugar['lugar']; ?><sup style="font-size: 20px"></sup></h4>
											</div>
											<a href="<?php echo base_url();?>movimientos/Cmovimiento/listaActivosLugar/<?php echo $lugar['idLugar']; ?>" class="small-box-footer">Mostrar <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
										<?php
									}
									?>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
