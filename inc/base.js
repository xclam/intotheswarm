$( document ).ready(function() {

   $(".clickable").on('click', function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        window.location.href = url;
   });
   
	var t = $('.data-table').DataTable();

	$('#addRow').on( 'click', function (e) {
		e.preventDefault();
		console.log(t.fnSettings().aoColumns.length);
        t.row.add().draw();
    } );
});
