<?php 

/**
 * Check whether we're on a "archive" page. WordPress doesn't provide this.
 *
 * @access public
 * @return bool
 */
function ejo_is_archive() {
    return ( is_home() || is_post_type_archive() );
}

/**
 * Check whether we're on a "taxonomy" page. WordPress doesn't provide this.
 *
 * @access public
 * @return bool
 */
function ejo_is_tax() {
    return ( is_category() || is_tag() || is_tax() );
}

/**
 * Check whether we're on a "plural" page. WordPress doesn't provide this.
 *
 * @access public
 * @return bool
 */
function ejo_is_plural() {
    return ( ejo_is_archive() || ejo_is_tax() || is_search() );
}