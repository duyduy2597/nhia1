var offset = 0;
var limit = 4;
var stopped = false;
var url = window.location.href;
var id = getUrlParameters("id", url, true);
function loadMoreComment(pro_id,limitComment = 0,offsetComment = 0) {
    if (stopped) {
        return;
    }
    $.ajax({
        url : "/site/load-more-comment",
        type : "get",
        dataType : "json",
        data : {
            id : pro_id,
            offset : offset,
            limit : limit
        },
        success : function (rs){
            result = rs.data;
            if (result.length > 0) {
                if (offset == 0) {
                    $('#block-btnLoadMoreComment').append('<a id="btnLoadMoreComment" style="width: 100%;" onclick="loadMoreComment('+id+')" href="javascript:;" class="btn btn-default">Load more</a>');
                }
                for (var i = 0; i < result.length; i++) {
                    data = '<li class="media"><a href="javascript:;" class="pull-left"><img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle img-responsive"></a><div class="media-body"><span class="text-muted pull-right"><small class="text-muted">'+result[i].display_time_comment+'</small></span><strong class="text-success">'+result[i].user.name+'</strong><p>'+result[i].content+'</p></div></li>';
                    $("#list-comment").append(data);
                }
                offset += result.length;
                if (rs.status == false) {
                    $("#btnLoadMoreComment").remove();
                    stopped = true;
                }
            }else{
                $("#btnLoadMoreComment").remove();
                stopped = true;
            }
        }
    });
}

function getUrlParameters(parameter, staticURL, decode){

   var currLocation = (staticURL.length)? staticURL : window.location.search,
   parArr = currLocation.split("?")[1].split("&"),
   returnBool = true;

   for(var i = 0; i < parArr.length; i++){
    parr = parArr[i].split("=");
    if(parr[0] == parameter){
        return (decode) ? decodeURIComponent(parr[1]) : parr[1];
        returnBool = true;
    }else{
        returnBool = false;            
    }
}

if(!returnBool) return false;  
}

loadMoreComment(id);