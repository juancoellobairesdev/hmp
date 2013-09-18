if(!hmp){
    var hmp = {};
}

hmp.school = {
    form:{
        fill_data: function(){
            hmp.school.form.options.data.adm = $('#adm').val();
            hmp.school.form.options.data.admsEmail = $('#admsEmail').val();
            hmp.school.form.options.data.ver = $('#chk_ver').is(':checked')? $('#adm').val(): $('#ver').val();
            hmp.school.form.options.data.versEmail = $('#chk_ver').is(':checked')? $('#admsEmail').val(): $('#versEmail').val();
            hmp.school.form.options.data.lsc = $('#chk_lsc').is(':checked')? $('#adm').val(): $('#lsc').val();
            hmp.school.form.options.data.lscsEmail = $('#chk_lsc').is(':checked')? $('#admsEmail').val(): $('#lscsEmail').val();
            hmp.school.form.options.data.fco = $('#chk_fco').is(':checked')? $('#adm').val(): $('#fco').val();
            hmp.school.form.options.data.fcosEmail = $('#chk_fco').is(':checked')? $('#admsEmail').val(): $('#fcosEmail').val();
            hmp.school.form.options.data.pet = $('#chk_pet').is(':checked')? $('#adm').val(): $('#pet').val();
            hmp.school.form.options.data.petsEmail = $('#chk_oet').is(':checked')? $('#admsEmail').val(): $('#petsEmail').val();
            hmp.school.form.options.data.sha = $('#chk_sha').is(':checked')? $('#adm').val(): $('#sha').val();
            hmp.school.form.options.data.shasEmail = $('#chk_sha').is(':checked')? $('#admsEmail').val(): $('#shasEmail').val();
        },
        
        same_as_administrator: function(){
            var adm = $('#adm').val();
            var admsEmail = $('#admsEmail').val();
            $('input[type="checkbox"][name="chk_staff"]:checked').each(function(index, value){
                var name = $(value).val();
                var email = name + 'sEmail';
                $('#' + name).val(adm);
                $('#' + email).val(admsEmail);
            });
        },

        same_for_all: function(){
            $('input[type="checkbox"][name="chk_staff"]').each(function(index, value){
                $(value).prop('checked', $('#same_for_all').is(':checked'));
                hmp.school.form.copy_administrator($(value).val());
            });
        },

        copy_administrator: function(to){
            if(!!to){
                if($('#chk_' + to).is(':checked')){
                    $('#' + to).prop('disabled', true);
                    $('#' + to + 'sEmail').prop('disabled', true);
                    $('#' + to).val($('#adm').val());
                    $('#' + to + 'sEmail').val($('#admsEmail').val());
                }
                else{
                    $('#' + to).val('');
                    $('#' + to + 'sEmail').val('');
                    $('#' + to).prop('disabled', false);
                    $('#' + to + 'sEmail').prop('disabled', false);
                }
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
                districtId: $('#districtId').val(),
                startingSchoolYear: $('#startingSchoolYear').val(),
                classesStartDate: $('#classesStartDate').val(),
                address: $('#address').val(),
                phone: $('#phone').val(),
                fax: $('#fax').val(),
                email: $('#email').val(),

                shippingContactInfo: $('#shippingContactInfo').val(),
                principal: $('#Principal').val(),
                startTimeOfClasses: $('#startTimeOfClasses').val(),
                endTimeOfClasses: $('#endTimeOfClasses').val(),
                principalCarbonCopied: $('#principalCarbonCopied:checked').val(),
                approveNewsletterCommunication: $('#approveNewsletterCommunication:checked').val(),
                approveReminderPrompts: $('#approveReminderPrompts:checked').val()
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
                    for(i=0; i < data.employees.length; i++){
                        if(data.employees[i].raw_password){
                            $('#notifications ul').append('<li class="form_success">' + data.employees[i].type + ' password: ' + data.employees[i].raw_password + '</li>')
                        }
                    }

                    for(i=0; i < data.warnings.length; i++){
                        $('#notifications ul').append('<li class="form_warning">' + data.warnings[i] + '</li>')
                    }

                    $('#form_buttons').html('<input type="button" value="Back to Home" onClick="window.location.href=\'' + hmp.config.url.base + '\'">')
                    $('#notifications').append('<input type="button" value="Back to Home" onClick="window.location.href=\'' + hmp.config.url.base + '\'">')
                    hmp.scroll('#notifications');
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