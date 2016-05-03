/**
 * Created by Gurwinder on 1/14/2016.
 */
$(function() {
    $( "#sortable" ).sortable({
            stop: function( event, ui ) {

                var sortedIDs = $( "#sortable" ).sortable( "toArray" );
                $.post(baseurl + "/dropdown-values/sort-values",{'sort_ids': sortedIDs}, function(data){

                    //$("#result").append(data.result); //append received data into the element
                    //$('.animation_image').hide(); //hide loading image

                }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?

                    alert(thrownError); //alert with HTTP error
                    $('.animation_image').hide(); //hide loading image
                    loading = false;

                });
            }
    });
    $( "#sortable" ).disableSelection();
});