/*price range*/

if ($.fn.slider) {
    $('#sl2').slider();
}

var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

function addToCart(pro) {
    console.log(pro);
    $.ajax({
        url : "/cart/add-to-cart",
        type : "post",
        dataType : "text",
        data : {
            data : pro
        },
        success : function (result){
            $('#itemsCart').html("("+result+")");
            $('body').append('<a class="notification-added-cart" href="javascript:;" style="position: fixed; z-index: 2147483647;">Added to cart...</a>');
            setTimeout(function(){
              $('.notification-added-cart').remove();
          }, 400);
        }
    });
}

//search order
$('#form-search-order').on('beforeSubmit', function(e) {
    var form = $(this);
    var formData = form.serialize();
    $("#detail-order").html('');
    $("#loader").append('<div id="block-loader" class="spinner"><div class="dot1"></div><div class="dot2"></div></div>');
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (res) {
            data = $.parseJSON(res);
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    detail_order = $.parseJSON(data[i].details);
                    detail_pro = Object.values(detail_order.details);
                    for (var j = 0; j < detail_pro.length; j++) {
                        var orderDate = new Date(parseInt(data[i].created_at)*1000);
                        var displayOrderDate = orderDate.getUTCDate()+'-'+(orderDate.getUTCMonth() + 1)+'-'+orderDate.getUTCFullYear()+' '+orderDate.getHours() + ':' + ("0" + orderDate.getMinutes()).substr(-2) + ':' + ("0" + orderDate.getSeconds()).substr(-2);
                        var priceItem = parseInt(detail_pro[j].pro_price);
                        var format = priceItem.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                        dataAppend = '<tr><td>'+data[i].order_id+'</td><td>'+data[i].address+'</td><td>'+data[i].mobile+'</td><td>'+data[i].cmnd+'</td><td>'+detail_pro[j].pro_name+'('+format+' VND)</td><td>'+detail_pro[j].quantity+'</td><td>'+displayOrderDate+'</td><td>'+detail_order.type+'</td></tr>';
                        $("#detail-order").append(dataAppend);
                    }
                }
            }
            $("#block-loader").remove();
        },
        error: function () {
            alert("Something went wrong");
        }
    });
}).on('submit', function(e){
    e.preventDefault();
});

/*scroll to top*/

$(document).ready(function () {
    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: 'linear', // Scroll to top easing (see http://easings.net/)
            animation: 'fade', // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });
});
