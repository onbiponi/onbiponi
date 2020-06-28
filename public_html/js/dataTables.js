/* Responsive table with sorting */
$(document).ready(function() {
    if($('#dataTables').length)
		$('#dataTables').DataTable( {
			responsive: {
				details: {
					type: 'column',
					target: 'tr'
				}
			},
			columnDefs: [ {
				className: 'control',
				orderable: false,
				targets:   0
			} ],
			order: [ 0, 'desc' ]
		});
	if($('#dataTables-export').length)
		$('#dataTables-export').DataTable( {
			responsive: {
				details: {
					type: 'column',
					target: 'tr'
				}
			},
			columnDefs: [ {
				className: 'control',
				orderable: false,
				targets:   0
			} ],
			order: [ 0, 'desc' ],
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			]
		});
});