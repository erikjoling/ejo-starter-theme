<?php 

//* Print string, array or object to debug.log
function write_log ( $log ) 
{
	//* Only log in when in Debug Mode
	if ( !WP_DEBUG )
		return;	

	//* Show expanded array or object. Else show string
	if ( is_array( $log ) || is_object( $log ) )
		error_log( print_r( $log, true ) );
	else
		error_log( $log );
}