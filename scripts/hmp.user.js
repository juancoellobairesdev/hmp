if(!hmp){
    var hmp = {};
}

hmp.user = {
    page: function(page){
        $.ajax({
            url: hmp.config.url.base + 'school/get_page',
            data:{
                page: page
            },
            type: 'POST',
            dataType: 'html',
            success: function(data){
                if(data){
                    $('#schools').html(data);
                    var last = $("#pagination_top [name='last']").attr('value');
                    prev = (page > 1)? page - 1: 1;
                    next = (page < last)? page + 1: page;
                    $("#pagination_top [name='prev']").attr('onclick', 'hmp.school.page(' + prev + ')');
                    $("#pagination_top [name='prev']").attr('value', 'hmp.school.page(' + prev + ')');
                    $("#pagination_top [name='current']").attr('value', page).html(page);
                    $("#pagination_top [name='next']").attr('onclick', 'hmp.school.page(' + next + ')');
                    $("#pagination_top [name='next']").attr('value', 'hmp.school.page(' + next + ')');
                    $("#pagination_bottom [name='prev']").attr('onclick', 'hmp.school.page(' + prev + ')');
                    $("#pagination_bottom [name='prev']").attr('value', 'hmp.school.page(' + prev + ')');
                    $("#pagination_bottom [name='current']").attr('value', page).html(page);
                    $("#pagination_bottom [name='next']").attr('onclick', 'hmp.school.page(' + next + ')');
                    $("#pagination_bottom [name='next']").attr('value', 'hmp.school.page(' + next + ')');
                }
                else{
                    alert('An error ocurred, please, try again later');
                }
            }
        });
    },

    forgot_password:{
        i_am_teacher: function(){
            if($('#iAmTeacher').is(':checked')){
                $('#gradeLevel').enable(true);
            }
            else{
                $('#gradeLevel').enable(false);
            }
        }
    }
};