function readURL(input,id) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#'+id+'')
			.attr('src', e.target.result);                
		};
		reader.readAsDataURL(input.files[0]);
	}
}
$(document).ready(function(){
	$("#product-date_sale_off").datepicker({ dateFormat: 'dd-mm-yy' });
	$("#product-end_cate_sale").datepicker({ dateFormat: 'dd-mm-yy' });
  $("#proImg").click(function(event) {
    $("myModal").modal();
  });
});
