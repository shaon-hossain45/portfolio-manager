<?php
$acx_pfm_message ="";
$acx_pfm_default_no_image=  plugin_dir_url( __FILE__ ).'/images/noimage.jpg';
$acx_pfm_dynamic_types=get_option('acx_pfm_dynamic_types');
if(is_serialized($acx_pfm_dynamic_types))
{
	$acx_pfm_dynamic_types=unserialize($acx_pfm_dynamic_types);
}

foreach($acx_pfm_dynamic_types as $key => $value)
{	
$acx_pfm_dynamic_array='acx_pfm_custom_fields_'.$value['posttype'];
	$acx_pfm_custom_fields=get_option($acx_pfm_dynamic_array);
		if($acx_pfm_custom_fields == "")
		{
			$acx_pfm_custom_fields= array(
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
				update_option($acx_pfm_dynamic_array, $acx_pfm_custom_fields);
		}
		
		if(is_serialized($acx_pfm_custom_fields ))
		{
			$acx_pfm_custom_fields = unserialize($acx_pfm_custom_fields); 
		}
}
if(ISSET($_GET['action']))
{
 $acx_action=$_GET['action'];
}
else
{
   $acx_action='';
}
if(ISSET($_GET['ID']))
{
	 $id=$_GET['ID'];
}
else
{
	$id='';
}
if($acx_action == "delete" && $id !="")
{	$acx_pfm_dynamic_array="";
	foreach($acx_pfm_dynamic_types as $post_key => $post_val)
	{
		if(ISSET($_GET['post_type']))
		{
			$post_type=$_GET['post_type'];
		}
		else{
			$post_type=="";
		}
		if($post_type==$post_val['posttype'])
		{
			$acx_pfm_dynamic_array='acx_pfm_custom_fields_'.$post_val['posttype'];
		} 
	} 
	$acx_pfm_custom_fields=get_option($acx_pfm_dynamic_array);
	if(is_serialized($acx_pfm_custom_fields ))
	{
		$acx_pfm_custom_fields = unserialize($acx_pfm_custom_fields); 
	}
	foreach($acx_pfm_custom_fields as $key=>$value)
	{
		if($id-1 == $key)
		{	
			unset($acx_pfm_custom_fields[$id-1]);
			
			//$acx_pfm_custom_fields = array_values($acx_pfm_custom_fields);
			if(!is_serialized($acx_pfm_custom_fields ))
			{
				$acx_pfm_custom_fields = serialize($acx_pfm_custom_fields); 
			}
			update_option($acx_pfm_dynamic_array, $acx_pfm_custom_fields);
		}
	}
	$acx_pfm_message = "Deleted Successfully!.";
}	
if ((ISSET( $_POST['action'] ) && $_POST['action'] == 'bulk_delete') || (ISSET( $_POST['action2'] ) && $_POST['action2'] == 'bulk_delete'))  
{
	$acx_pfm_bulk_array=$_POST['acx_pfm_checkbox'];
	foreach($acx_pfm_dynamic_types as $post_key => $post_val)
	{
		if(ISSET($_GET['post_type']))
		{
			 $post_type=$_GET['post_type'];
		}
		else{
			$post_type=="";
		}
		if($post_type==$post_val['posttype'])
		{
			$acx_pfm_dynamic_array='acx_pfm_custom_fields_'.$post_val['posttype'];
		} 
	} 

	foreach($acx_pfm_custom_fields as $key1 => $value1)
	{
		foreach($acx_pfm_bulk_array as $key2 =>$value2)
		{
			if($value2 - 1 == $key1)
			{
				unset($acx_pfm_custom_fields[$value2 - 1]);
			}
		}
	}  
	//$acx_pfm_custom_fields = array_values($acx_pfm_custom_fields);
	if(!is_serialized($acx_pfm_custom_fields))
	{
		$acx_pfm_custom_fields = serialize($acx_pfm_custom_fields); 
	}
	update_option($acx_pfm_dynamic_array, $acx_pfm_custom_fields);
	$acx_pfm_message = " Deleted Successfully!.";
}
if($acx_action == "confirmation")
 {
	 if(ISSET($_GET['post_type']))
	 {
		$acx_post_type = $_GET['post_type'];
	 }
	 else{
		$acx_post_type = "";
	 }
	 $acx_msg_error = "<div id='acx_pfm_confirm_delete_msg'><h2>Are you sure to delete this.You cannot undo this action.</h2> <br /><a class='button' onclick='acx_pfm_confirm_delete(1);'>YES</a> <a class='button'  onclick='acx_pfm_confirm_delete(2);'>NO</a></div>";
	$acx_pfm_custom_array="";
	foreach($acx_pfm_dynamic_types as $key => $value)
	{	
		if($acx_post_type == $value['posttype'])
		{
			$acx_pfm_posttype = $value['posttype'];
			$acx_pfm_custom_array = "acx_pfm_custom_fields_".$value['posttype'];
		}
	}
	 ?>
	 <script type="text/javascript">
		function acx_pfm_confirm_delete(value)
		{	var dynamic_array="<?php echo $acx_pfm_custom_array; ?>";
			//alert(dynamic_array);
			if(value == 1)
			{
				var order ='dynamic_array='+dynamic_array+'&action=acx_pfm_delete_array_values';
				jQuery.post(ajaxurl, order, function(theResponse)
				{
				
				if(theResponse == "success")
				{
					window.location = "edit.php?post_type=<?php echo $acx_pfm_posttype;?>&page=acx-pfm-settings-<?php echo $acx_pfm_posttype;?>";
				}
				});
			} 
			else
			{
				window.location = "edit.php?post_type=<?php echo $acx_pfm_posttype;?>&page=acx-pfm-settings-<?php echo $acx_pfm_posttype;?>";
			}
			
		}
		</script>
		<?php wp_die($acx_msg_error);
}


if(ISSET($_POST['acx_pfm_create_form_hidden']))
{
	$acx_pfm_create_form_hidden=$_POST['acx_pfm_create_form_hidden'];
}
else
{
	$acx_pfm_create_form_hidden="";
}
if($acx_pfm_create_form_hidden=='Y')
{
	if (!isset($_POST['acx_pfm_save_config'])) die("<br><br>Unknown Error Occurred, Try Again... <a href=''>Click Here</a>");
	if (!wp_verify_nonce($_POST['acx_pfm_save_config'],'acx_pfm_save_config')) die("<br><br>Unknown Error Occurred, Try Again... <a href=''>Click Here</a>");
	if(!current_user_can('manage_options')) die("<br><br>Sorry, You have no permission to do this action...</a>");	
	$acx_pfm_custom_array="";
	if(ISSET($_GET['post_type']))
	 {
		$acx_post_type = $_GET['post_type'];
	 }
	 else{
		$acx_post_type = "";
	 }
	foreach($acx_pfm_dynamic_types as $key => $value)
	{	
		if($acx_post_type == $value['posttype'])
		{
			$acx_pfm_custom_array="acx_pfm_custom_fields_".$value['posttype'];
		}
	}
	$acx_pfm_custom_fields=get_option($acx_pfm_custom_array);
	if(is_serialized($acx_pfm_custom_fields ))
	{
		$acx_pfm_custom_fields = unserialize($acx_pfm_custom_fields); 
	}
	
	$acx_pfm_label=$_POST['acx_pfm_label'];
	$acx_pfm_label_id=preg_replace('/\s+/', '_', $acx_pfm_label);// Replaces all spaces with underscores.
	$acx_pfm_label_id=preg_replace("/[^ \w]+/", "", $acx_pfm_label_id); // Removes special chars.
	$acx_pfm_label_id=strtolower($acx_pfm_label_id);
	$acx_found_id=0;
	foreach($acx_pfm_custom_fields as $k=>$v)
	{
		if($v['id'] == $acx_pfm_label_id)
		{
			$acx_found_id = 1;
		}
	}
	if($acx_found_id == 1)
	{ $acx_pfm_label_random_id=rand(0,100);
	$acx_pfm_label_id=$acx_pfm_label_id.$acx_pfm_label_random_id; 
	}
	$acx_pfm_desc=$_POST['acx_pfm_desc'];
	$acx_pfm_field_type=$_POST['acx_pfm_field_type'];
	if($acx_pfm_field_type == "text" || $acx_pfm_field_type =="textarea" )
	{
	$acx_pfm_default_val=sanitize_text_field($_POST['acx_pfm_default_text']);
	}
	else{
	if(ISSET($_POST['acx_pfm_image']))
	{
		$acx_pfm_default_val=esc_url_raw($_POST['acx_pfm_image']);
	}
	else{
		
		$acx_pfm_default_val="";
	}
	}
	$acx_pfm_custom_fields[]=array(
								'id' =>$acx_pfm_label_id,
								'label'=> sanitize_text_field($acx_pfm_label),
								'desc'  =>sanitize_text_field($acx_pfm_desc),
								'type'  =>$acx_pfm_field_type,
								'default_value' =>$acx_pfm_default_val,
								);
								
	if(!is_serialized($acx_pfm_custom_fields ))
	{
		$acx_pfm_custom_fields = serialize($acx_pfm_custom_fields); 
	}

	update_option($acx_pfm_custom_array, $acx_pfm_custom_fields);
	$acx_pfm_message = "Portfolio Manager Settings Saved Successfully!";
}

if(ISSET($_POST['acx_pfm_form_edit_hidden']))
	{
		$acx_pfm_form_edit_hidden=$_POST['acx_pfm_form_edit_hidden'];
	}
	else{
		$acx_pfm_form_edit_hidden='';
	}
	if($acx_pfm_form_edit_hidden == 'Y')
	{
		if(ISSET($_GET['post_type']))
		 {
			$acx_post_type = $_GET['post_type'];
		 }
		 else{
			$acx_post_type = "";
		 }
		$acx_pfm_custom_array="";
		foreach($acx_pfm_dynamic_types as $key => $value)
		{	
			if($acx_post_type == $value['posttype'])
			{
			$acx_pfm_custom_array="acx_pfm_custom_fields_".$value['posttype'];
			}
		}
		$acx_pfm_custom_fields=get_option($acx_pfm_custom_array);
		if(is_serialized($acx_pfm_custom_fields))
		{
			$acx_pfm_custom_fields = unserialize($acx_pfm_custom_fields); 
		}
		
		$acx_pfm_edit_id=$_POST['acx_pfm_edit_id'];
		$acx_pfm_label_edit=$_POST['acx_pfm_label_edit'];
		
		$acx_pfm_label_edit_id=preg_replace('/\s+/', '_', $acx_pfm_label_edit);// Replaces all spaces with underscores.
		$acx_pfm_label_edit_id=preg_replace("/[^ \w]+/", "", $acx_pfm_label_edit_id); // Removes special chars.
		$acx_pfm_label_edit_id=strtolower($acx_pfm_label_edit_id);
		$acx_found_edit_id=false; 
		$edit_id ="";
		foreach($acx_pfm_custom_fields as $key_edit=>$val_edit)
		{
			if($acx_pfm_edit_id-1 === $key_edit)
			{
				$acx_found_edit_id = true;
				$edit_id = $val_edit['id'];
			}
			
		}
		if($acx_found_edit_id == true)
		{	
			$acx_pfm_label_edit_id = $edit_id;
			$acx_pfm_desc_edit=sanitize_text_field($_POST['acx_pfm_desc_edit']);
			$acx_pfm_field_type_edit=$_POST['acx_pfm_field_type_edit'];
			if($acx_pfm_field_type_edit == "text" || $acx_pfm_field_type_edit =="textarea" )
			{
			$acx_pfm_default_val_edit=sanitize_text_field($_POST['acx_pfm_default_text_edit']);
			}
			else{
			$acx_pfm_default_val_edit=esc_url_raw($_POST['acx_pfm_image_edit']);
			}
			
			$acx_pfm_custom_fields[$acx_pfm_edit_id-1]=array(
										'id' =>$acx_pfm_label_edit_id,
										'label'=> sanitize_text_field($acx_pfm_label_edit),
										'desc'  =>$acx_pfm_desc_edit ,
										'type'  =>$acx_pfm_field_type_edit ,
										'default_value' =>$acx_pfm_default_val_edit,
										);
			if(!is_serialized($acx_pfm_custom_fields ))
			{
				$acx_pfm_custom_fields = serialize($acx_pfm_custom_fields); 
			}
			update_option($acx_pfm_custom_array, $acx_pfm_custom_fields);
		
			$acx_pfm_message = "Portfolio Manager Settings Updated!";
		}
		else{
		$acx_pfm_message = "Invalid Details!";
		}
		
	}
// Our class extends the WP_List_Table class, so we need to make sure that it's there
if( ! class_exists( 'WP_List_Table' ) ) 
{
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class  Acx_Pfm_My_List_Table extends WP_List_Table 
{
	function __construct()
	{
		global $status, $page;
		parent::__construct( array(
				'singular'  => __( 'type', 'mylisttable' ),     //singular name of the listed records
				'plural'    => __( 'types', 'mylisttable' ),   //plural name of the listed records
				'ajax'      => false        //does this table support ajax?
								) );
	}
	 // here for compatibility with 4.3
    function get_columns()
    {
        // Get options
        return $this->acx_pfm_get_columns();
    }
	
	function acx_pfm_data()
	{
		$acx_pfm_custom_array="";
		global $acx_pfm_dynamic_types,$acx_pfm_default_no_image,$acx_pfm_custom_array;
		foreach($acx_pfm_dynamic_types as $key => $value)
		{	
			if($_GET['post_type']==$value['posttype'])
			{
			$acx_pfm_custom_array="acx_pfm_custom_fields_".$value['posttype'];
			}
		}
		$acx_pfm_custom_fields=get_option($acx_pfm_custom_array);
		if($acx_pfm_custom_fields == "")
		{
			$acx_pfm_custom_fields = array();
		}	
		if(is_serialized($acx_pfm_custom_fields ))
		{
			$acx_pfm_custom_fields = unserialize($acx_pfm_custom_fields); 
		}	 
		$acx_pfm_custom_fields_new = array();
		$i= 1;
		foreach($acx_pfm_custom_fields as $key => $value)
		{
			$acx_unique_id="<input type='text' name='acx_unique_id' id='acx_unique_id'  style='max-width:100%;' value='"."{".$value['id']."}"."' readonly onClick='javascript:this.focus();this.select();'>";
			if($value['type'] == "image")
			{	
				if($value['default_value']=="")
				{
					$default="<img src='".$acx_pfm_default_no_image."' width='50px' height='50px'>";
				}
				else{
					$default="<img src='".esc_url($value['default_value'])."' width='50px' height='50px'>";
				}
				$acx_pfm_custom_fields_new[]=array(
				'ID'=>$i,
				'LABEL'  => $value['label'],
				'DESCRIPTION' => $value['desc'],
				'TYPE'   => $value['type'],
				'DEFAULT VALUE' => $default,
				'UNIQUE IDENTIFIER' => $acx_unique_id
				);
			}
			else
			{
				$acx_pfm_custom_fields_new[]=array(
				'ID'=>$i,
				'LABEL'  => $value['label'],
				'DESCRIPTION'   => $value['desc'],
				'TYPE'   => $value['type'],
				'DEFAULT VALUE'  => $value['default_value'],
				'UNIQUE IDENTIFIER' => $acx_unique_id
				);
			} 
			$i++;
		}
		return $acx_pfm_custom_fields_new;
	}
	function acx_pfm_get_columns()
	{
		$columns = array(
			'cb'        => '<input type="checkbox" />',
			'ID'     => 'Sl No',
			'LABEL'  => 'LABEL',
			'DESCRIPTION'   => 'DESCRIPTION',
			'TYPE'   => 'TYPE',
			'DEFAULT VALUE'  => 'DEFAULT VALUE',
			'UNIQUE IDENTIFIER' =>' UNIQUE IDENTIFIER'
						);
		return $columns;
	}
	function acx_pfm_prepare_items()
	{
		$columns = $this->acx_pfm_get_columns();
		$hidden = array();
		$sortable = $this->acx_pfm_get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->items = $this->acx_pfm_data();
		usort( $this->items,array( &$this, 'acx_pfm_usort_reorder' ) );
	}
	function column_TYPE($item)
	{
		global $acx_pfm_dynamic_types;
		foreach($acx_pfm_dynamic_types as $post_key => $post_val)
		{
			if(ISSET($_GET['post_type']))
			{
				 $post_type=$_GET['post_type'];
			}
			else{
				$post_type=="";
			}
			if($post_type==$post_val['posttype'])
			{
				$actions = array(
						'delete' => sprintf('<a href="?post_type='.$post_type.'&page=%s&action=%s&ID=%s">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
						'edit' => sprintf('<a href="?post_type='.$post_type.'&page=%s&action=%s&ID=%s">Edit</a>',$_REQUEST['page'],'edit',$item['ID'])
						);
			}
		}
		return sprintf('%1$s %2$s', $item['TYPE'], $this->row_actions($actions) );
	}
	function acx_pfm_get_sortable_columns()
	{
		$sortable_columns = array(
	  		'ID'  => array('ID',false),
			'LABEL' => array('LABEL',false),
			'DESCRIPTION' => array('DESCRIPTION',false),
			'TYPE' => array('TYPE',false),
			'DEFAULT VALUE' => array('DEFAULT VALUE',false),
			'UNIQUE IDENTIFIER' => array('UNIQUE IDENTIFIER',false)
	  							);
							
	  return $sortable_columns;
	}
	function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="acx_pfm_checkbox[]" value="%s" />', $item['ID']
        );    
    }
	 function get_bulk_actions() {
	  $actions = array(
		'bulk_delete'    => 'Delete'
	  );
	  return $actions;
	} 
	function acx_pfm_usort_reorder( $a, $b ) 
	{
		// If no sort, default to title
		$orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'ID';
		// If no order, default to asc
		$order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
		// Determine sort order
		$result = strnatcmp( $a[$orderby], $b[$orderby] );
		// Send final sort direction to usort
		return ( $order === 'asc' ) ? $result : -$result;
	}
	function no_items() 
	{
		_e( 'No Fields found !!!!' );
	}
	function column_default( $item, $column_name ) 
	{
		switch( $column_name )
		{ 
			case 'ID':
			case 'LABEL':
			case 'DESCRIPTION':
			case 'TYPE':
			case 'DEFAULT VALUE':
			case 'UNIQUE IDENTIFIER':
			return $item[ $column_name ];
			default:
			return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
		}
	}
}
function acx_pfm_render_list_page()
{
   $myListTable = new Acx_pfm_My_List_Table();
   echo '<div class="wrap">'; 
   $myListTable->acx_pfm_prepare_items(); 
   $myListTable->display(); 
   echo '</div>'; 
}
?>
<div class="wrap">
<?php echo "<h2>" . __( 'PortFolio Manager', 'acx_pfm_config' ) . "</h2>";
if($acx_pfm_message != "")
{
	echo "<div class='updated'><p><strong>".$acx_pfm_message."</strong></p></div>";
}
if(ISSET($_GET['post_type']))
{
	$post_type=$_GET['post_type'];
}
else{
	$post_type=="";
}
foreach($acx_pfm_dynamic_types as $post_key => $post_val)
{
	if($post_type==$post_val['posttype'])
	{
?>
<div id="acx_pfm_button_link">
<a  class="button" href="edit.php?post_type=<?php echo $post_val['posttype'];?>&page=acx-pfm-settings-<?php echo $post_val['posttype'];?>&action=add">CREATE NEW FIELD</a>
<a  class="button" href="edit.php?post_type=<?php echo $post_val['posttype'];?>&page=acx-pfm-settings-<?php echo $post_val['posttype'];?>&action=confirmation">RESTORE TO DEFAULT FIELDS</a>
</div>
<?php
	}
} 
 if($acx_action == 'add'){
$acx_pfm = str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);
if($acx_pfm != "")
{
	$acx_pfm = str_replace("action=delete&ID","acurax",$acx_pfm);
}
?>
	<form name="acx_pfm_create_form" method="post" action="<?php echo $acx_pfm;?>">
	<table>
		<tr><td>
			<?php echo "<h4>" . __( 'Add new Fields', 'acx_pfm_config' ) . "</h4>"; ?></td></tr>
		<tr><td>
		<input type="hidden" name="acx_pfm_create_form_hidden" value="Y"></td></tr>
		<tr><td><p><?php _e("Label:");?></td><td><input type="text" name="acx_pfm_label" id="acx_pfm_label" value="" size="22">
		</td></tr>
		<tr><td><p><?php _e("Description:");?></td><td><input type="text" name="acx_pfm_desc" id="acx_pfm_desc" value="" size="22">
		</td></tr>
		<tr><td><p><?php _e("Field Type:");?></td><td>
		<select name="acx_pfm_field_type" id="acx_pfm_field_type" onchange="acx_pfm_default_value();">
		<option value="">--Select--</option>
		<option value="text"  id="text">Text</option>
		<option value="textarea" id="textarea">TextArea</option>
		<option value="image" id="image">Image Upload</option>
		</select>
		</td></tr>
	</table>
	<div id="acx_pfm_text_default" style="display:none;">
	<table>
	<tr><td><p><?php _e("Default value:");?></td><td><input type="text" name="acx_pfm_default_text" id="acx_pfm_default_text" value="" size="22">
	</td></tr>
	</table>
	</div>
	<div id="acx_pfm_img_default" style="display:none;">
	<table>
	<tr><td><p><?php _e("Default value:");?></td>
	<input type="hidden" name="acx_pfm_image" id="acx_pfm_image" value="" />
	<td><a id="acx_pfm_image_button" class="button">Upload an Image</a></td>
	<td><img id="acx_pfm_image_field" src="<?php echo $acx_pfm_default_no_image;?>" style="width:100px;height:auto;">
	</td></tr>
	</table>
	</div>
	<table>
	<input name='acx_pfm_save_config' type='hidden' value='<?php echo wp_create_nonce('acx_pfm_save_config');?>'/>
	<tr><td>
	<input type="submit" name="Submit" value="<?php _e('CREATE', 'acx_pfm_config');?>" onclick="javascript:return acx_pfm_validate_fields();">
	</p></tr>
	</table>
</form><?php }

if(ISSET($_GET['action']))
{
 $action=$_GET['action'];
}
else
{
   $action='';
} 
if(ISSET($_GET['ID']))
{
 $edit_id=$_GET['ID'];
}
else
{
	$edit_id='';
}
if($acx_action == "edit" && $edit_id!="")
{
$acx_pfm_custom_array="";
if(ISSET($_GET['post_type']))
{
 $acx_post_type=$_GET['post_type'];
}
else
{
	$acx_post_type='';
}
	foreach($acx_pfm_dynamic_types as $key => $value)
	{	
		if($acx_post_type==$value['posttype'])
		{
		$acx_pfm_custom_array="acx_pfm_custom_fields_".$value['posttype'];
		}
	}
	$acx_pfm_custom_fields=get_option($acx_pfm_custom_array);

if(is_serialized($acx_pfm_custom_fields ))
{
	$acx_pfm_custom_fields = unserialize($acx_pfm_custom_fields); 
}	

if($acx_pfm_custom_fields[$edit_id-1]['type']!=="")
{
	$acx_pfm_type=$acx_pfm_custom_fields[$edit_id-1]['type'];
}
else{
$acx_pfm_type="";
}
if($acx_pfm_custom_fields[$edit_id-1]['label']!="")
{
	$acx_pfm_label=$acx_pfm_custom_fields[$edit_id-1]['label'];
}
else{
$acx_pfm_label="";
}
if($acx_pfm_custom_fields[$edit_id-1]['desc']!="")
{
	$acx_pfm_desc=$acx_pfm_custom_fields[$edit_id-1]['desc'];
}
else{
$acx_pfm_desc="";
}
if($acx_pfm_custom_fields[$edit_id-1]['default_value']!="")
{
	$acx_pfm_default_value=$acx_pfm_custom_fields[$edit_id-1]['default_value'];
}
else{
$acx_pfm_default_value="";
}

$acx_pfm = str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);
if($acx_pfm != "")
{
	$acx_pfm = str_replace("action=edit&ID","acurax",$acx_pfm);
}?>
		<form name="acx_pfm_form_edit" method="post" action="<?php echo $acx_pfm;?>">
	<table>
	<tr><td>
		<?php echo "<h4>" . __( 'Edit Fields', 'acx_pfm_config' ) . "</h4>"; ?></td></tr>
	<tr><td>
	<input type="hidden" name="acx_pfm_form_edit_hidden" value="Y"></td></tr>
	<tr><td><p><?php _e("Label:");?></td><td><input type="text" name="acx_pfm_label_edit" id="acx_pfm_label_edit" value="<?php echo $acx_pfm_label; ?>" size="22">
	</td></tr>
	<tr><td><p><?php _e("Description:");?></td><td><input type="text" name="acx_pfm_desc_edit" id="acx_pfm_desc_edit" value="<?php echo $acx_pfm_desc; ?>" size="22">
	</td></tr>
	<tr><td><p><?php _e("Field Type:");?></td><td>
	<input type="text" name="acx_pfm_field_type_edit" readonly value="<?php
	if($acx_pfm_type == "text"){
		echo "text";
	}
	else if($acx_pfm_type == "textarea"){
		echo "textarea";
	}
	else if($acx_pfm_type == "image")
	{
		echo "image";
		
	}?>"/>
	</td></tr>
	<tr><td><p><?php _e("Default value:");?></td>
	<?php  if($acx_pfm_type == "text" || $acx_pfm_type == "textarea"){?>
	<td><input type="text" name="acx_pfm_default_text_edit" id="acx_pfm_default_text_edit" value="<?php echo $acx_pfm_default_value; ?>" size="22">
	</td>
	<?php  }
	else if($acx_pfm_type == "image"){?>
	<input type="hidden" name="acx_pfm_image_edit" id="acx_pfm_image_edit" value="<?php if ( isset ( $acx_pfm_default_value ) ){ echo esc_url($acx_pfm_default_value);} ?>" />
	<td><a id="acx_pfm_image_button_edit" class="button">Upload Image</a></td>
	<td><img id="acx_pfm_image_field_edit" src="<?php if ( isset ( $acx_pfm_default_value ) ){ echo esc_url($acx_pfm_default_value);} ?>" style="width:100px;height:auto;">
	</td><?php }?>
	</tr>
	</table>
	<table>
	<tr><td>
	<input type="hidden" name="acx_pfm_edit_id" value="<?php echo $edit_id; ?>"/>
	<input type="submit" name="Submit" value="<?php _e('UPDATE', 'acx_pfm_config');?>">
	</p></tr>
	</table>
	</form>
	<?php }
	$acx_pfm = str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);
	if($acx_pfm != "")
	{
		$acx_pfm = str_replace("action=edit&ID","acurax",$acx_pfm);
	}?>
<form name="acx_pfm_option_form" method="post" action="<?php echo $acx_pfm;?>">
<p>		
<?php _e(" Current Fields: " );?>
<p>
<?php acx_pfm_render_list_page();?>
</p>
</form>
</div>
<script type="text/javascript">
jQuery(document).ready(function() 
{
	acx_pfm_show_meta_image("acx_pfm_image_button","Choose Image","Choose Image","acx_pfm_image","acx_pfm_image_field");
	acx_pfm_show_meta_image("acx_pfm_image_button_edit","Choose Image"," Choose Image","acx_pfm_image_edit","acx_pfm_image_field_edit");
});
function acx_pfm_default_value()
{
	var val= document.getElementById("acx_pfm_field_type").value;
	if(val == "text" || val == "textarea")
	{
		jQuery('#acx_pfm_text_default').fadeIn('fast');
		jQuery('#acx_pfm_img_default').fadeOut('fast');
	}
	else if(val == "image")
	{
		jQuery('#acx_pfm_img_default').fadeIn('fast');
		jQuery('#acx_pfm_text_default').fadeOut('fast');
	}
	else{
		jQuery('#acx_pfm_text_default').fadeOut('fast');
		jQuery('#acx_pfm_img_default').fadeOut('fast');
	}
}
function acx_pfm_validate_fields()
{
	var acx_label=document.getElementById("acx_pfm_label").value;
	var acx_type=document.getElementById("acx_pfm_field_type").value;
	var acx_pfm_valid=true;
	if(acx_label=="")
	{
		alert("please enter a label");
		acx_pfm_valid=false;
	}
	else if(acx_type=="")
	{
		alert("please Select a type");
		acx_pfm_valid=false;
	}
	return acx_pfm_valid;
}
</script>