<?php
/* 
 * To change the Dependents options for Go Top main options
 */
function kmt_dep_go_top() {
    if ( kemet_get_option( 'enable-go-top' ) ) {
        return true;
    } else {
        return false;
    }
}
    
