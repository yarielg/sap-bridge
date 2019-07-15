<input type="text" id="sap_protocol" value="<?php echo get_option('qsap_ip') ?>"  hidden>
<input type="text" id="sap_host" value="<?php echo get_option('qsap_ip') ?>"  hidden>
<input type="text" id="sap_port" value="<?php echo get_option('qsap_port') ?>"  hidden>
<input type="text" id="sap_key" value="<?php echo get_option('qsap_key') ?>"  hidden>
<input type="text" id="user_price_list" value="<?php echo esc_attr(get_the_author_meta( 'price_list', wp_get_current_user()->id )) ?>" hidden >