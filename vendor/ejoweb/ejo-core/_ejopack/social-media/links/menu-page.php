<?php
if ( !current_user_can( 'edit_theme_options' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
?>

<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1> 

    <form action="<?php echo esc_attr( wp_unslash( $_SERVER['REQUEST_URI'] ) ); ?>" method="post">

        <?php
        // Save Theme options
        if (isset($_POST['submit']) ) {

            //* Update header & footer scripts
            if ( isset($_POST['ejo_social_media_links']) ) {

                //* Get 
                $social_media_links = $_POST['ejo_social_media_links'];

                //* Sanitize
                foreach ($social_media_links as $social_media_id => $social_media) {

                    //* Sanitize URL
                    $social_media_links[$social_media_id]['link'] = esc_url_raw($social_media_links[$social_media_id]['link']);
                }

                //* Store 
                update_option( '_ejo_social_media_links', $social_media_links );
            }
        }

        //* Get stored social media links
        $social_media_links = get_option( '_ejo_social_media_links', array() );

        //* Merge with defaults
        $social_media_links += EJO_Social_Media_Links::$default_social_media_links;

        ?>

        <table class="wp-list-table widefat ejo-social-media-links">
            <thead>
                <tr>
                    <td id="cb" class="column-cb check-column"><?php /* <label class="screen-reader-text" for="cb-select-all-1">Alles selecteren</label><input id="cb-select-all-1" type="checkbox">*/ ?></td>
                    <th scope="col" id="name" class="column-name column-primary">Social Media</th>
                    <th scope="col" id="description" class="column-link">Link</th> 
                    <td scope="col" id="move" class="column-move"></td>
                </tr>
            </thead>

            <tbody id="the-list">       

                <?php foreach ($social_media_links as $social_media_id => $social_media) : ?>

                    <?php $checked = ($social_media['active']) ? 'checked="checked"' : ''; ?>

                    <tr <?php echo ($social_media['active']) ? 'class="active"' : 'class="inactive"'; ?>>
                        <th scope="row" class="check-column"> 
                            <input type="hidden" name="ejo_social_media_links[<?php echo $social_media_id; ?>][active]" value="0" />     
                            <input type="checkbox" name="ejo_social_media_links[<?php echo $social_media_id; ?>][active]" <?php echo $checked; ?> value="1">
                        </th>
                        <td class="column-name">
                            <label><?php echo $social_media['name']; ?></label>
                        </td>
                        <td class="column-link">
                            <input type="text" class="large-text" name="ejo_social_media_links[<?php echo $social_media_id; ?>][link]" value="<?php echo esc_url($social_media['link']); ?>" placeholder="https://">
                            <input type="hidden" name="ejo_social_media_links[<?php echo $social_media_id; ?>][name]" value="<?php echo $social_media['name']; ?>">
                        </td>
                        <td>
                            <span class="move-item dashicons-before dashicons-sort"></span>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

        <p>
            <?php submit_button( __('Bewaar instellingen', EJO_Core::$slug), 'primary', 'submit', false ); ?>
        </p>
    
    </form>

    <hr/>
    <h2 class="title">Extra informatie</h2>
    <p>
        Gebruik de shortcode <strong>[social_media]</strong> om de social media links te tonen
    </p>

</div>