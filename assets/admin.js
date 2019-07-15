(function($){
    
    jQuery(document).ready(function(){

        $('[data-toggle="tooltip"]').tooltip(); // Initialized the tooltips

        //Check all proditem (bulk)
        $('#select_proditems').click(function(){
            if($(this).prop("checked") == true){
                $('.check_post').prop("checked",true);
            }
            else if($(this).prop("checked") == false){
                $('.check_post').prop("checked",false);
            }
        });

//Sync a product by id
        /*var sap_protocol = jQuery('#sap_protocol');
        var sap_host = jQuery('#sap_host').val();
        var sap_port = jQuery('#sap_port').val();
        var sap_key = jQuery('#sap_key').val();
        var user_price_list = jQuery('#user_price_list').val();
        //var btn_sync_price = jQuery('#btn_sync_price');

        $( 'input.btn_sync_sap' ).click(function( event ) {
            var sku = attr('sku');

        });

        jQuery('#pepe').click(function () {
            alert('Yeah Test');
        });*/

//Test the connection
        var test_connection_btn = jQuery('#test_connection_btn');

        test_connection_btn.click(function(){
            var result_connection = jQuery('#result_connection');
            var ip_sap = jQuery('#ip_sap').val();
            var port_sap = jQuery('#port_sap').val();
            var key_sap = jQuery('#key_sap').val();

            var url_service = "https://" + ip_sap + ":" + port_sap + "/ItemService.svc/getItems?key=" + key_sap + "&itemcode=ALL&cardcode=ALL&customerpricelist=ALL";
            
            jQuery.ajax({
                url: url_service,
                type: "GET",
                data: {},

            }).done(function (data, textStatus, jqxhr) {
                   
                   result_connection.text('Connection Successuful').css({'color':'green','font-size':'16px','margin-left':'15px'});

            }).fail(function (jqxhr, textStatus, errorThrown) {

                    result_connection.text('No Connection').css({'color':'red','font-size':'16px','margin-left':'15px'});


            });
        });

    });

})(jQuery);

/*

*/