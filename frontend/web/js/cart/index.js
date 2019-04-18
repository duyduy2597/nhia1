function quantityUpdate(pro,param) {

    var quantity = 0;
    if (param == 'up') {
        $.ajax({
            url : "/cart/update-quantity",
            type : "post",
            dataType : "text",
            data : {
                data : pro,
                param : param,
                currentQuantity:$("#quantity-item-"+pro.id+"").val()
            },
            success : function (result){
                $("#displayCartTotal").html(result);
            }
        });
        quantity = parseInt($("#quantity-item-"+pro.id+"").val()) + 1;
    }else if (param == 'down'){
        quantity = parseInt($("#quantity-item-"+pro.id+"").val()) - 1;
        if (quantity == 0) {
            return ;
        }
        $.ajax({
            url : "/cart/update-quantity",
            type : "post",
            dataType : "text",
            data : {
                data : pro,
                param : param,
                currentQuantity:$("#quantity-item-"+pro.id+"").val()
            },
            success : function (result){
                $("#displayCartTotal").html(result);
            }
        });
    }
    newTotal = parseInt(pro.pro_price) * quantity;
    format = newTotal.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    $("#quantity-item-"+pro.id+"").attr('value',quantity);
    $("#total-item-"+pro.id+"").html(format);
}

function removeItemFromCart(id) {
    $.ajax({
        url : "/cart/remove-item-from-cart",
        type : "post",
        dataType : "text",
        data : {
            id : id
        },
        success : function (result){
            if (result == 0) {
                location.reload();
            }else{
                $('#cart-item-'+id+'').remove();
                $("#displayCartTotal").html(result);
            }
        }
    });
}