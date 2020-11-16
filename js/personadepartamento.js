var baseurl = '<?php echo base_url();?>';
document.getElementById('idDepartamento').onchange = function() {
	/* Referencia al option seleccionado */
	var mOption = this.options[this.selectedIndex];
	/* Referencia a los atributos data de la opción seleccionada */
	var mData = mOption.dataset;
	/* Referencia al input */
	//var elUser = document.getElementById('user');
	var sel = document.getElementById("idPersona");
	$.ajax({
		type: "POST",
		url: baseurl+"departamento/CDepartamento/get_persona_by_departamento/" + this.value,
		success: function(data){
			//alert(data.length);
			if(data.length === 2) {
				sel.remove(sel.selectedIndex);
			}else{
				sel.remove(sel.selectedIndex);
				var c = JSON.parse(data);
				$.each(c,function(i,item){
					$('#idPersona').append('<option value="'+item.idPersona+'">'+item.nombre+'</option>');
				});
			}
		}
	});
};
