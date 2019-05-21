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

function viewDetailOrder(id) {
	$.ajax({
		url : "/order/search-detail",
		type : "post",
		dataType : "json",
		data : {
			id : id,           
		},
		success : function (result){
			buyerInfor = '<tr><td></td><td>'+result.buyer.cmnd+'</td><td>'+result.buyer.address+'</td></tr>';
			$("#buyer-info").html(buyerInfor);
			arrDetails = Object.values(result.details);
			dataDetails = '';
			total = 0;
			for (var i = 0; i < arrDetails.length; i++) {
				thanhTien = parseInt(arrDetails[i].quantity) * parseInt(arrDetails[i].pro_price);
				dataDetails += '<tr><td>'+arrDetails[i].pro_name+'</td><td><img src="'+arrDetails[i].imageSrc+'" width="150" height="150" alt="'+arrDetails[i].pro_name+'"></td><td>'+arrDetails[i].quantity+'</td><td>'+arrDetails[i].pro_price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')+' VNĐ</td><td>'+thanhTien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')+' VNĐ</td></tr>';
				total += thanhTien;
			}
			dataDetails += '<tr><td></td><td></td><td></td><td></td><td><b>Total: </b>'+total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')+' VNĐ</td></tr>';
			$("#details-order").html(dataDetails);
			$('#modalDetailOrder').modal('toggle');           
		}
	});
}

$(document).ready(function(){
	$("#product-date_sale_off").datepicker({ dateFormat: 'dd-mm-yy' });
	$("#product-end_cate_sale").datepicker({ dateFormat: 'dd-mm-yy' });
	$("#proImg").click(function(event) {
		$("myModal").modal();
	});
});
