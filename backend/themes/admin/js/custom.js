/**
 * Created by Gurwinder on 2/2/2016.
 */

$(document).ready(function() {
    var ajaxloading  = false;
    $(document).on('click', ".a_r", function () {
        var id = $(this).attr('data-id');
        var current = $(this);
        var btn_text = current.html();
        if(ajaxloading==false){

            ajaxloading = true;
            current.html('<img src="'+baseurl+'/images/ajax-loader.gif">');
            $.post(admin_url+"/slider-images/update-slider-status",{'id':id}, function(data){
                if(data.result==1){
                    if(data.action=="Add"){
                        current.removeClass('btn-danger').addClass('btn-success');
                    } else {
                        current.removeClass('btn-success').addClass('btn-danger');
                    }
                    current.html(data.action);
                } else {
                    current.html(btn_text);
                }
            }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?

                alert(thrownError); //alert with HTTP error


            });
            ajaxloading = false;
        }
    });
	$(document).on('change', "#attributes-entity_id", function () {

        if($(this).val()==3){
          $('#lower_slider').removeClass('hidden').addClass('form-group');
          $('#upper_slider').removeClass('hidden').addClass('form-group');
        } else {
            $('#lower_slider').removeClass('form-group').addClass('hidden');
            $('#upper_slider').removeClass('form-group').addClass('hidden');
        }
    });
    $('.a_r , .status').bind('click', function() {

        var id = $(this).attr('data-id');
        var field = $(this).attr('field');
        var controllers = $(this).attr('controller');
        var model = $(this).attr('model');
        var current = $(this);
        var btn_text = current.html();

        if(controllers == undefined){
            url = baseurl+"/"+controller;
        }else{
            url = baseurl+"/"+controllers;
        }
        if(field == undefined || field == ''){
            field = 'status';
        }
        if(model == undefined || model == ''){
            model = null;
        }
        if(ajaxloading==false){

            ajaxloading = true;
            current.html('<img src="'+baseurl+'/img/ajax-loader.gif">');
            $.post(url+"/update-any-status",{'id':id,'field':field,'status_token':1,'model':model}, function(data){
                if(data.result==1){
                    if(data.action=="Active"){
                        current.removeClass('btn-danger').addClass('btn-success');
                    } else {
                        current.removeClass('btn-success').addClass('btn-danger');
                    }
                    current.html(data.action);
                } else {
                    current.html(btn_text);
                }
            }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?

                alert(thrownError); //alert with HTTP error


            });
            ajaxloading = false;
        }
    });
});
