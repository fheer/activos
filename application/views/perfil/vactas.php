<div class="col-md-10">
	<div class="content-box-large">
		<div class="panel-body">
			<div class="panel-title">Mis Actas...</div>
			<br><br><br>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
				<thead>
				<tr>
					<th width="5%" align="center">No</th>
					<th width="10%">Acta</th>
					<th width="15%">Tipo</th>
					<th width="15%">Fecha</th>
					<th width="10%">Opciones</th>
				</tr>
				</thead>
				<tbody>
				<?php $i = 1; foreach ($actas as $row) { ?>
					<tr class="gradeA">
						<td align="center"><?php echo $i; ?></td>
						<td>
							<a href="<?php echo base_url().'actas/'.$row['url']; ?>" target="_blank"><?php echo $row['url']; ?></a>
						</td>
						<td>
							<?php
							if ($row['tipo'] == 'E'){
								echo 'Entrega';
							}else if ($row['tipo'] == 'L'){
								echo "Devolución";
							}else if ($row['tipo'] == 'R'){
								echo "Reposición";
							}
							?>
						</td>
						<td><?php echo $row['fecha']; ?></td>
						<td>
							<button type="submit" class="btn btn-default">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>
						</td>
					</tr>
					<?php $i++;	} ?>
				</tbody>
			</table>
		</div>
	</div>
