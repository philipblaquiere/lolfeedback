
//ajax call for summoner validation process.
$(document).on('submit','#initial-registration',function(event)
{
    event.preventDefault();
    /* Clear rune page div*/
    $("#authenticate_runepage_page").html('');
    $("#summoner_validation_error").html('');
    $("#authenticate_runepage_page").html('<div class="row"><div class="col-md-1 col-md-offset-5"><div class="spinner"><i class="fa-li fa fa-spinner fa-spin fa-2x"></i></div></div></div>');


    var email = document.getElementById("email").value;
    var regex = /^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$/;
    if(!regex.test(email))
    {
        $("#summoner_validation_error").html('Email must be a valid format '+ email );
        $("#authenticate_runepage_page").html('');
        return;
    }

    var pass1 = document.getElementById("password1").value;
    var pass2 = document.getElementById("password2").value;

    if(pass1 == "" || pass2 == "" || pass1 != pass2)
    {
        $("#summoner_validation_error").html('Passwords can\'t be empty');
        $("#authenticate_runepage_page").html('');
        return;
    }
    if(pass1 != pass2)
    {
        $("#summoner_validation_error").html('Passwords must match');
        $("#authenticate_runepage_page").html('');
        return;
    }
    if(pass1.length < 6)
    {
        $("#summoner_validation_error").html('Password must be longer than 6 characters');
        $("#authenticate_runepage_page").html('');
        return;
    }

    /* Get some values from elements on the page: */
    var summonername = document.getElementById("summonername").value
    var region = document.getElementById("region").innerText.toLowerCase().trim()

    var registerInfo = {
        email: email,
        summonername: summonername,
        region:  region
    }

     /* Check db if email is already used*/
    $.ajax({
        url: '/lolfeedback/ajax/validate_register',
        type: "post",
        data: registerInfo,
        dataType: 'JSON',
        success: function(data){
            if(data.error == "true")
            {
                $("#summoner_validation_error").html('');
                $("#summoner_validation_error").html(data.content);
                $("#authenticate_runepage_page").html('');
                return;
            }

            $("#summoner_validation_error").html('');
            $("#authenticate_runepage_page").html('');
            $("#authenticate_runepage_page").html(data.content);
            return;
        },
        error:function(data,jqXHR, textStatus, errorThrown){
           $("#summoner_validation_error").html('There was an error while registering. Please try again.');
        }
    });
});
    
$(document).on('submit','#rune_page_verification',function(event) {
    /* Stop form from submitting normally */
    event.preventDefault();

    /* Clear any previous error message*/
    $("#rune_page_verification_result").html('');
    $("#rune_page_verification_result").html('<div class="row"><div class="col-md-1 col-md-offset-5"><div class="spinner"><i class="fa-li fa fa-spinner fa-spin fa-2x"></i></div></div></div>');

    /* Send the data using post and put the results in a div */
    $.ajax({
        url: '/lolfeedback/ajax/rune_page_verification',
        type: "get",
        data: {},
        success: function(data){
            if(data == "success") {
                //verification succeeded, create user
                $("#rune_page_verification_result").html('');
                switchButtonToRegister();
            }
            else {
                $("#rune_page_verification_result").html('');
                $("#rune_page_verification_result").html(data);
            }
        },
        error:function(jqXHR, textStatus, errorThrown, responseHeaders){
            alert(errorThrown);
            $("#rune_page_verification_result").html(textStatus + ": " + errorThrown +responseHeaders+jqXHR);
        }
    });
});

$(document).on('submit','#submit_forms', function(event) {
    /* Stop form from submitting normally */
    event.preventDefault();
   $("#original_registration_submit").click();
});


//used to set value from left text input dropdown
$(".region-list li a").click(function(event) {
    event.preventDefault();
    var selText = $(this).text();
    $(this).parents('.input-group-btn').find('.dropdown-toggle').html(selText + '  <span class="caret"></span> ');
});


function switchButtonToRegister()
{
    button = document.getElementById('rune_page_verification_button');
    button.setAttribute('id','create_user');
    button.setAttribute('value','Complete Registration');
    original_form = document.getElementById('initial-registration');
    original_form.setAttribute('action', 'register/create');
    original_form.setAttribute('id','create_user_form');
    rune_page_form = document.getElementById('rune_page_verification');
    rune_page_form.setAttribute('id', 'submit_forms')
    
}

$(document).on('click', ".review", function() {
    var buttonId = this.id;
    $("#"+buttonId).html('<div class="row"><div class="col-md-1 col-md-offset-5"><div class="spinner"><i class="fa-li fa fa-spinner fa-spin fa-2x"></i></div></div></div>');

    var ids = buttonId.split("-");
    var reviewArea = document.getElementById(buttonId)
    var messageArea = document.getElementById(buttonId+"-message")

    var userid = ids[0]
    var revieweeid = ids[1]
    var gameid = ids[2]
    var skillNames = ['','Game Sense','Helpful','Skillful','Delivery']
    var skillDescriptions = ['', 'Deep understanding of team oriented goals, team player, a leader', 'Cooperated, jumped on opportunities to educate','Demonstrated intellectual prowess through gameplay', 'Polite, clear and concise when communicating']

    if(ids.length != 3)
    {
        return;
    }

    var review = {
        fromid: userid,
        toid: revieweeid,
        id: buttonId,
        gameid: gameid
    }
    /* Send the data using post and put the results in a div */
    $.ajax({
        url: "/lolfeedback/review/create",
        type: 'POST',
        data: review,
        success: function(data){
            $("#"+buttonId).html('');
            var table = document.createElement('table')

            for(var skillId = 1; skillId < 5; skillId++)
            {
                var row = document.createElement('tr')
                row.setAttribute('class', 'skill-group')

                var skillLabel = document.createElement('td')
                skillLabel.setAttribute('data-toggle', 'tooltip')
                skillLabel.setAttribute('class', 'text-right text-muted skill-label')
                skillLabel.insertAdjacentHTML('afterBegin', skillNames[skillId])

                var skillData = document.createElement('td')
                skillData.setAttribute('class','skill-group')
                var radioSkills = document.createElement('div')
                radioSkills.setAttribute('class', 'btn-group btn-group-sm ')
                radioSkills.setAttribute('data-toggle', 'buttons')
                radioSkills.setAttribute('role', 'group')
                for (var i = 1; i < 6; i++)
                {
                    var skillButtonLabel = document.createElement('label')
                    skillButtonLabel.setAttribute('class', 'btn btn-default')
                    skillButtonLabel.insertAdjacentHTML('afterBegin', i)
                    var skillButton = document.createElement('input')
                    skillButton.setAttribute('type', 'radio')
                    skillButton.setAttribute('name',buttonId +"-"+skillId)
                    skillButton.setAttribute('value', i)
                    skillButton.setAttribute('class', 'skill-radio')
                    skillButton.setAttribute('id', buttonId +"-"+skillId+"-"+i)
                    skillButtonLabel.appendChild(skillButton)
                    radioSkills.appendChild(skillButtonLabel);
                }
                skillData.appendChild(radioSkills)
                row.appendChild(skillLabel)
                row.appendChild(skillData)
                table.appendChild(row)
            }
            reviewArea.appendChild(table)


            var formElement = document.createElement('span')

            var messageElement = document.createElement('textarea')

            messageElement.setAttribute('placeholder', 'Leave a comment')
           //messageElement.setAttribute('rows', '3')
            messageElement.setAttribute('class', 'review-message')
            messageElement.setAttribute('id', buttonId+"-content")
            var messageButtonElement = document.createElement('button')
            messageButtonElement.setAttribute('value', '1')
            messageButtonElement.setAttribute('id', buttonId+"-message-button")
            messageButtonElement.setAttribute('class', 'btn btn-default review-message-button')
            messageButtonElement.insertAdjacentHTML('afterBegin','Give Feedback')
            messageButtonElement.setAttribute('type', 'button')
            var messageStatusElement = document.createElement('label')
            messageStatusElement.setAttribute('id', buttonId+"-review-message-status")

            messageStatusElement.setAttribute('class', 'text-muted')

            messageArea.appendChild(messageElement)
            messageArea.appendChild(messageButtonElement)
            messageArea.appendChild(messageStatusElement)
            //messageArea.appendChild(formElement)
        },
        error:function(jqXHR, textStatus, errorThrown){
            $("#"+buttonId).html('An error has occured creating the review:' + textStatus)
            return;
        }
    });
});

$(document).on('click', ".review-message-button", function() {
    var buttonId = this.id;
    var button = this
    
    var ids = buttonId.split("-");

    var userid = ids[0]
    var revieweeid = ids[1]
    var gameid = ids[2]
    var reviewid = userid + "-" + revieweeid + "-" + gameid

    var textArea = document.getElementById(reviewid+"-content")
    if(textArea == null)
    {
        return
    }
    var message = textArea.value
    if(!message)
    {
        $("#"+reviewid+"-review-message-status").html("Comment is empty")
        return
    }

    var review = {
        id: reviewid,
        message: message
    }
    button.disabled = true
    /* Send the data using post and put the results in a div */
    $.ajax({
        url: "/lolfeedback/review/comment",
        type: 'POST',
        data: review,
        dataType: 'JSON',
        success: function(data){
            if(data.status = "success")
            {
                $("#"+reviewid).fadeOut('200')
                $("#"+reviewid+"-message").fadeOut('200', function(){
                    var commentParent = $("#"+reviewid).parent()
                    commentParent.hide()
                    commentParent.html('<a class="btn btn-link disabled text-muted text-left">'+data.msg+'</a>')
                    commentParent.fadeIn('200')
                })
            }
            else
            {
                $("#"+reviewid+"-review-message-status").html(data.msg)
                button.disabled = false
            }
        },
        error:function(data, jqXHR, textStatus, errorThrown){
            $("#"+reviewid+"-review-message-status").html('An error has occured creating the review');
            button.disabled = false
            return;
        }
    });
});

$(document).on('click', ".forgot_password_btn", function(event) {
    event.preventDefault();
    var button = this;
    var email = document.getElementById('forgot_email')
    email = email.value
    if(!email)
    {
        return;
    }
    button.disabled = true
    var emailData = {
        email: email
    }
    $("#reset-password-content").fadeOut('slow', function(){
        /* Send the data using post and put the results in a div */
        $.ajax({
            url: "/lolfeedback/auth/send_reset_email",
            type: 'POST',
            data: emailData,
            dataType: 'JSON',
            success: function(data){
                $("#reset-password-content").hide()
                $("#reset-password-content").html('<div class="text-center">'+data.message+'</div>')
                $("#reset-password-content").fadeIn('400', function(){});
               return;
            },
            error:function(data, jqXHR, textStatus, errorThrown){
                    $("#reset-password-content").html('An error has occured')
                
                return;
            }
        });
    });
});

$(document).on('click', ".refresh-feed", function() {
    var buttonId = this.id;
    var button = this
    
    var ids = buttonId.split("-");

    var userid = ids[0]
    
    if(!userid)
    {
        return;
    }
    button.disabled = true
    $("#"+userid+"-refresh-spinner").addClass("fa-spin")

    var current_html = $("#sg_"+userid).html();
    /* Send the data using post and put the results in a div */
    $.ajax({
        url: "/lolfeedback/games/refresh/"+userid,
        type: 'POST',
        data: {},
        dataType: 'JSON',
        success: function(data){

            if(data.is_user == "true")
            {
                $("#sg_"+userid).html(data.game_content);
            }
            $("#sr_"+userid).html('');
            $("#sr_"+userid).html(data.review_content);
            button.disabled = false
            $("#"+userid+"-refresh-spinner").removeClass("fa-spin")
        },
        error:function(data, jqXHR, textStatus, errorThrown){
            $("#sr_"+userid).html('An error has occured while refreshing. Please try again');
            $("#"+userid+"-refresh-spinner").removeClass("fa-spin")
            return;
        }
    });
});

$(document).on('change', ".skill-radio", function() {
    var buttonId = this.id;
    var ids = buttonId.split("-");
    
    if(ids.length != 5)
    {
        return;
    }

    var userid = ids[0]
    var revieweeid = ids[1]
    var gameid = ids[2]
    var reviewid = userid + "-" + revieweeid + "-" + gameid
    var skillNum = ids[3]
    var skillVal = ids[4]

    var reviewArea = document.getElementById(reviewid)

    var review = {
        id: reviewid,
        skill: skillNum,
        value: skillVal
    }

    /* Send the data using post and put the results in a div */
    $.ajax({
        url: "/lolfeedback/review/update",
        type: 'POST',
        data: review,
        success: function(data){
        },
        error:function(jqXHR, textStatus, errorThrown){
            $("#"+buttonId).html('An error has occured giving feedback');
            return;
        }
    });
});

$(document).ready(function() {

    if($('body').is('.summoner'))
    {
        var summonerId = document.getElementsByTagName("body")[0].id
        $("#sr_"+summonerId).html('<div class="row"><div class="col-md-1 col-md-offset-3"><div class="spinner"><i class="fa-li fa fa-spinner fa-spin fa-2x"></i></div></div></div>');

        if(summonerId == "index")
        {
            return;
        }

        $.ajax({
            url: "/lolfeedback/games/recent/"+summonerId,
            type: 'POST',
            dataType: 'JSON',
            data: {},
            success: function(data){
                if(data.is_user == "true")
                {
                    $("#sg_"+summonerId).html(data.game_content);
                }

                $("#sr_"+summonerId).html('');
                $("#sr_"+summonerId).html(data.review_content);
            },
            error:function(data, jqXHR, textStatus, errorThrown){
                $("#"+summonerId).html('An error has occured loading the profile:' + textStatus +errorThrown);
                return;
            }
        });
    }
});

