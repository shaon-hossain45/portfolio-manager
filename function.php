

<?php
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', plugin_dir_url( __FILE__ ) . '/style.css' );


	wp_enqueue_style( 'parent-style1', plugin_dir_url( __FILE__ ) . '/assets/screen.css' );
	wp_enqueue_style( 'parent-style2', plugin_dir_url( __FILE__ ) . '/assets/acx_p_port_fonts.css' );
	wp_enqueue_style( 'parent-style3', plugin_dir_url( __FILE__ ) . '/assets/acx_p_port_logo_style.css' );
	wp_enqueue_style( 'parent-style4', plugin_dir_url( __FILE__ ) . '/assets/acx_p_port_logo_screen.css' );
	wp_enqueue_style( 'parent-style5', plugin_dir_url( __FILE__ ) . '/assets/acx_p_port_mockup_fonts.css' );
	wp_enqueue_style( 'parent-style6', plugin_dir_url( __FILE__ ) . '/assets/acx_p_port_mockup_style.css' );
	wp_enqueue_style( 'parent-style7', plugin_dir_url( __FILE__ ) . '/assets/acx_p_port_mockup_screen.css' );
	wp_enqueue_style( 'parent-style8', plugin_dir_url( __FILE__ ) . '/assets/slick.css' );


	wp_enqueue_script( 'custom-script0', plugin_dir_url( __FILE__ ) . '/assets/acx_p_port_mockup_js/jquery.nicescroll.min.js', array( 'jquery' ), true );
	wp_enqueue_script( 'custom-script1', plugin_dir_url( __FILE__ ) . '/assets/js/isotope.pkgd.js', array( 'jquery' ), true );
	wp_enqueue_script( 'custom-script2', plugin_dir_url( __FILE__ ) . '/assets/js/slick.js', array( 'jquery' ), true );
	wp_enqueue_script( 'custom-script3', plugin_dir_url( __FILE__ ) . '/assets/js/custom-script.js', array( 'jquery' ), true );

}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );





/**
 * [boxed] returns the HTML code for a content box with colored titles.
 * @return string HTML code for boxed content
*/

add_shortcode( 'works_portfolio', 'salcodes_boxed' );

function salcodes_boxed( $atts, $content = null, $tag = '' ) {
	global $post;
 $a = shortcode_atts( array(
 'title' => 'Title',
 'title_color' => 'white',
 'color' => 'blue',
 ), $atts );

 $output = '';
 $output .= '<div id="acx_webex_body_content">
    <div class="section-custom common_padding">
        <div class="acx_inside">
            <div class="acx_common">
                <div class="acx_gallery_filtr ">';

        $acx_pfm_dynamic_types=get_option('acx_pfm_dynamic_types');
        if(is_serialized($acx_pfm_dynamic_types))
        {
            $acx_pfm_dynamic_types=unserialize($acx_pfm_dynamic_types);
        }

				$output .= '<div class="acx_gal_filter_grp filters-button-group">
                        <a class="acx_button is-checked" data-filter="*">all works</a>';




            foreach($acx_pfm_dynamic_types as $dynamic_cat_key => $dynamic_cat_value)
            {

                    $acx_pfm_taxonomy_name = $dynamic_cat_value['id'].'_tx';
                    $acx_tax_terms = get_terms( $acx_pfm_taxonomy_name, array(
                    'orderby'    => 'count',
                    'hide_empty' => 0,
                    'order'		=>'ASC'
                ));

        foreach($acx_tax_terms as $term){
        if($term->count > 0){


					$output .= '<a  class="acx_button" data-filter="'.'.'.$term->slug.'">'.$term->name.'</a>';


        }
        }
            }

					$output .= '</div> <!-- acx_gal_filter_grp-->
            </div> <!-- acx_gallery_filtr -->

            <div class="acx_gallery_wrk_cnvs">';

            foreach($acx_pfm_dynamic_types as $dynamic_key => $dynamic_value)
            {
                $acx_pfm_dynamic_array='acx_pfm_custom_fields_'.$dynamic_value['posttype'];
                $acx_pfm_custom_fields=get_option($acx_pfm_dynamic_array);
                if(is_serialized($acx_pfm_custom_fields ))
                {
                    $acx_pfm_custom_fields = unserialize($acx_pfm_custom_fields);
                }
                $args = array( 'post_type' => $dynamic_value['posttype'] ,'post_status' => array('publish'));
                $the_query = new WP_Query( $args );
                if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query ->the_post();

                $acx_img =  wp_get_attachment_url( get_post_thumbnail_id($post->ID));
                $taxonomies=get_taxonomies('','names');
                $tax_slug = wp_get_post_terms($post->ID, $taxonomies,  array("fields" => "all"));
                $acx_count = count($tax_slug);

                $acx_pfm_type = get_post_meta($post->ID, 'acx_pfm_type',true);
                $acx_web_image = get_post_meta($post->ID, 'acx_web_image',true);
                $acx_tab_image = get_post_meta($post->ID, 'acx_tab_image',true);
                $acx_mob_image = get_post_meta($post->ID, 'acx_mob_image',true);
                $acx_logo_img =  get_post_meta($post->ID, 'acx_logo_image',true);



               //if(($acx_pfm_type == 'logo' && $acx_logo_img != '') ||  ($acx_pfm_type == 'web' && $acx_web_image != ''))
                //{
                global $post;

                    if($acx_count > 0) {
                        for($i= 0; $i< $acx_count ; $i++)
                        {
                            $elementcount = $tax_slug[$i]->slug;
                           // echo " ";
                        }
                    }
					$output .= '<div class="acx_gal_wrk_split element-item '.$elementcount.'" data-category="'.$tax_slug[0]->slug.'">
                        <div class="acx_gal_inner_split">';
                        $output .= '<img src="'.$acx_img.'">';
                        $output .= '<span class="hover_bg">
                        <div class="gal_hvr_cntnt">
                        <div class="gal_link_hvr">
                            <a onclick="acx_w_portfolio_opened('.$post->ID.');" class="gal_zoom"></a>';


                            $acx_link = get_post_meta($post->ID, 'acx_link',true);
                            if($acx_link != '')
                            {

                            $output .= '<a href="'.$acx_link.'" class="gal_linkto"></a>';

                            }

                        $output .= '</div> <!-- gal_link_hvr -->
                        <span class="gal_hvr_ttl"></span>
                        </div> <!-- gal_hvr_cntnt-->
                        </span>
                        </div> <!-- acx_gal_inner_split-->
                    </div> <!-- acx_gal_wrk_split-->';
                    // }
                    endwhile; endif;

            }






				$output .= '</div> <!-- acx_gallery_wrk_cnvs -->
            </div><!-- acx_common -->
        </div><!-- acx_inside -->
    </div><!-- section -->
</div><!-- acx_webex_body_content -->';

 return $output;
}



// add_action('admin_menu', 'mytheme_add_admin');
function acx_w_open_portfolio_callback()
{
//	if (!isset($_POST['acx_w_open_portfolio_w_c_n'])) die("<br><br>Unknown Error Occurred, Try Again... <a href=''>Click Here</a>");
//	if (!wp_verify_nonce($_POST['acx_w_open_portfolio_w_c_n'],'acx_w_open_portfolio_w_c_n')) die("<br><br>Unknown Error Occurred, Try Again... <a href=''>Click Here</a>");


	if(isset($_POST['postid']))
	{
		$postid = $_POST['postid'];
	}
	else
	{
		$postid = '';
	}
	$acx_pfm_dynamic_types=get_option('acx_pfm_dynamic_types');
	if(is_serialized($acx_pfm_dynamic_types))
	{
		$acx_pfm_dynamic_types=unserialize($acx_pfm_dynamic_types);
	}
	$acx_pfm_custom_array= array();
	foreach($acx_pfm_dynamic_types as $key => $value)
	{
		if(get_post_type($postid)==$value['posttype'])
		{
		$acx_pfm_custom_array="acx_pfm_custom_fields_".$value['posttype'];
		}
	}
	$acx_pfm_custom_fields=get_option($acx_pfm_custom_array);
	if(is_serialized($acx_pfm_custom_fields ))
	{
		$acx_pfm_custom_fields = unserialize($acx_pfm_custom_fields);
	}
	if($acx_pfm_custom_fields == "")
	{
		$acx_pfm_custom_fields = array();
	}





	$acx_pfm_type = get_post_meta($postid, 'acx_pfm_type',true);
	$content_post = get_post($postid);
	$content = $content_post->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	$acx_title = get_the_title($postid);


		$tools_used = get_post_meta($postid, 'acx_tools_used',true);
		$acx_web_image = get_post_meta($postid, 'acx_web_image',true);
		$acx_tab_image = get_post_meta($postid, 'acx_tab_image',true);
		$acx_mob_image = get_post_meta($postid, 'acx_mob_image',true);
		$acx_logo_img =  get_post_meta($postid, 'acx_logo_image',true);



	if($acx_pfm_type == 'web')
	{

		echo "<div class='acx_p_port_lbx_cvr'>
	<div class='acx_p_port_lbx_content clearfix'>
    <div class='acx_p_port_lbx_inside'>

    	<span class='acx_p_port_close'  onclick='acx_hide_portfolio();'></span>
        <div class='acx_p_port_title_top'><span class='acx_p_port_lbx_title'>".$acx_title ."</span></div> <!-- acx_p_port_title_top -->
    <div class='acx_p_port_lbx_left_cnvas'>
    <div class='acx_p_port_lbx_title_cvr'>
    <div class='acx_p_port_mode_switch'>
    <div class='acx_p_port_switch_mode_in'>";
	if($acx_web_image != '')
	{
    	echo "<span class='acx_p_port_mode_btn acx_p_port_desktop' onclick='acx_show_port(\"web\",\"acx_p_port_desktop_img\");'><span class='acx_p_port_tooltip'>Desktop</span></span>";
	}
	if($acx_tab_image != '')
	{
        echo "<span class='acx_p_port_mode_btn acx_p_port_tab' onclick='acx_show_port(\"tab\",\"acx_p_port_tablet_image_cnvs\");'><span class='acx_p_port_tooltip'>Tablet</span></span>";
	}
	if($acx_mob_image != '')
	{
        echo "<span class='acx_p_port_mode_btn acx_p_port_mob' onclick='acx_show_port(\"mob\",\"acx_p_port_mob_image_cnvs\");'><span class='acx_p_port_tooltip'>Mobile</span></span>";
	}
	$tab_frame =  plugin_dir_url( __FILE__ )."/assets/images/acx_p_port_mockup_images/acx_p_port_tab_frame_empty.png";
	$mob_frame =  plugin_dir_url( __FILE__ )."/assets/images/acx_p_port_mockup_images/acx_p_port_mob_frame_empty.png";
        echo "</div> <!-- acx_p_port_switch_mode_in -->
    </div> <!-- acx_p_port_mode_switch -->
    </div> <!-- acx_p_port_lbx_title_cvr -->

    <div class='acx_p_port_mockup_show_cvr'>
    <div class='acx_p_port_mockup_canvas'>";
  if($acx_web_image != '')
	{
		echo "<!-- Desktop image -->

    	<div class='acx_p_port_desktop_img acx_port_image acx_scroll_web' id='acx_portfolio_web'>
        	<img src='".$acx_web_image."' alt='desktop_view'>
        </div> <!-- acx_p_port_desktop_img -->";
	}
	  if($acx_tab_image != '')
	{
echo "<!-- Tablet Image -->
		<div class='acx_p_port_tablet_frame_cover acx_port_image ' id='acx_portfolio_tab'>
        <img src='".$tab_frame."'>
        	<div class='acx_p_port_tablet_image_cnvs acx_scroll_tab'>
            <img src='".$acx_tab_image."' alt='tablet_mockup'>
            </div> <!-- acx_p_port_tablet_image_cnvs -->
        </div> <!-- acx_p_port_tablet_frame_cover -->";
	}
	  if($acx_mob_image != '')
	{
echo "<!-- Mobile Image -->
		<div class='acx_p_port_mob_frame_cover acx_port_image ' id='acx_portfolio_mob'>
        <img src='".$mob_frame."'>
        	<div class='acx_p_port_mob_image_cnvs acx_scroll_mob'>
            <img src='".$acx_mob_image."'>
            </div> <!-- acx_p_port_mob_image_cnvs -->
        </div> <!-- acx_p_port_mob_frame_cover -->";

	}
    echo "</div> <!-- acx_p_port_mockup_canvas -->
    </div> <!-- acx_p_port_mockup_show_cvr -->
    </div> <!-- acx_p_port_lbx_left_cnvas -->

    <div class='acx_p_port_right_canvas'>
    	<div class='acx_p_port_right_inner_cnvs'>
        	<span class='acx_p_port_project_detail'>PROJECT DETAILS</span>

            <div class='acx_p_port_pro_content_cvr'>
            	<div class='acx_p_port_content_scroll_cnvs'>
                <span class='acx_p_port_data'>".$content."</span>";
				if($tools_used != '')
				{
                echo "<span class='acx_p_port_content_sml_title'>Technologies Used:</span>
                <span class='acx_p_port_data'>".$tools_used."</span>";
				}
                echo "</div> <!-- acx_p_port_content_scroll_cnvs -->
            </div> <!-- acx_p_port_pro_content_cvr -->
        </div> <!-- acx_p_port_right_inner_cnvs -->
    </div> <!-- acx_p_port_right_canvas -->

    </div> <!-- acx_p_port_lbx_inside -->
    </div> <!-- acx_p_port_lbx_content -->
	<script type='text/javascript'>
// Nice Scroll
  jQuery(document).ready(function() {
    jQuery('.acx_scroll_web').niceScroll({cursorcolor:'#333',preservenativescrolling: false,cursoropacitymax:0.7,boxzoom:false,touchbehavior:true,grabcursorenabled: true});  //scrollable DIV
	jQuery('.acx_p_port_content_scroll_cnvs').niceScroll({cursorcolor:'#111',preservenativescrolling: false,cursoropacitymax:0.7,boxzoom:false,touchbehavior:true,grabcursorenabled: true});  // scrollable DIV
 });
 function acx_show_port(id,scroll_elemt)
 {
	scroll_selector = '.'+scroll_elemt;
	jQuery('.acx_port_image').removeClass('acx_active');
	jQuery('.acx_port_image').fadeOut();
	jQuery('#acx_portfolio_'+id).addClass('acx_active');
	jQuery('#acx_portfolio_'+id).fadeIn();
	jQuery('.acx_scroll_'+id).getNiceScroll().resize();
	jQuery('.acx_scroll_'+id).niceScroll({cursorcolor:'#333',preservenativescrolling: false,cursoropacitymax:0.7,boxzoom:false,touchbehavior:true,grabcursorenabled: true});  //scrollable DIV
 }
 jQuery(window).scroll(function(){
	  jQuery('.acx_scroll_web').getNiceScroll().resize();
	  jQuery('.acx_scroll_tab').getNiceScroll().resize();
	  jQuery('.acx_scroll_mob').getNiceScroll().resize();

 });
jQuery('.acx_scroll_web').scroll(function(){
	jQuery('.acx_scroll_web').getNiceScroll().resize();
});
 jQuery('.acx_scroll_tab').scroll(function(){
	jQuery('.acx_scroll_tab').getNiceScroll().resize();
});
 jQuery('.acx_scroll_mob').scroll(function(){
	jQuery('.acx_scroll_mob').getNiceScroll().resize();
});
jQuery('.acx_p_port_content_scroll_cnvs').scroll(function(){
	jQuery('.acx_p_port_content_scroll_cnvs').getNiceScroll().resize();
});
</script>
</div> <!-- acx_p_port_lbx_cvr -->
";
	}
	else if($acx_pfm_type == 'logo')
	{


		echo "<div class='acx_p_port_logo_lbx_cvr' >
	<div class='acx_p_port_logo_lbx_content clearfix'>
    <div class='acx_p_port_logo_lbx_inside'>

    	<span class='acx_p_port_close' onclick='acx_hide_portfolio();'></span> <!-- Close Button -->

        <div class='acx_p_port_logo_lbx_left'>
        	<div class='acx_p_port_logo_lbx_left_inner'>
            <img src='".$acx_logo_img."' alt='logo' title='sample_logo'>
            </div><!-- acx_p_port_logo_lbx_left_inner -->
        </div> <!-- acx_p_port_logo_lbx_left -->


    <div class='acx_p_port_logo_right_canvas'>
    	<div class='acx_p_port_logo_right_inner_cnvs'>
        	<span class='acx_p_port_logo_project_detail'>LOGO DETAILS</span>

            <div class='acx_p_port_logo_pro_content_cvr'>
            	<div class='acx_p_port_logo_content_scroll_cnvs'>
                <span class='acx_p_port_logo_data'>".$content."</span>";
				if($tools_used != '')
				{
					echo "<span class='acx_p_port_logo_content_sml_title'>Tools Used:</span>
                <span class='acx_p_port_logo_data'>".$tools_used."</span>";
				}
                echo "</div> <!-- acx_p_port_logo_content_scroll_cnvs -->
            </div> <!-- acx_p_port_logo_pro_content_cvr -->
        </div> <!-- acx_p_port_logo_right_inner_cnvs -->
    </div> <!-- acx_p_port_logo_right_canvas -->

    </div> <!-- acx_p_port_logo_lbx_inside -->
    </div> <!-- acx_p_port_logo_lbx_content -->
	<script type='text/javascript'>
  jQuery(document).ready(function() {
	//var nice = jQuery('html').niceScroll();  // The document page (body)
    jQuery('.acx_p_port_logo_content_scroll_cnvs').niceScroll({cursorcolor:'#222',preservenativescrolling: false,cursoropacitymax:0.7,boxzoom:false,touchbehavior:true});  //scrollable DIV
 });
 jQuery('.acx_p_port_logo_content_scroll_cnvs').scroll(function(){
            jQuery('.acx_p_port_logo_content_scroll_cnvs').getNiceScroll().resize();
        });
</script>
</div> <!-- acx_p_port_logo_lbx_cvr -->
";
	}
		die();
}
add_action('wp_ajax_acx_w_open_portfolio','acx_w_open_portfolio_callback');
add_action('wp_ajax_nopriv_acx_w_open_portfolio','acx_w_open_portfolio_callback');

$acx_pfm_dynamic_types=get_option('acx_pfm_dynamic_types');
if(is_serialized($acx_pfm_dynamic_types))
{
	$acx_pfm_dynamic_types=unserialize($acx_pfm_dynamic_types);
}


// Create Custom Post Type
$acx_pfm_default_no_image=  plugin_dir_url( __FILE__ ).'/images/noimage.jpg';

function acx_pfm_post_type() {

	$acx_pfm_dynamic_types=get_option('acx_pfm_dynamic_types');
	if(is_serialized($acx_pfm_dynamic_types))
	{
		$acx_pfm_dynamic_types=unserialize($acx_pfm_dynamic_types);
	}

	foreach($acx_pfm_dynamic_types as $dynamic_key => $dynamic_value)
	{
		$acx_pfm_value=$dynamic_value['label'];
		$acx_pfm_value=preg_replace('/\s+/', '_', $acx_pfm_value);// Replaces all spaces with underscores.
		$acx_pfm_value=preg_replace("/[^ \w]+/", "", $acx_pfm_value); // Removes special chars.
		$acx_pfm_value=strtolower($acx_pfm_value);

		if(taxonomy_exists($acx_pfm_value.'_tx'))
		{
			$acx_tax_name_num=rand(0,100);
			$acx_pfm_taxonomy=$acx_pfm_value.'_tx'.$acx_tax_name_num;
		}
		else{

			$acx_pfm_taxonomy=$acx_pfm_value.'_tx';
		}
		if(post_type_exists($acx_pfm_value.'_pt')){

			$acx_post_type_name_num=rand(0,100);
			$acx_post_type_name=$acx_pfm_value.'_pt'.$acx_post_type_name_num;

		}
		else{
			$acx_post_type_name=$acx_pfm_value.'_pt';
		}
		if(is_array($acx_pfm_dynamic_types) && array_key_exists($dynamic_key,$acx_pfm_dynamic_types))
		{
			if(is_array($acx_pfm_dynamic_types[$dynamic_key]) && array_key_exists('posttype',$acx_pfm_dynamic_types[$dynamic_key]))
			{
				$acx_pfm_dynamic_types[$dynamic_key]['posttype']=$acx_post_type_name;
				if(!is_serialized($acx_pfm_dynamic_types ))
				{
					$acx_pfm_dynamic_types = serialize($acx_pfm_dynamic_types);
				}
				update_option('acx_pfm_dynamic_types',$acx_pfm_dynamic_types);
			}
			$acx_pfm_dynamic_types=get_option('acx_pfm_dynamic_types');
			if(is_serialized($acx_pfm_dynamic_types))
			{
				$acx_pfm_dynamic_types=unserialize($acx_pfm_dynamic_types);
			}
			if(is_array($acx_pfm_dynamic_types[$dynamic_key]) && array_key_exists('id',$acx_pfm_dynamic_types[$dynamic_key]))
			{
				$acx_pfm_dynamic_types[$dynamic_key]['id']=$acx_pfm_value;
				if(!is_serialized($acx_pfm_dynamic_types ))
				{
					$acx_pfm_dynamic_types = serialize($acx_pfm_dynamic_types);
				}
				update_option('acx_pfm_dynamic_types',$acx_pfm_dynamic_types);
			}
		}
		$acx_pfm_post_type_labels = array(
			'name'                => $dynamic_value['label'].' Portfolio',
			'singular_name'       => $dynamic_value['label'].' Portfolio',
			'menu_name'           => $dynamic_value['label'].' Portfolio',
			'parent_item_colon'   => $dynamic_value['label'].' Portfolio',
			'all_items'           => 'All '. $dynamic_value['label'].' Portfolios',
			'view_item'           => 'View '.$dynamic_value['label'].' Portfolio',
			'add_new_item'        => 'Add New '.$dynamic_value['label'].' Portfolio',
			'edit_item'           => 'Edit '.$dynamic_value['label'].' Portfolio',
			'update_item'         => 'Update '.$dynamic_value['label'].' Portfolio',
			'search_items'        => 'Search '.$dynamic_value['label'].' Portfolios',
			'not_found'           => 'Not found',
			'not_found_in_trash'  => 'Not found in Trash',
		);

		$acx_pfm_post_type_args = array(
			'label'               => $acx_pfm_value,
			'description'         => $dynamic_value['label'].' Portfolio'.' Description',
			'labels'              => $acx_pfm_post_type_labels,
			'supports' 			  => array('title','thumbnail','editor'),
			'taxonomies'          => array($acx_pfm_taxonomy),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'menu_icon' 		  => plugin_dir_url( __FILE__ ).'/images/admin.png',
			'show_in_menu'        => true,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			);
		register_post_type( $acx_post_type_name, $acx_pfm_post_type_args );
	}
}
add_action( 'init', 'acx_pfm_post_type', 0 );
// Create Custom Taxonomy
 function acx_pfm_register_taxonomy(){
	//global $acx_pfm_dynamic_types;
	$acx_pfm_dynamic_types=get_option('acx_pfm_dynamic_types');
	if(is_serialized($acx_pfm_dynamic_types))
	{
		$acx_pfm_dynamic_types=unserialize($acx_pfm_dynamic_types);
	}
	foreach($acx_pfm_dynamic_types as $dynamic_cat_key => $dynamic_cat_value)
	{
		if(taxonomy_exists($dynamic_cat_value['id'].'_tx'))
		{
			$acx_taxonomy_name_num=rand(0,100);
			$acx_pfm_taxonomy_name=$dynamic_cat_value['id'].'_tx'.$acx_taxonomy_name_num;
		}
		else{
			$acx_pfm_taxonomy_name = $dynamic_cat_value['id'].'_tx';
		}
			$labels = array(
				'name'                       =>  $dynamic_cat_value['description'].' Category',
				'singular_name'              =>  $dynamic_cat_value['description'].' Category',
				'search_items'               =>  'Search '.$dynamic_cat_value['description'],
				'all_items'                  =>  'All '.$dynamic_cat_value['description'],
				'parent_item'           	 =>  'Parent '.$dynamic_cat_value['description'],
				'parent_item_colon'    		 =>	 'Parent '.$dynamic_cat_value['description'],
				'edit_item'			    	 =>  'Edit '.$dynamic_cat_value['description'],
				'update_item'		   	     =>  'Update '.$dynamic_cat_value['description'],
				'add_new_item' 				 =>  'Add New '.$dynamic_cat_value['description'],
				'new_item_name'		    	 =>  'New '.$dynamic_cat_value['description'],
				'separate_items_with_commas' =>	 'Separate '.$dynamic_cat_value['description'].' with commas',
				'add_or_remove_items' 		 =>  'Add or remove '.$dynamic_cat_value['description'],
				'choose_from_most_used'      =>  'Choose from the most used '.$dynamic_cat_value['description'],
				'menu_name'			    	 =>  $dynamic_cat_value['description'].' Category',
		);
		$args = array(
			'labels' 			=> $labels,
			'public' 			=> true,
			'show_in_nav_menus' => false,
			'show_ui' 			=> true,
			'show_tagcloud' 	=> false,
			'show_admin_column' => true,
			'hierarchical' 		=> true,
			'rewrite' 			=> true,
		);
		register_taxonomy( $acx_pfm_taxonomy_name , array($dynamic_cat_value['posttype']) , $args );
	}
}
add_action( 'init', 'acx_pfm_register_taxonomy');

function acx_pfm_styles()
{	wp_register_style('acx_pfm_style', plugins_url('style.css', __FILE__));
	wp_enqueue_style('acx_pfm_style');
}
add_action('admin_enqueue_scripts', 'acx_pfm_styles');

function acx_pfm_jquery_ui()
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
}
add_action('admin_enqueue_scripts','acx_pfm_jquery_ui');
add_action('wp_enqueue_scripts','acx_pfm_jquery_ui');

// start add meta box in custom post type
	function acx_pfm_add_meta_box()
	{
		global $acx_pfm_dynamic_types;
		foreach($acx_pfm_dynamic_types as $metakey => $metaval)
		{
			add_meta_box( 'acx_pfm_settings_meta_box_'.$metakey,$metaval['label'],'acx_pfm_meta_box',$metaval['posttype'], 'normal', 'high');
		}
	}
	add_action( 'add_meta_boxes', 'acx_pfm_add_meta_box' );

function acx_pfm_meta_box( $acx_pfm_settings ) {
	// getting the values
	global $acx_pfm_dynamic_types;
	foreach($acx_pfm_dynamic_types as $key => $value)
	{
		if(get_post_type($acx_pfm_settings->ID)==$value['posttype'])
		{
			$acx_pfm_custom_array="acx_pfm_custom_fields_".$value['posttype'];
		}
	}
	$acx_pfm_custom_fields=get_option($acx_pfm_custom_array);
	if(is_serialized($acx_pfm_custom_fields ))
	{
		$acx_pfm_custom_fields = unserialize($acx_pfm_custom_fields);
	}
	if($acx_pfm_custom_fields == "")
		{
			$acx_pfm_custom_fields = array();
		}
	$acx_pfm_default_no_image =  plugin_dir_url( __FILE__ ).'/images/noimage.jpg';
	?>
	<table>
	<?php $acx_pfm_type = get_post_meta($acx_pfm_settings->ID, 'acx_pfm_type',true);
		echo '<tr><td>Choose Type</td><td><select name="acx_pfm_type" id="acx_pfm_type" onchange="acx_pfm_type_onchange();"><option value="web" '; if($acx_pfm_type == '' || $acx_pfm_type == 'web'){echo 'selected="selected"';}echo '>WEBSITE</option><option value="logo" '; if($acx_pfm_type == 'logo'){echo 'selected="selected"';}echo '>LOGO</option></select></td></tr>';

	if(ISSET($_GET['action']))
	{
		$action=$_GET['action'];
	}
	else{
		$action="";
	}  if($action=="edit")
	{

		foreach($acx_pfm_custom_fields as $key_edit => $value_edit)
		{
			echo '<tr>';
			switch ($value_edit['type'])
			{
				case 'text':
				echo '<tr><td  style="width:40%;"><p>'.$value_edit['label'].'</p></td>
					<td><input type="text"  value="'.get_post_meta($acx_pfm_settings->ID, $value_edit['id'],true).'"  name="'.$value_edit['id'].'"  id="'.$value_edit['id'].'" size="30" /></td>
					<td><br /><span class="description">'.$value_edit['desc'].'</span></td>';
				break;
				case 'textarea':
				echo '<tr><td  style="width:40%;"><p>'.$value_edit['label'].'</p></td>
					<td><textarea style="width: 274px; height: 57px;" name="'.$value_edit['id'].'"  id="'.$value_edit['id'].'">'.get_post_meta($acx_pfm_settings->ID, $value_edit['id'],true).'</textarea></td>
					<td><br /><span class="description">'.$value_edit['desc'].'</span></td>';
				break;
				case 'image':
				if(get_post_meta($acx_pfm_settings->ID, $value_edit['id'],true) != "")
				{
					$image=esc_url(get_post_meta($acx_pfm_settings->ID, $value_edit['id'],true));

				}
				else{
					$image = $acx_pfm_default_no_image;
				}
				echo '<tr><td  style="width:40%;"><p>'.$value_edit['label'].'</p></td>
					<input type="hidden" name="'.$value_edit['id'].'"  id="'.$value_edit['id'].'" value="" />
					<td><a name="'.$value_edit['id']."_button".'"  id="'.$value_edit['id']."_button".'" class="button">Upload an Image</a></td>
					<td><img name="'.$value_edit['id']."_image".'"  id="'.$value_edit['id']."_image".'"  src="'.$image.'" style="width:100px;height:200px;"></td>
					<td><br /><span class="description">'.$value_edit['desc'].'</span></td>';
				break;
			}
			echo '</tr>';
		}
	}
	else{

		foreach($acx_pfm_custom_fields as $key=>$value)
		{
			echo '<tr>';
			switch ($value['type'])
			{
				case 'text':
				echo '<tr><td  style="width:40%;"><p>'.$value['label'].'</p></td>
					<td><input type="text"  value="'.$value['default_value'].'"  name="'.$value['id'].'"  id="'.$value['id'].'" size="30" /></td>
					<td><br /><span class="description">'.$value['desc'].'</span></td>';
				break;
				case 'textarea':
				echo '<tr><td  style="width:40%;"><p>'.$value['label'].'</p></td>
					<td><textarea style="width: 274px; height: 57px;" name="'.$value['id'].'"  id="'.$value['id'].'">'.$value['default_value'].'</textarea></td>
					<td><br /><span class="description">'.$value['desc'].'</span></td>';
				break;
				case 'image':
					if($value['default_value']==""){
						$image = $acx_pfm_default_no_image;
					}
						else
						{
							$image = esc_url($value['default_value']);
						}
				echo '<tr><td  style="width:40%;"><p>'.$value['label'].'</p></td>
					<input type="hidden" name="'.$value['id'].'"  id="'.$value['id'].'" value="" />
					<td><a name="'.$value['id']."_button".'"  id="'.$value['id']."_button".'" class="button">Upload an Image</a></td>
					<td><img name="'.$value['id']."_image".'"  id="'.$value['id']."_image".'"  src="'.
						$image.'" style="width:100px;height:auto;"></td>
					<td><br /><span class="description">'.$value['desc'].'</span></td>';
				break;
			}
			echo '</tr>';
		}
		}
	?>
	</table>
	<?php foreach($acx_pfm_custom_fields as $key1 => $value1)
	{?>
	<script type="text/javascript">
	jQuery(document).ready(function()
	{
		acx_pfm_show_meta_image("<?php echo $value1['id']."_button";?>","Choose Image","Choose Image","<?php echo $value1['id'];?>","<?php echo $value1['id']."_image";?>");
	});
	function acx_pfm_type_onchange()
	{
		var acx_opt = jQuery('#acx_pfm_type').val();
		console.log(acx_opt);
	}
	</script>
	<?php
	}
}
function prfx_image_enqueue() {
	global $acx_pfm_dynamic_types;
		foreach($acx_pfm_dynamic_types as $metakey => $metaval)
		{
			global $typenow;
			if( $typenow == $metaval['posttype'] ) {
			if(function_exists('wp_enqueue_media'))
			{
				wp_enqueue_media();
			}
			   // Registers and enqueues the required javascript.
				wp_register_script( 'acx-pfm-meta-box-image', plugins_url('meta-box-image.js', __FILE__), array( 'jquery' ) );
				wp_enqueue_script( 'acx-pfm-meta-box-image' );
			}
		}
}
add_action( 'admin_enqueue_scripts', 'prfx_image_enqueue' );
function acx_pfm_add_meta_box_db( $id, $acx_pfm_settings ) {
    // Check for the post type
	global $acx_pfm_dynamic_types;

foreach($acx_pfm_dynamic_types as $metakey => $metaval)
{
    if ( $acx_pfm_settings->post_type == $metaval['posttype'] ) {
        // Store data in post meta table if present in post data
		foreach($acx_pfm_dynamic_types as $key => $value)
		{
			if(get_post_type($id)==$value['posttype'])
			{
			$acx_pfm_custom_array="acx_pfm_custom_fields_".$value['posttype'];
			}
		}
		$acx_pfm_custom_fields=get_option($acx_pfm_custom_array);
		if(is_serialized($acx_pfm_custom_fields ))
		{
			$acx_pfm_custom_fields = unserialize($acx_pfm_custom_fields);
		}
		if($acx_pfm_custom_fields == "")
		{
			$acx_pfm_custom_fields = array();
		}
		if( isset( $_POST['acx_pfm_type'] ) && $_POST['acx_pfm_type']!='' ) {
				update_post_meta( $id, 'acx_pfm_type', $_POST['acx_pfm_type'] );
				}

		foreach($acx_pfm_custom_fields as $key_update => $value_update)
		{
			switch($value_update['type'])
			{
				case "text" :
				if( isset( $_POST[ $value_update['id'] ] ) && $_POST[$value_update['id']]!='' ) {
				update_post_meta( $id, $value_update['id'], $_POST[$value_update['id']] );
				}
				break;

				case "textarea":
				if( isset( $_POST[ $value_update['id'] ] ) && $_POST[$value_update['id']]!='' ) {
				update_post_meta( $id, $value_update['id'], $_POST[$value_update['id']] );
				}
				break;
				case "image" :
				if( isset( $_POST[$value_update['id']] ) && $_POST[$value_update['id']]!='' ) {
				update_post_meta( $id, $value_update['id'], esc_url_raw($_POST[$value_update['id']]) );
				}
				break;
			}
		}
    }
}
}add_action( 'save_post', 'acx_pfm_add_meta_box_db', 10, 2 );

// Customise Featured Image
function acx_pfm_move_thumbnail_meta_box(){
	global $acx_pfm_dynamic_types;
		foreach($acx_pfm_dynamic_types as $metakey => $metaval)
		{
			remove_meta_box( 'postimagediv', $metaval['posttype'], 'side' );
			add_meta_box('postimagediv', __('Image'), 'post_thumbnail_meta_box', $metaval['posttype'], 'normal', 'high');
		}
}add_action('do_meta_boxes', 'acx_pfm_move_thumbnail_meta_box');

function acx_p_fm_custom_enter_title( $input ) {
	global $acx_pfm_dynamic_types;

		foreach($acx_pfm_dynamic_types as $metakey => $metaval)
		{
			global $post_type;
			if( is_admin() && 'Enter title here' == $input && $metaval['posttype'] == $post_type )
				return 'Enter the Project Name';
			return $input;
		}
}
add_filter('gettext','acx_p_fm_custom_enter_title');
function acx_pfm_delete_array_values_callback()
{
	global $acx_pfm_dynamic_types;
	$acx_pfm_default_no_image=  plugin_dir_url( __FILE__ ).'/images/noimage.jpg';

	if(ISSET($_POST['dynamic_array']))
	{
		$dynamic_array=$_POST['dynamic_array'];
	}
	else{

		$dynamic_array="";
	}
	$acx_pfm_custom_fields=get_option($dynamic_array);
	if(is_serialized($acx_pfm_custom_fields ))
	{
		$acx_pfm_custom_fields = unserialize($acx_pfm_custom_fields);
	}
	$acx_pfm_custom_fields=array(
			array(
				'id'    => 'acx_project_summary',
				'label'=> 'Project Summary',
				'desc'  => 'A description for the Project Summary.',
				'type'  => 'textarea',
				'default_value' =>'',
				),
			array(
				'id'    => 'acx_client_name',
				'label'=>' Client Name',
				'desc'  => 'A description for the Client Name.',
				'type'  => 'text',
				'default_value' =>'',
				),
				array(
				'id'    => 'acx_location',
				'label'=> 'Location',
				'desc'  => 'A description for the Location.',
				'type'  => 'text',
				'default_value' =>'',
				),
				array(
				'id'    => 'acx_link',
				'label'=> 'Link',
				'desc'  => 'A description for the Link.',
				'type'  => 'text',
				'default_value' =>'',
				),
				array(
				'id'    => 'acx_web_image',
				'label'=> 'Website Image',
				'desc'  => 'A description for the Wesite Image.',
				'type'  => 'image',
				'default_value' =>esc_url_raw($acx_pfm_default_no_image),
				),
				array(
				'id'    =>'acx_tab_image',
				'label'=> 'Tablet Image',
				'desc'  => 'A description for the Tablet Image.',
				'type'  => 'image',
				'default_value' =>esc_url_raw($acx_pfm_default_no_image),
				),
				array(
				'id'    => 'acx_mob_image',
				'label'=> 'Mobile Image',
				'desc'  => 'A description for the Mobile Image.',
				'type'  => 'image',
				'default_value' =>esc_url_raw($acx_pfm_default_no_image),
				),
				array(
					'id'    => 'acx_logo_image',
					'label'=> 'Logo ',
					'desc'  => 'A description for the Logo.',
					'type'  => 'image',
					'default_value' =>esc_url_raw($acx_pfm_default_no_image),
					),
					array(
					'id'    => 'acx_tools_used',
					'label'=> 'Technologies Used ',
					'desc'  => 'A description for the Technologies Used.',
					'type'  => 'text',
					'default_value' =>'',
					)
			);
	if(!is_serialized($acx_pfm_custom_fields ))
	{
		$acx_pfm_custom_fields = serialize($acx_pfm_custom_fields);
	}
	update_option($dynamic_array, $acx_pfm_custom_fields);
	echo "success";
	die(); // this is required to return a proper result
}add_action('wp_ajax_acx_pfm_delete_array_values','acx_pfm_delete_array_values_callback');
