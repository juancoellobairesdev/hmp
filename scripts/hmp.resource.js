if(!hmp){
    var hmp = {};
}

hmp.resource = {
    page: function(page){
        $.ajax({
            url: hmp.config.url.base + 'resource/get_page',
            data:{
                page: page
            },
            type: 'POST',
            dataType: 'html',
            success: function(data){
                if(data){
                    $('#resources').html(data);
                    var last = $("#pagination_top [name='last']").attr('value');
                    prev = (page > 1)? page - 1: 1;
                    next = (page < last)? page + 1: page;
                    $("#pagination_top [name='prev']").attr('onclick', 'hmp.resource.page(' + prev + ')');
                    $("#pagination_top [name='prev']").attr('value', 'hmp.resource.page(' + prev + ')');
                    $("#pagination_top [name='current']").attr('value', page).html(page);
                    $("#pagination_top [name='next']").attr('onclick', 'hmp.resource.page(' + next + ')');
                    $("#pagination_top [name='next']").attr('value', 'hmp.resource.page(' + next + ')');
                    $("#pagination_bottom [name='prev']").attr('onclick', 'hmp.resource.page(' + prev + ')');
                    $("#pagination_bottom [name='prev']").attr('value', 'hmp.resource.page(' + prev + ')');
                    $("#pagination_bottom [name='current']").attr('value', page).html(page);
                    $("#pagination_bottom [name='next']").attr('onclick', 'hmp.resource.page(' + next + ')');
                    $("#pagination_bottom [name='next']").attr('value', 'hmp.resource.page(' + next + ')');
                }
                else{
                    alert('An error ocurred, please, try again later');
                }
            }
        });
    },

    save: function(){
        var resource = {};
        resource.id = $('#id').val();
        resource.categoryId = $('#categoryId').val();
        resource.title = $('#title').val();
        resource.minutesPerUse = $('#minutesPerUse').val();
        resource.maximumUsesPerYear = $('#maximumUsesPerYear').val();
        resource.nutrition = $('#nutrition').val();
        resource.minGrade = $('#minGrade').val();
        resource.maxGrade = $('#maxGrade').val();
        resource.enabled = $('#enabled').val();
        resource.weight = $('#weight').val();

        $.ajax({
            url: hmp.config.url.base + 'resource/save',
            data:{
                resource: resource
            },
            type: 'POST',
            dataType: 'json',
            success: function(data){
                if(data.id){
                    $('#notifications ul').html('<li class="form_success">Resource successfully saved with id ' + data.id + '</li>');
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