<?php 
/**
 * Flatten Carbon Fields complex fields data 
 *
 * Useful because the data is stored in a redundant data scheme (see README)
 */
if ( ! function_exists('flatten_cf2_data') ) {
    function flatten_cf2_data($cf2_data) {
        $flattened_cf2_data = array();

        if ( ! is_array($cf2_data) )
            return $flattened_cf2_data;

        foreach ($cf2_data as $key => $cf2_data_entry) {

            if ( ! is_array($cf2_data_entry)) {
                $flattened_cf2_data[$key] = $cf2_data_entry;
                continue;
            }

            // If array has only one child, check if it's an array or a string
            if ( count($cf2_data_entry) == 1 ) {

                // If it is a string then store it
                if ( isset($cf2_data_entry['value']) ) {
                    $flattened_cf2_data[$key] = $cf2_data_entry['value'];
                    continue;
                }

                // If the child is an array with only one child and its an array with only 'value' as key, store it
                if ( isset($cf2_data_entry[0]) && is_array($cf2_data_entry[0]) && count($cf2_data_entry[0]) == 1 && isset($cf2_data_entry[0]['value']) ) {
                    $flattened_cf2_data[$key] = $cf2_data_entry[0]['value'];
                    continue;
                }
            }

            // If array has more than one child, go deeper!
            $flattened_cf2_data[$key] = flatten_cf2_data($cf2_data_entry);
        };

        return $flattened_cf2_data; 
    }
}

// Filter to process serialized $complex field data
add_filter( 'the_cf2_data', 'flatten_cf2_data' );

// Throw notice compatibility with old function
if( array_key_exists( 'cf2_data' , $GLOBALS['wp_filter']) ) {

    add_filter( 'cf2_data', function($complex_field) {
        _deprecated_hook( 'cf2_data', '0.1.3', 'the_cf2_data', 'This filter has been moved to ejo-core and renamed the_cf2_data.' );
    });
}
