
//ajax call for summoner validation process.
$(document).on('submit','#initial-registration',function(event)
{
    event.preventDefault();
    /* Clear rune page div*/
    $("#authenticate_runepage_page").html('');
    $("#summoner_validation_error").html('');


    var email = document.getElementById("email").value;
    var regex = /^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$/;
    if(!regex.test(email))
    {
        $("#summoner_validation_error").html('Email must be a valid format '+ email );
        return;
    }

    var pass1 = document.getElementById("password1").value;
    var pass2 = document.getElementById("password2").value;

    if(pass1 == "" || pass2 == "" || pass1 != pass2)
    {
        $("#summoner_validation_error").html('Passwords must match and can\'t be empty');
        return;
    }

    /* Get some values from elements on the page: */
    var summonername = document.getElementById("summonername").value;
    if(summonername == "")
        summonername = "-";
    
    var region = document.getElementById("region").firstChild.data;
    $("#authenticate_runepage_page").html('<div class="row"><div class="col-md-1 col-md-offset-5"><div class="spinner"><i class="fa-li fa fa-spinner fa-spin fa-2x"></i></div></div></div>');
    
    
    /* Send the data using post and put the results in a div */
    $.ajax({
        url: '/LetItOut/ajax/authenticate_summoner/'+ region +'/'+ summonername.trim(),
        type: "post",
        data: summonername,
        success: function(data){
            $("#authenticate_runepage_page").html(data);
        },
        error:function(jqXHR, textStatus, errorThrown){
            $("#authenticate_runepage_page").html(summonername + " error " + textStatus + " " + errorThrown );
        }
    });
});
    
$(document).on('submit','#rune_page_verification',function(event) {
    /* Stop form from submitting normally */
    event.preventDefault();

    /* Clear any previous error message*/
    $("#rune_page_verification_result").html('');

    /* Send the data using post and put the results in a div */
    $.ajax({
        url: '/LetItOut/ajax/rune_page_verification',
        type: "get",
        data: {},
        success: function(data){
            if(data == "success") {
                //verification succeeded, create user
                switchButtonToRegister();
            }
            else {
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


// ======= in team profile page ===========
$("#view-team-roster").click(function(event) {
    /* Stop form from submitting normally */
    event.preventDefault();

    var teamid = $(event.currentTarget).attr('data-id');
    /* Clear profile content*/
    $("#main-content").html('<div class="row"><div class="col-md-1 col-md-offset-5"><div class="spinner"><i class="fa-li fa fa-spinner fa-spin fa-2x"></i></div></div></div>');

    $.ajax({
            url: '/LoLRep/ajax/team_roster/' + teamid,
            type: "post",
            data: {},
            success: function(data){
                $("#main-content").html(data);
            },
            error:function(jqXHR, textStatus, errorThrown){
                $("#main-content").html("error while loading team roster " + jqXHR + textStatus + " " + errorThrown );
            }
        });
});

$("#view-team-stats").click(function(event) {
    /* Stop form from submitting normally */
    event.preventDefault();

    var teamid = $(event.currentTarget).attr('data-id');
    /* Clear profile content*/
    $("#main-content").html('<div class="row"><div class="col-md-1 col-md-offset-5"><div class="spinner"><i class="fa-li fa fa-spinner fa-spin fa-2x"></i></div></div></div>');

    $.ajax({
            url: '/LoLRep/ajax/team_stats/' + teamid,
            type: "post",
            data: {},
            success: function(data){
                $("#main-content").html(data);
            },
            error:function(jqXHR, textStatus, errorThrown){
                $("#main-content").html("error while loading team stats " + jqXHR + textStatus + " " + errorThrown );
            }
        });
});


//used to set value from left text input dropdown
$(".region-list li a").click(function(event) {
    event.preventDefault();
    var selText = $(this).text();
    $(this).parents('.input-group-btn').find('.dropdown-toggle').html(selText + '  <span class="caret"></span> ');
});

function reloadLoLRegister(message) {
    alert("in reload");
    $.ajax({
        url: '/LoLRep/add_esport/register_LoL',
        type: "post",
        data: {},
        success: function(data){
            $("#authenticate_runepage_page").html(message);
        }
    });
}

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


$('textarea.form-control').maxlength({
    threshold: 20,
    placement: 'bottom-right'
});

$(".review").click(function(event){
    var buttonId = this.id;
    var ids = buttonId.split("-");
    var reviewArea = document.getElementById(buttonId)

    var userid = ids[0]
    var revieweeid = ids[1]
    var gameid = ids[2]

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
        url: "review/create",
        type: 'POST',
        data: review,
        success: function(data){
            $("#"+buttonId).html('');
            for(var skillId = 1; skillId < 5; skillId++)
            {
                var row = document.createElement('div')
                row.setAttribute('class', 'row');
                var radioSkills1 = document.createElement('div')
                radioSkills1.setAttribute('class', 'btn-group btn-group-sm')
                radioSkills1.setAttribute('role', 'group')
                radioSkills1.setAttribute('aria-label', 'Delivery')
                for (var i = 1; i < 6; i++)
                {
                    var skillButton = document.createElement('input')
                    skillButton.setAttribute('type', 'button')
                    skillButton.setAttribute('class', 'btn btn-default skill-button')
                    skillButton.setAttribute('value', i)
                    skillButton.setAttribute('id', buttonId +"-"+skillId+"-"+i)
                    radioSkills1.appendChild(skillButton);
                }
                row.appendChild(radioSkills1)
                reviewArea.appendChild(row)
            }
        },
        error:function(jqXHR, textStatus, errorThrown){
            $("#"+buttonId).html('An error has occured creating the review:' + textStatus);
            return;
        }
    });

    
    
});

$(document).on('click', ".skill-button", function() {
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
        url: "review/update",
        type: 'POST',
        data: review,
        success: function(data){
        },
        error:function(jqXHR, textStatus, errorThrown){
            $("#"+buttonId).html('An error has occured creating the review:' + textStatus);
            return;
        }
    });
});

