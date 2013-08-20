if(!hmp){
    var hmp = {};
}

hmp.category = {
    page: function(page){
        $.ajax({
            url: hmp.config.url.base + 'category/get_page',
            data:{
                page: page
            },
            type: 'POST',
            dataType: 'html',
            success: function(data){
                if(data){
                    $('#categories').html(data);
                    var last = $("#pagination_top [name='last']").attr('value');
                    prev = (page > 1)? page - 1: 1;
                    next = (page < last)? page + 1: page;
                    $("#pagination_top [name='prev']").attr('onclick', 'hmp.category.page(' + prev + ')');
                    $("#pagination_top [name='prev']").attr('value', 'hmp.category.page(' + prev + ')');
                    $("#pagination_top [name='current']").attr('value', page).html(page);
                    $("#pagination_top [name='next']").attr('onclick', 'hmp.category.page(' + next + ')');
                    $("#pagination_top [name='next']").attr('value', 'hmp.category.page(' + next + ')');
                    $("#pagination_bottom [name='prev']").attr('onclick', 'hmp.category.page(' + prev + ')');
                    $("#pagination_bottom [name='prev']").attr('value', 'hmp.category.page(' + prev + ')');
                    $("#pagination_bottom [name='current']").attr('value', page).html(page);
                    $("#pagination_bottom [name='next']").attr('onclick', 'hmp.category.page(' + next + ')');
                    $("#pagination_bottom [name='next']").attr('value', 'hmp.category.page(' + next + ')');
                }
                else{
                    alert('An error ocurred, please, try again later');
                }
            }
        });
    },

    save: function(){
        var category = {};
        category.id = $('#id').val();
        category.name = $('#name').val();
        category.minCohort = $('#minCohort').val();
        category.maxCohort = $('#maxCohort').val();
        category.weight = $('#weight').val();

        $.ajax({
            url: hmp.config.url.base + 'category/save',
            data:{
                category: category
            },
            type: 'POST',
            dataType: 'json',
            success: function(data){
                if(data.id){
                    $('#notifications ul').html('<li class="form_success">Category successfully saved with id ' + data.id + '</li>');
                }
                else if(data.errors){
                    var i;
                    $('#notifications ul').html('');
                    for(i=0; i < data.errors.length; i++){
                        $('#notifications ul').append('<li class="form_error">' + data.errors[i] + '</li>')
                    }
                }
                else{
                    alert('Unknown error.');
                }
            }
        });
    }
};