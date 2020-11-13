<?php
$this->load->model('Activofijo_model');
$tipoactivofijo = $this->Activofijo_model->get_all_tipoactivofijo();
$estado = $this->Activofijo_model->get_all_estado();
$tipoAc = $this->Activofijo_model->getEstado($idTipoActivoFijo);
?>
<div class="col-md-10">
	<div class="content-box-large">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<?php echo form_open_multipart(base_url().'activos/Cactivofijo/edit',array("class"=>"form-horizontal")); ?>
					<div class="form-group">
						<label for="tipo" class="col-md-3 control-label"><span class="text-danger">*</span> Tipo</label>
						<div class="col-md-6">
							<select name="idTipoActivoFijo" id="idTipoActivoFijo" class="form-control">
								<option><?php echo $tipoAc; ?></option>
								<?php
								foreach ($tipoactivofijo  as $row)
								{
									echo '<option value="'.$row['idTipoActivoFijo'].'" >'.$row['tipo'].'</option>';
								}
								?>
							</select>
							<span class="text-danger"><?php echo form_error('cargo');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="codigo" class="col-md-3 control-label"><span class="text-danger">*</span> Código</label>
						<div class="col-md-4">
							<input type="hidden"  class="form-control input-sm" name="idActivofijo" id="idActivofijo"
								   value="<?php echo trim($idActivofijo); ?>" />
							<input type="text"  class="form-control input-sm" name="codigo" id="codigo"
								   value="<?php echo trim($codigo); ?>" />
							<span class="text-danger"><?php echo form_error('codigo');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="numeroSerie" class="col-md-3 control-label"><span class="text-danger">*</span> Número de serie</label>
						<div class="col-md-5">
							<input type="text" name="numeroSerie" id="numeroSerie" class="form-control"
								   value="<?php echo trim($numeroSerie); ?>"/>
							<span class="text-danger"><?php echo form_error('numeroSerie');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="nombre" class="col-md-3 control-label"><span class="text-danger">*</span> Nombre Activo fijo</label>
						<div class="col-md-6">
							<input type="text" name="nombre" id="nombre"
								   value="<?php echo trim($nombre); ?>" class="form-control"  />
							<span class="text-danger"><?php echo form_error('nombre');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="nombre" class="col-md-3 control-label"><span class="text-danger">*</span> Descripción Activo fijo</label>
						<div class="col-md-6">
							<input type="texta" name="descripcion" id="descripcion"
								   value="<?php echo trim($descripcion); ?>" class="form-control"  />
							<span class="text-danger"><?php echo form_error('descripcion');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="estado" class="col-md-3 control-label"><span class="text-danger">*</span> Estado</label>
						<div class="col-md-4">
							<select name="idEstado" id="idEstado" class="form-control">
								<option><?php echo $nombreEstado;?></option>
								<?php
								foreach ($estado  as $row)
								{
									echo '<option value="'.$row['estado'].'" >'.$row['estado'].'</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="dia" class="col-md-3 control-label"><span class="text-danger">*</span> Fecha de compra Día/Mes/año</label>
						<div class='col-sm-2'>
							<select name="dia" id="dia" class="form-control">
								<?php
								for ($i=1;$i<32;$i++){
									echo '<option value="'.$i.'" >'.$i.'</option>';
								}
								?>
							</select>
						</div>
						<div class='col-sm-4'>
							<select name="mes" id="mes" class="form-control">
								<option value="1">Enero</option>
								<option value="2">Febrero</option>
								<option value="3">Marzo</option>
								<option value="4">Abril</option>
								<option value="5">Mayo</option>
								<option value="6">Junio</option>
								<option value="7">Julio</option>
								<option value="8">Agosto</option>
								<option value="9">Septiembre</option>
								<option value="10">Octubre</option>
								<option value="11">Noviembre</option>
								<option value="12">Diciembre</option>
							</select>
						</div>
						<div class='col-sm-3'>
							<select name="anio" id="anio" class="form-control">
								<?php
								$anioActual = date("Y");
								$anioInicial = $anioActual - 20;
								for ($i=$anioInicial;$i<=$anioActual;$i++){
									echo '<option value="'.$i.'" >'.$i.'</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="valorInicial" class="col-md-3 control-label"><span class="text-danger">*</span> Valor inical</label>
						<div class="col-md-3">
							<input type="text" name="valorInicial" id="valorInicial"
								   value="<?php echo trim($valorInicial); ?>" class="form-control"  />
							<span class="text-danger"><?php echo form_error('valorInicial');?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="archivo" class="col-md-3 control-label">Imagen</label>
						<div class="col-md-5">
							<input type="hidden" name="option" class="form-control" id="option" value="<?php echo 1; ?>" />
							<input type="hidden" name="foto" class="form-control" id="foto" value="<?php echo trim($imagen); ?>" />
							<input type="file" name="archivo"  id="archivo">
						</div>
					</div>


					<div class="box-footer">
						<a href="<?php echo base_url();?>activos/Cactivofijo/" class="btn btn btn-default btn-md pull-right">
							<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Cancelar
						</a>
						<button type="submit" class="btn btn-info btn-md "> <span class="glyphicon glyphicon-ok-circle"></span> Guardar</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>

