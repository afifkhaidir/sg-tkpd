<?php

namespace Banana\Metaboxes;

function gallery_box() {
    add_meta_box('repeatable-fields', 'Upload Images', __NAMESPACE__ . '\\repeatable_meta_box_display', 'gallery', 'normal', 'high');
}

add_action('add_meta_boxes', __NAMESPACE__ . '\\gallery_box');

function repeatable_meta_box_display() {
	global $post;
	$repeatable_fields = get_post_meta($post->ID, 'repeatable_fields', true);
	wp_nonce_field( 'repeatable_meta_box_nonce', 'repeatable_meta_box_nonce' );
?>
    
	<script type="text/javascript">
    jQuery(document).ready(function($) {

    	$('.metabox_submit').click(function(e) {
    		e.preventDefault();
    		$('#publish').click();
    	});
    	
    	$('#add-row').on('click', function() {
    		var row = $('.empty-row.screen-reader-text').clone(true);
    		row.removeClass('empty-row screen-reader-text');
    		row.insertBefore('#repeatable-fieldset-one tbody>tr:last');
    		return false;
    	});
    	
    	$('.remove-row').on('click', function() {
    		$(this).parents('tr').remove();
    		return false;
    	});
    	
    	$('#repeatable-fieldset-one tbody').sortable({
    		opacity: 0.6,
    		revert: true,
    		cursor: 'grab',
    		handle: '.sort'
    	});
    	
    	$('.uploaded_image').on('click', function() {
    		var thisUploadButton = $(this).parents('tr')[0].children[2].children[0];
    		console.log(thisUploadButton);
    		$(thisUploadButton).click();
    		return false;
    	});
    	
    	$('.upload_image_button').on('click', function() {
    		var thisImage = $(this).parents('tr')[0].children[1].children[0].children[0];
    		var thisCaption = $(this).parents('tr')[0].children[1].children[1];
    		var thisUrl = $(this).parents('tr')[0].children[2].children[1];

            var custom_uploader = wp.media({
                title: 'Custom Image',
                button: {
                    text: 'Upload Image'
                },
                multiple: false
            })
            .on('select', function() {
                console.log(custom_uploader.state().get('selection'));
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                // $(thisImage).css('width', '100%');
                //console.log(custom_uploader.state().get('selection').toJSON());
                $(thisImage).attr('height', '200');
                $(thisImage).attr('src', attachment.url);
                $(thisCaption).show();
                $(thisUrl).val(attachment.url);
            })
            .open();
            $(".th-image").attr("width", "30%");
            $(".th-details").attr("width", "60%");
    		return false;
    	});
    	
    });
	</script>

	<table id="repeatable-fieldset-one" width="100%">
	<thead>
		<tr>
			<th width="2%"></th>
			<th class="th-image" width="0%"></th>
			<th class="th-details" width="90%"></th>
			<th width="2%"></th>
		</tr>
	</thead>
	<tbody>
	<?php
	if ( $repeatable_fields ) :
		foreach ( $repeatable_fields as $field ) {
    ?>
	<tr>
        <td><a class="sort" title="Drag this to sort"><img src="https://ecs7.tokopedia.net/microsite-production/donasi/images/ico-swap.png" alt="swap"></a></td>
		<td>
            <div class="img-container"><img class="uploaded_image" 
            	src="<?php if ($field['url'] != '') echo esc_attr( $field['url'] ); else echo ''; ?>" height="200"></img>
            </div>
            
		    <input class="caption" type="text" name="name[]"
			    value="<?php if($field['name'] != '') echo esc_attr( $field['name'] ); ?>" 
			    placeholder="Caption this image (optional)"
		    />
		</td>
		<td>
            <input class="button btn upload_image_button" type="button" value="Upload Image" />
		    <input class="upload_image_url" type="text" size="36" name="url[]" 
		    value="<?php if ($field['url'] != '') echo esc_attr( $field['url'] ); else echo 'http://'; ?>" readonly/>
		</td>
		<td><a class="button remove-row" href="#"><img src="https://ecs7.tokopedia.net/microsite-production/donasi/images/ico-trash.png" alt="trash"></a></td>
	</tr>
	<script type="text/javascript">
	(function($) {
        $(".th-image").attr("width", "30%");
        $(".th-details").attr("width", "60%");
	}(jQuery));
	</script>
	<?php
		}
	else :
		// show a blank one
?>
	<tr>
        <td><a class="sort" title="Drag this to sort"><span class="glyphicon glyphicon-sort"></span></a></td>
		<td><!--<input type="text" class="widefat" name="url[]" value="http://" /> -->
            <div class="img-container"><img class="uploaded_image" src=""></img></div>
		    <input class="caption" hidden type="text" name="name[]" placeholder="Caption this image (optional)" />
        </td>
		<!--<td><input type="text" class="widefat" name="name[]" /></td>-->
		<td>
            <input class="button btn upload_image_button" type="button" value="Upload Image" />
		    <input class="upload_image_url" type="text" size="36" name="url[]" value="" readonly/>
		</td>
		<td><a class="button remove-row" href="#"><span class="glyphicon glyphicon-trash"></span></a></td>
	</tr>
	<?php endif; ?>

	<!-- empty row template for jQuery -->
	<tr class="empty-row screen-reader-text">
        <td><a class="sort" title="Drag this to sort"><span class="glyphicon glyphicon-sort"></span></a></td>
		<td><!-- <input type="text" class="widefat" name="url[]" value="http://" /> -->
            <div class="img-container"><img class="uploaded_image" src=""></img></div>
		    <input class="caption" hidden type="text" name="name[]" placeholder="Caption this image (optional)" />
		</td>
		<!--<td><input type="text" class="widefat" name="name[]" /></td>-->
		<td>
            <input class="button btn upload_image_button" type="button" value="Upload Image" />
		    <input class="upload_image_url" type="text" size="36" name="url[]" value="" readonly/>
		</td>
		<td><a class="button remove-row" href="#"><span class="glyphicon glyphicon-trash"></span></a></td>
	</tr>
	</tbody>
	</table>

	<p><a id="add-row" class="button" href="#">Add another image</a>
	<input type="submit" class="button btn btn-default metabox_submit" value="Save" />
	</p>
	
	<?php
}

function repeatable_meta_box_save($post_id) {
	if ( ! isset( $_POST['repeatable_meta_box_nonce'] ) ||
		! wp_verify_nonce( $_POST['repeatable_meta_box_nonce'], 'repeatable_meta_box_nonce' ) )
		return;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;
	if (!current_user_can('edit_post', $post_id))
		return;
	$old = get_post_meta($post_id, 'repeatable_fields', true);
	$new = array();
	$names = $_POST['name'];
	$urls = $_POST['url'];
	$count = count( $names );
	for ( $i = 0; $i < $count; $i++ ) {
		if ( $urls[$i] != '' && $urls[$i] != 'http://' ) :
			$new[$i]['name'] = stripslashes( strip_tags( $names[$i] ) );
			$new[$i]['url'] = stripslashes( $urls[$i] ); // and however you want to sanitize
			//if ( $urls[$i] == 'http://' ) $new[$i]['url'] = ''; else 
		endif;
	}
	if ( !empty( $new ) && $new != $old )
		update_post_meta( $post_id, 'repeatable_fields', $new );
	elseif ( empty($new) && $old )
		delete_post_meta( $post_id, 'repeatable_fields', $old );
}

add_action('save_post', __NAMESPACE__ . '\\repeatable_meta_box_save');