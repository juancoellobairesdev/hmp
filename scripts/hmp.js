if(!hmp){
    var hmp = {};
}

hmp = {
    page: function(controller, page){
        $.ajax({
            url: hmp.config.url.base + controller + '/get_page',
            data:{
                page: page
            },
            type: 'POST',
            dataType: 'json',
            success: function(data){
                if(data.pagination_html){
                    $('#pagination_top,#pagination_bottom').html(data.pagination_html);
                }
                if(data.view){
                    $('#' + controller).html(data.view);
                }
                else{
                    alert('An error ocurred, please, try again later');
                }
            }
        });
    },

    scroll: function(element){
        $('html, body').animate({
            scrollTop: $(element).offset().top
        }, 500);
    }
};

$(document).ready(function(){
    $('ul li:has(ul)').hover(
        function(e){
            $(this).find('ul').css({display: "block"});
            },
        function(e){
            $(this).find('ul').css({display: "none"});
        }
    );
 });