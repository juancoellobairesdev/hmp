if(!hmp){
    var hmp = {};
}

hmp.tracking = {
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

    submit: function(){
        var resources = new Array();
        var checkboxes = $("[name='tracking_resources']:checked").map(function () { return $(this).val(); }).get();
        var selects = $("select[name='tracking_resources']").map(function(){
            var resource = {
                resourceId: $(this).attr('resourceId'),
                timesUsed: $(this).val()
            };
            
            return resource;
        }).get();

        var i;
        for(i=0;i<checkboxes.length;i++){
            var resource = {};
            resource.resourceId = checkboxes[i];
            resource.timesUsed = 1;
            resources.push(resource);
        }

        for(i=0;i<selects.length;i++){
            if(selects[i].timesUsed > 0){
                resources.push(selects[i]);
            }
        }

        $.ajax({
            url: hmp.config.url.base + 'tracking/submit',
            data:{
                resources: resources,
                teacherId: $('#teacher').attr('value'),
                reportingMonth: $('#month').val(),
                reportingWeek: $('#week').val()
            },
            type: 'POST',
            dataType: 'json',
            success: function(data){
                if(data.id){
                    $('#notifications ul').html('<li class="form_success">Tracking successfully saved with id ' + data.id + '</li>');
                    hmp.tracking.get_resources();
                }
                else if(data.errors){
                    var i;
                    $('#notifications ul').html('');
                    for(i=0; i < data.errors.length; i++){
                        $('#notifications ul').append('<li class="form_error">' + data.errors[i] + '</li>');
                    }
                }
                else{
                    alert('Unknown error.');
                }
            }
        });
    },

    get_resources: function(){
        $.ajax({
            url: hmp.config.url.base + 'tracking/get_resources',
            data:{
                selected_grade: $('#grades').val(),
                month: $('#month').val(),
            },
            type: 'POST',
            dataType: 'html',
            success: function(data){
                if(data){
                    $('#resources').html(data);
                }
            }
        });
    }
};