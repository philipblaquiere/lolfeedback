
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

$(document).on('submit','#search_summoner', function(event) {

    event.preventDefault();
    url_complete ='/LetItOut';
    search_query = $("#search_textbox").val();

    //if(search_query != "")
    //{
        url_complete += '/search/'+ search_query;
    //}

    $.ajax({
        url: url_complete,
        type: "post",
        data: {},
        success: function(data){
            $("#search_result").html(data);
        },
        error:function(jqXHR, textStatus, errorThrown){
        }
    });
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
