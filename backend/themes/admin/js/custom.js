$(document).ready(function() {

    var ajaxloading  = false;

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