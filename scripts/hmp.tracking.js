if(!hmp){
    var hmp = {};
}

hmp.tracking = {
    enter: {
        submit: function(){
            var resources = new Array();
            var selects = $("select[name='tracking_resources']").map(function(){
                var resource = {
                    resourceId: $(this).attr('resourceId'),
                    timesUsed: $(this).val(),
                    checked: $('#' + $(this).attr('resourceId')).is(':checked')
                };
                
                return resource;
            }).get();

            var i;

            for(i=0;i<selects.length;i++){
                if(selects[i].checked){
                    resources.push(selects[i]);
                }
            }

            $.ajax({
                url: hmp.config.url.base + 'tracking/submit_enter',
                data:{
                    resources: resources,
                    teacherId: $('#teacher').val(),
                    grade: $('#grade').val(),
                    reportingMonth: $('#month').val(),
                    reportingWeek: $('#week').val()
                },
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    if(data.id){
                        $('#notifications ul').html('<li class="form_success">Tracking successfully saved with id ' + data.id + '</li>');
                        hmp.tracking.enter.get_resources();
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
                    
                    hmp.scroll('#notifications');
                }
            });
        },

        get_resources: function(){
            $.ajax({
                url: hmp.config.url.base + 'tracking/get_resources',
                data:{
                    month: $('#month').val(),
                    teacherId: $('#teacher').val(),
                    schoolId: $('#school').val(),
                    grade: $('#grade').val()
                },
                type: 'POST',
                dataType: 'html',
                success: function(data){
                    if(data){
                        $('#resources').html(data);
                    }
                }
            });
        },

        get_teachers: function(){
            $.ajax({
                url: hmp.config.url.base + 'tracking/get_teachers',
                data:{
                    schoolId: $('#school').val()
                },
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    if(data){
                        $('#teacher option').remove();
                        $.each(data, function(){
                            $('#teacher').append($("<option />").val(this.id).text(this.name));
                        });
                    }

                    $('#teacher').prop('disabled', $('#teacher option').length <= 1);
                    hmp.tracking.enter.get_grades();
                }
            });
        },

        get_grades: function(){
            $.ajax({
                url: hmp.config.url.base + 'tracking/get_grades',
                data:{
                    teacherId: $('#teacher').val()
                },
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    if(data){
                        $('#grade option').remove();
                        $.each(data, function(index, value){
                            $('#grade').append($("<option />").val(index).text(value));
                        });
                    }

                    $('#grade').prop('disabled', $('#grade option').length <= 1);

                    hmp.tracking.enter.get_resources();
                }
            });
        }
    },

    unverified: {
        get_trackings: function(){
            $.ajax({
                url: hmp.config.url.base + 'tracking/get_trackings',
                data:{
                    schoolId: $('#school').val(),
                },
                type: 'POST',
                dataType: 'html',
                success: function(data){
                    if(data){
                        $('#trackings').html(data);
                    }
                }
            });
        },

        select_all: function(){
            $("[name='tracking']").each(function(){
                $(this).prop('checked', $('#select_all').is(':checked'));
            });
            var text = $('#select_all').is(':checked')? 'None': 'All';
            $('#select_all_text').html('Select ' + text);
        },

        submit: function(){
            $.ajax({
                url: hmp.config.url.base + 'tracking/submit_unverified',
                data:{
                    select_submit: $('#select_submit select').val(),
                    trackingIds: $("[name='tracking']:checked").map(function () { return $(this).val(); }).get(),
                },
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    if(data.success){
                        $('#notifications ul').html('<li class="form_success">Success.</li>');
                        hmp.tracking.unverified.get_trackings();
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
        }
    }

};