<?php
/* v20150707 
*/

/**
 * Inpost Script functionality
 */
final class EJO_Inpost_Scripts
{
    //* Holds the instance of this class.
    private static $_instance = null;

    //* Store the slug of this plugin
    public static $slug = 'ejo-inpost-scripts';

    //* Returns the instance.
    public static function init() 
    {
        if ( !self::$_instance )
            self::$_instance = new self;
        return self::$_instance;
    }

    //* Plugin setup.
    private function __construct()
    {
        //* Add Metabox
        add_action( 'add_meta_boxes', array( $this, 'add_inpost_scripts_metabox' ) );

        //* Save Metabox
		// add_action( 'pre_post_update', array( $this, 'save_inpost_scripts' ) ); // save the custom fields. Save_post hook doesn't seem to be called when not changing the post
		add_action( 'save_post', array( $this, 'save_inpost_scripts' ), 1, 1 ); // Hook early to make sure it saves (see previous line)

		//* Add custom page scripts to header
		add_action( 'wp_head', array( $this, 'ejo_output_inpost_scripts' ) );
    }

	//* Add Post Scripts metabox
	public function add_inpost_scripts_metabox() 
	{
		/* Get post types from theme-support arguments. If none, then use posts and pages. */
		$post_types = get_post_types();
        $post_types = apply_filters( 'ejo_post_scripts_post_types', $post_types );

        /* Add metabox for every give post_type */
        foreach ($post_types as $post_type) {
            add_meta_box( 'ejo_inpost_scripts_metabox', 'Scripts', array( $this, 'render_inpost_scripts_metabox' ), $post_type, 'normal', 'low' );
        }
	}

	//* The post scripts metabox
	public function render_inpost_scripts_metabox( $post ) 
	{
		//* Noncename needed to verify where the data originated
		wp_nonce_field( 'ejo-inpost-scripts-metabox-' . $post->ID, 'ejo-inpost-scripts-meta-nonce' );

		$inpost_scripts = stripslashes(get_post_meta( $post->ID, '_ejo-inpost-scripts', true )); 

		?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="ejo-inpost-scripts"><?php echo ucfirst($post->post_type); ?>-specific Scripts</label>
					</th>
					<td>
						<p>
							<textarea class="widefat" rows="4" cols="4" name="ejo-inpost-scripts" id="ejo-inpost-scripts"><?php echo esc_textarea( $inpost_scripts ); ?></textarea>
						</p>
						<p>
							Suitable for custom tracking, conversion or other <?php echo $post->post_type; ?>-specific script. Must include <code>script</code> tags.
						</p>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
	}

	//* Manage saving Metabox Data
	public function save_inpost_scripts($post_id) 
	{
		//* Don't try to save the data under autosave, ajax, or future post.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
			return;
		if ( defined( 'DOING_CRON' ) && DOING_CRON )
			return;

		//* Don't save if WP is creating a revision (same as DOING_AUTOSAVE?)
		if ( wp_is_post_revision( $post_id ) )
			return;

		//* Check that the user is allowed to edit the post
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;

		//* Verify where the data originated
		if ( !isset($_POST['ejo-inpost-scripts-meta-nonce']) || !wp_verify_nonce( $_POST['ejo-inpost-scripts-meta-nonce'], 'ejo-inpost-scripts-metabox-' . $post_id ) )
			return;

		$meta_key = '_ejo-inpost-scripts';

		if ( isset( $_POST['ejo-inpost-scripts'] ) )
			update_post_meta( $post_id, $meta_key, $_POST['ejo-inpost-scripts'] );
	}

	//* Output inpost scripts
	public function ejo_output_inpost_scripts() 
	{
		global $post;

		if ( is_singular() )
			echo stripslashes(get_post_meta( $post->ID, '_ejo-inpost-scripts', true )); 
	}
}

//* Call EJO Inpost Scripts
EJO_Inpost_Scripts::init();

