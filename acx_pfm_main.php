<?php
/* 
Plugin Name: PortFolio Manager
Plugin URI: http://www.acurax.com/Products/
Description: 
Author: Acurax 
Version: 1.0
Author URI: http://www.acurax.com 
License: GPLv2 or later
*/
$acx_pfm_dynamic_types=get_option('acx_pfm_dynamic_types');
if(is_serialized($acx_pfm_dynamic_types))
{
	$acx_pfm_dynamic_types = unserialize($acx_pfm_dynamic_types); 
}
if($acx_pfm_dynamic_types == "" || !is_array($acx_pfm_dynamic_types))
{
	$acx_pfm_dynamic_types = array(
								'1' => array(
											'label' => 'Webex',
											'description' => 'Portfolio',
											'id' => '',
											'posttype' => ''
											)
								);
	if(!is_serialized($acx_pfm_dynamic_types ))
	{
		$acx_pfm_dynamic_types = serialize($acx_pfm_dynamic_types); 
	}
	update_option('acx_pfm_dynamic_types',$acx_pfm_dynamic_types);
}
		
include("function.php");
function acx_pfm_settings(){
	include("acx_pfm_settings.php");
} 
function acx_pfm_settings_page() {
	global $acx_pfm_dynamic_types;
	foreach($acx_pfm_dynamic_types as $metakey => $metaval)
	{
		$acx_pfm_link="edit.php?post_type=".$metaval['posttype'];
		add_submenu_page($acx_pfm_link, 'Settings', 'Settings', 'edit_posts', 'acx-pfm-settings-'.$metaval['posttype'], 'acx_pfm_settings');
	}
}add_action('admin_menu' ,'acx_pfm_settings_page');
?>