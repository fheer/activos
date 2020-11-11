$(document).ready(function() {
        $('#example').DataTable(
			{
				'paging': true,
				'info': true,
				'filter': true,
				'stateSave': true,

				'oLanguage':{
					"sUrl":baseurl+"assets/js/dataTables.spanish.txt"
				},

				'columns': [

				],
			});
} );
