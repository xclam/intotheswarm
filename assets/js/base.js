$( document ).ready(function() {

   $(".clickable").on('click', function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        window.location.href = url;
   });
   
	//var t = $('.data-table').DataTable();


});
