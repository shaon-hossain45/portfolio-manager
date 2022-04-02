/*
 * Attaches the image uploader to the input field
 */
function acx_pfm_show_meta_image(button_id,uploader_title,uploader_button,hidden_field_id,preview_id){
	if(button_id)
		{
			button_id = "#"+button_id;
		}
		if(uploader_title == "")
		{
			uploader_title = "Choose Image";
		}
		if(uploader_button == "")
		{
			uploader_button = "Select";
		}
		if(hidden_field_id)
		{
			hidden_field_id = "#"+hidden_field_id;
		}
		if(preview_id)
		{
			preview_id = "#"+preview_id;
		}
	// Instantiates the variable that holds the media library frame.
    var meta_image_frame;

    // Runs when the image button is clicked.
    jQuery(button_id).click(function(e){
 alert("ok");
        // Prevents the default action from occuring.
        e.preventDefault();

        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }

        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: uploader_title,
            button: { text:  uploader_button },
            library: { type: 'image' }
        });

        // Runs when an image is selected.
        meta_image_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
		if(hidden_field_id)
		{
			jQuery(hidden_field_id).val(media_attachment.url);
		}
		if(preview_id != "")
		{
			jQuery(preview_id).attr('src',media_attachment.url);
		}
        });

        // Opens the media library frame.
        meta_image_frame.open();
    });
}
