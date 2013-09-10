if(!hmp){
    var hmp = {};
}

hmp.report = {
    by_teacher: {
        search: function(){
            $.ajax({
                url: hmp.config.url.base + 'report/search_by_teacher',
                data:{
                    schoolId: $('#school').val(),
                    teacherId: $('#teacher').val(),
                    year: $('#year').val(),
                    month: $('#month').val(),
                    grade: $('#grade').val(),
                    order_by: $('#order_by').val(),
                    side: $('#order_by').attr('side')
                },
                type: 'POST',
                dataType: 'html',
                success: function(data){
                    if(data){
                        $('#report').html(data);
                    }
                }
            });
        },

        get_teachers: function(){
            $.ajax({
                url: hmp.config.url.base + 'report/get_teachers_by_school',
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
                }
            });
        },

        order_by: function(field){
            var order_by = $('#order_by');
            if(order_by.val() != field){
                order_by.val(field);
                order_by.attr('side', 'asc');
            }
            else{
                if(order_by.attr('side') == 'asc'){
                    order_by.attr('side', 'desc').val(field);
                }
                else{
                    order_by.attr('side', 'asc').val(field);
                }
            }

            hmp.report.by_teacher.search();
        },

        download: function(){
            $.ajax({
                url: hmp.config.url.base + 'report/download_by_teacher',
                data:{
                    schoolId: $('#school').val(),
                    teacherId: $('#teacher').val(),
                    year: $('#year').val(),
                    month: $('#month').val(),
                    grade: $('#grade').val(),
                    order_by: $('#order_by').val(),
                    side: $('#order_by').attr('side')
                },
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    if(data.url){
                        $('#notifications ul').html('<li class="form_success">Download ready on ' + data.url + '</li>');
                        document.location = data.url;
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
    },

    by_school: {
        search: function(){
            $.ajax({
                url: hmp.config.url.base + 'report/search_by_school',
                data:{
                    districtId: $('#district').val(),
                    schoolId: $('#school').val(),
                    date: $('input[name="date"]:checked').val(),
                    year: $('#year').val(),
                    month: $('#month').val(),
                    andMonth: $('#andMonth').val(),
                    late: $('#late').val(),
                    cohort: $('#cohort').val(),
                    verified: $('input[name="verified"]:checked').val() == '1',
                    afterDate: $('#afterDate').val(),
                    order_by: $('#order_by').val(),
                    side: $('#order_by').attr('side')
                },
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    if(data.view){
                        $('#report').html(data.view);
                        $('#notifications ul').html('');
                    }
                    if(data.errors){
                        var i;
                        $('#notifications ul').html('');
                        for(i=0; i < data.errors.length; i++){
                            $('#notifications ul').append('<li class="form_error">' + data.errors[i] + '</li>')
                        }
                    }
                }
            });
        },

        get_schools: function(){
            $.ajax({
                url: hmp.config.url.base + 'report/get_schools_by_district',
                data:{
                    districtId: $('#district').val()
                },
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    var select = $('#school');
                    var options = $('#school option').remove();
                    if(data){
                        var select = $('#school');
                        $('#school option').remove();
                        $.each(data, function(){
                            select.append($("<option />").val(this.id).text(this.name));
                        });
                    }
                    else{
                        $('#school option').remove();
                    }

                    select.prop('disabled', $('#school option').length <= 1);
                }
            });
        },

        order_by: function(field){
            var order_by = $('#order_by');
            if(order_by.val() != field){
                order_by.val(field);
                order_by.attr('side', 'asc');
            }
            else{
                if(order_by.attr('side') == 'asc'){
                    order_by.attr('side', 'desc').val(field);
                }
                else{
                    order_by.attr('side', 'asc').val(field);
                }
            }

            hmp.report.by_school.search();
        },

        verified: function(){
            $('#afterDate').prop('disabled', $('input[name="verified"]:checked').val() == '0');
        },

        date: function(){
            if($('input[name="date"]:checked').val() == '0'){
                $('#monthBetween').hide();
                if($('#month option[value="0"]')){
                    $('#month').prepend($("<option />").val(0).text('Any'));
                }
            }
            else{
                $('#monthBetween').css('display', 'inline');
                $('#month option[value="0"]').remove();
            }
        },

        download: function(){
            $.ajax({
                url: hmp.config.url.base + 'report/download_by_school',
                data:{
                    districtId: $('#district').val(),
                    schoolId: $('#school').val(),
                    date: $('input[name="date"]:checked').val(),
                    year: $('#year').val(),
                    month: $('#month').val(),
                    andMonth: $('#andMonth').val(),
                    late: $('#late').val(),
                    cohort: $('#cohort').val(),
                    verified: $('input[name="verified"]:checked').val() == '1',
                    afterDate: $('#afterDate').val(),
                    order_by: $('#order_by').val(),
                    side: $('#order_by').attr('side')
                },
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    if(data.url){
                        $('#notifications ul').html('<li class="form_success">Download ready on ' + data.url + '</li>');
                        document.location = data.url;
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
    },

    by_resource: {
        search: function(){
            $.ajax({
                url: hmp.config.url.base + 'report/search_by_resource',
                data:{
                    year: $('#year').val(),
                    schoolId: $('#school').val(),
                    grade: $('#grade').val(),
                    cohort: $('#cohort').val(),
                    order_by: $('#order_by').val(),
                    side: $('#order_by').attr('side')
                },
                type: 'POST',
                dataType: 'html',
                success: function(data){
                    if(data){
                        $('#report').html(data);
                    }
                }
            });
        },

        order_by: function(field){
            var order_by = $('#order_by');
            if(order_by.val() != field){
                order_by.val(field);
                order_by.attr('side', 'asc');
            }
            else{
                if(order_by.attr('side') == 'asc'){
                    order_by.attr('side', 'desc').val(field);
                }
                else{
                    order_by.attr('side', 'asc').val(field);
                }
            }

            hmp.report.by_resource.search();
        },

        download: function(){
            $.ajax({
                url: hmp.config.url.base + 'report/download_by_resource',
                data:{
                    year: $('#year').val(),
                    schoolId: $('#school').val(),
                    grade: $('#grade').val(),
                    cohort: $('#cohort').val(),
                    order_by: $('#order_by').val(),
                    side: $('#order_by').attr('side')
                },
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    if(data.url){
                        $('#notifications ul').html('<li class="form_success">Download ready on ' + data.url + '</li>');
                        document.location = data.url;
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
    }
};