if(!hmp){
    var hmp = {};
}

hmp.school = {
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

    form:{
        same_as_administrator: function(){
            if($('#sameAsAdministrator').is(':checked')){
                $('#verifier').val($('#administrator').val());
                $('#verifiersEmail').val($('#administratorsEmail').val());
            }
        },

        copy_administrator: function(){
            if($('#sameAsAdministrator').is(':checked')){
                hmp.school.form.same_as_administrator();
                $('#verifier').prop('disabled', true);
                $('#verifiersEmail').prop('disabled', true);
            }
            else{
                $('#verifier').val('');
                $('#verifiersEmail').val('');
                $('#verifier').prop('disabled', false);
                $('#verifiersEmail').prop('disabled', false);
            }
        },

        check_upload: function(){
            var schoolId = $('#schoolId').val();
            if(schoolId){
                $.ajax({
                    url: hmp.config.url.base + 'school/check_upload',
                    data:{
                        schoolId: schoolId
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(data){
                        if(data){
                            $('#check_upload').addClass('form_warning').html('Uploading a new csv will delete all existing teachers on this school. Do it at your own risk.');
                        }
                        else{
                            $('#check_upload').removeClass('form_warning').html('');
                        }
                    }
                });
            }
        },

        options: {
            type: 'POST',
            dataType: 'json',
            data:{
                schoolId: $('#schoolId').val(),
                name: $('#name').val(),
                startingSchoolYear: $('#startingSchoolYear').val(),
                classesStartDate: $('#classesStartDate').val(),
                address: $('#address').val(),
                phone: $('#phone').val(),
                fax: $('#fax').val(),
                email: $('#email').val(),
                startTimeOfClasses: $('#startTimeOfClasses').val(),
                endTimeOfClasses: $('#endTimeOfClasses').val(),
                fallBreakDates: $('#fallBreakDates').val(),
                winterBreakDates: $('#winterBreakDates').val(),
                springBreakDates: $('#springBreakDates').val(),
                itbsTestingDates: $('#itbsTestingDates').val(),
                writingAssessmentDates: $('#writingAssessmentDates').val(),
                crctTestingDates: $('#crctTestingDates').val(),
                shippingContactInfo: $('#shippingContactInfo').val(),
                principal: $('#Principal').val(),
                principalCarbonCopied: $('#principalCarbonCopied').is('checked'),
                aministrator: $('#administrator').val(),
                aministratorsEmail: $('#administratorsEmail').val(),
                verifier: $('#verifier').val(),
                verifierEmail: $('#verifiersEmail').val(),
                approveNewsletterCommunication: $('#approveNewsletterCommunication').is('checked'),
                approveReminderPrompts: $('#approveReminderPrompts').is('checked'),
                districtId: $('#districtId').val()
            },

            beforeSend: function(){
                $("#progress").show();
                //clear everything
                $("#bar").width('0%');
                $("#message").html("");
                $("#percent").html("0%");
            },

            uploadProgress: function(event, position, total, percentComplete) {
                $("#bar").width(percentComplete+'%');
                $("#percent").html(percentComplete+'%');
            },

            success: function(){
                $("#bar").width('100%');
                $("#percent").html('100%');
            },

            complete: function(response){
                var data = response.responseJSON;
                $('#notifications ul').html('');
                if(data.id){
                    $('#notifications ul').append('<li class="form_success">School successfully saved with id ' + data.id + '</li>');
                    if(data.administrator_password){
                        $('#notifications ul').append('<li class="form_success">Administrator password: ' + data.administrator_password + '</li>');
                    }
                    if(data.verifier_password){
                        $('#notifications ul').append('<li class="form_success">Verifier password: ' + data.verifier_password + '</li>');
                    }

                    for(i=0; i < data.warnings.length; i++){
                        $('#notifications ul').append('<li class="form_warning">' + data.warnings[i] + '</li>')
                    }

                    $('#form_buttons').hide();
                }
                else if(data.errors){
                    var i;
                    for(i=0; i < data.errors.length; i++){
                        $('#notifications ul').append('<li class="form_error">' + data.errors[i] + '</li>')
                    }
                }
                else{
                    alert('Unknown error.');
                }
            }
        }
    }
};