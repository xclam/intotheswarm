$( document ).ready(function() {

	var t = $('.data-table').DataTable();

	$('#addRow').on( 'click', function (e) {
		e.preventDefault();
		
		var bool = true;
		$('.data-table :input[required]').each( function(k,v){
			if( !$(this).val()){
				bool = false;
			}
		});
		
		if(bool){
			t.row.add([
				'<input type="text" class="form-control" name="poste-poste[]" required>',
				'<input type="text" class="form-control" name="poste-description[]" >'
			]).draw();
		}
    } );
});
