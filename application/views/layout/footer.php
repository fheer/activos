	</div>
</div>

<footer>
	<div class="container">
		<div class="copy text-center">
			Copyright <?php echo date('Y'); ?> <a href='#'>Incos - Nocturno</a>
		</div>
	</div>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery.js"></script>
<!-- <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> -->
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<link href="<?php echo base_url(); ?>assets/vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

<script src="<?php echo base_url();?>assets/plugins/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/plugins/js/demo.js"></script>
<!-- DataTables -->
<!-- Include all compiled plugins (below), or include individual files as needed <script src="<?php //echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/vendors/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<script src="<?php echo base_url(); ?>assets/js/tables.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-slider/bootstrap-slider.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/form-helpers/js/bootstrap-formhelpers.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/select/bootstrap-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/tags/js/bootstrap-tags.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/mask/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
<!-- bootstrap-datetimepicker -->
<link href="<?php echo base_url(); ?>assets/vendors/bootstrap-datetimepicker/datetimepicker.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>

<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/forms.js"></script>

<script>
		$("#sendform1").click(function () {
			$.post('<?= site_url('Cpersona/addNew') ?>', $('#form1').serialize(), function (data) {
				if (data.code === 1)
				{
					if (data.ci != '') {
						$("#fci").removeClass('alert-success').addClass('text-danger').removeClass('hidden').html(data.ci);
					}
					else{
						$("#fci").addClass('hidden');
					}

					if (data.nombre != '') {
						$("#fnombre").removeClass('alert-success').addClass('alert-danger').removeClass('hidden').html(data.nombre);
					}
					else{
						$("#fnombre").addClass('hidden');
					}
					if (data.apellidoPaterno != '') {
						$("#fapellidoPaterno").removeClass('alert-success').addClass('text-danger').removeClass('hidden').html(data.apellidoPaterno);
					}
					else{
						$("#fapellidoPaterno").addClass('hidden');
					}

					if (data.apellidoMaterno != '') {
						$("#fapellidoMaterno").removeClass('alert-success').addClass('alert-danger').removeClass('hidden').html(data.apellidoMaterno);
					}
					else{
						$("#fapellidoMaterno").addClass('hidden');
					}

					if (data.direccion != '') {
						$("#fdireccion").removeClass('alert-success').addClass('text-danger').removeClass('hidden').html(data.direccion);
					}
					else{
						$("#fdireccion").addClass('hidden');
					}

					if (data.telefono != '') {
						$("#ftelefono").removeClass('alert-success').addClass('alert-danger').removeClass('hidden').html(data.telefono);
					}
					else{
						$("#ftelefono").addClass('hidden');
					}
					if (data.email != '') {
						$("#femail").removeClass('alert-success').addClass('text-danger').removeClass('hidden').html(data.email);
					}
					else{
						$("#femail").addClass('hidden');
					}

					if (data.cargo != '') {
						$("#fcargo").removeClass('alert-success').addClass('alert-danger').removeClass('hidden').html(data.cargo);
					}
					else{
						$("#fcargo").addClass('hidden');
					}

				} else {
					$("#fci").addClass('hidden');
					$("#fnombre").addClass('hidden');
					$("#fapellidoPaterno").addClass('hidden');
					$("#fapellidoMaterno").addClass('hidden');
					$("#fdireccion").addClass('hidden');
					$("#ftelefono").addClass('hidden');
					$("#femail").addClass('hidden');
					$("#fcargo").addClass('hidden');
					$('#userModal').modal('hide');
				}
			}, 'json');
		});
	</script>

<script type="text/javascript">
	var id;
	var enlace;
	var modal;
	$('#modalDelete').on('show.bs.modal', function (event) {
		enlace = $(event.relatedTarget) // Button that triggered the modal
		id = enlace.data('whatever') // Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		modal = $(this)
		modal.find('.modal-title').text('Eliminar Registro')
		modal.find('.modal-body h4').text('¿Es seguro que quiere Eliminar el Registro?')
		modal.find('.modal-body input').val(id)
	});
</script>
<script>
		$(function () {
			//Initialize Select2 Elements
			$(".select2").select2();
			//Datemask dd/mm/yyyy
			$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
			//Datemask2 mm/dd/yyyy
			$("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
			//Date picker
			$('#datepicker').datepicker({
				autoclose: true
			});
		});
	</script>
</body>
</html>
