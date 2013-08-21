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
        type: 'POST',
        dataType: 'json',
        data:{
            school:[{asda:123},{
                id: $('#id').val(),
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
                Principal: $('#Principal').val(),
                principalsemail: $('#principalsemail').val(),
                principalCarbonCopied: $('#principalCarbonCopied').val(),
                approveNewsletterCommunication: $('#approveNewsletterCommunication').val(),
                approveReminderPrompts: $('#approveReminderPrompts').val(),
                districtId: $('#districtId').val()
            },{dsasad:321}]
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
            alert(JSON.stringify(response.responseText));
        }
    }
};