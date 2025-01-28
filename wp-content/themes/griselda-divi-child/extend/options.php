<?php 

/*
* Theme Options Tab
* Extra Theme Tabs Options
* Preloader
*/


/* Theme Options Tab */
function dc_epanel_tabs(){
	dc_epanel_fields(); ?>
	<li><a href="#wrap-dc"><?php echo ' DC Theme Options'; ?></a></li>
	<?php
}
add_action("epanel_render_maintabs", 'dc_epanel_tabs');

/* Theme Options Fields */
function dc_epanel_fields(){
  global $epanelMainTabs, $themename, $shortname, $options ;
		$options[] = array(
			"name" => "wrap-dc",
			"type" => "contenttab-wrapstart",);
		$options[] = array(
			"type" => "subnavtab-start",);
		$options[] = array(
			"name" => "dc-1",
			"type" => "subnav-tab",
			"desc" => esc_html__("Style Settings", $themename)
		);
		$options[] = array(
			"name" => "dc-2",
			"type" => "subnav-tab",
			"desc" => esc_html__("Preloader", $themename)
		);
		$options[] = array(
			"type" => "subnavtab-end",);	
		$options[] = array(
			"name" => "dc-1",
			"type" => "subcontent-start",);
		$options[] = array( 
			"name" =>esc_html__( 'Theme Color Options', $themename ),
			"id" => $shortname . "_dc_show_color_option",
			"type" => "checkbox2",
			"std" => "off",
			"desc" =>esc_html__( "Define the default color palette for color pickers in the Divi Builder.", $themename ),
		);
		$options[] = array( "name"         => esc_html__( "Custom Base Color", $themename ),
			"id"           => $shortname . "_dc_color_palette_01",
			"type"         => "et_color_palette",
			"items_amount" => 1,
			"std"          => '#8373E3',
			"desc"         => esc_html__( "Define the custom base color palette for color pickers in the Divi Builder.", $themename ),
		);
		$options[] = array( "name"         => esc_html__( "Secondary Color", $themename ),
			"id"           => $shortname . "_dc_color_palette_02",
			"type"         => "et_color_palette",
			"items_amount" => 1,
			"std"          => '#05011C',
			"desc"         => esc_html__( "Define the secondary color palette for color pickers in the Divi Builder.", $themename ),
		);
		$options[] = array( "name"         => esc_html__( "Custom Body Color", $themename ),
			"id"           => $shortname . "_dc_color_palette_03",
			"type"         => "et_color_palette",
			"items_amount" => 1,
			"std"          => '#FFFFFF',
			"desc"         => esc_html__( "Define the custom body color palette for color pickers in the Divi Builder.", $themename ),
		);
		$options[] = array(
			"name" => "dc-1",
			"type" => "subcontent-end",);				
		$options[] = array(
			"name" => "dc-2",
			"type" => "subcontent-start",);
		$options[] = array(
			'name' => esc_html__('Enable Preloader', $themename),
			'id' => $shortname . "_dc_preloader_option",
			'desc' => esc_html__('Prealoder ENABLE/DISABLE',$themename),
			'std' => 'on',
			"type" => "checkbox"
		);
		$options[] = array("name" => "dc-2",
			"type" => "subcontent-end",);	
		$options[] = array( 
			"name" => "wrap-dc",
			"type" => "contenttab-wrapend",);
}
add_action("et_epanel_changing_options", 'dc_epanel_fields');

function dc_custom_color_option_css(){ 
	if( et_get_option('divi_dc_show_color_option') != '' ){
		$divi_dc_show_color_option = et_get_option('divi_dc_show_color_option');
	}else{
		$divi_dc_show_color_option = 'off';
	}
	if( $divi_dc_show_color_option == 'on' ){
		?>
		<style type="text/css">
			:root {
				--color1: <?php echo esc_html(et_get_option( 'divi_dc_color_palette_01' )); ?> !important;
				--color2: <?php echo esc_html(et_get_option( 'divi_dc_color_palette_02' )); ?> !important;
				--color3: <?php echo esc_html(et_get_option( 'divi_dc_color_palette_03' )); ?> !important;
			}
		</style>
		<?php
	}
}
add_action('wp_footer' , 'dc_custom_color_option_css');



/* Adding Preloader Options Code Here */
function dc_custom_preloader_option_css(){ 
	if( et_get_option('divi_dc_preloader_option') != '' ){
		$divi_dc_preloader_option = et_get_option('divi_dc_preloader_option');
	}else{
		$divi_dc_preloader_option = 'on';
	}
	if( $divi_dc_preloader_option == 'on' ){	
	?>
<style type="text/css">
/* Preloader */
.preloader{position:fixed;top:0;left:0;right:0;bottom:0; z-index:100000;height:100%;width:100%;overflow:hidden !important;z-index:9999999999999999;background-color:var(--color1);}
.preloader .status{width:100px;height:100px;position:absolute;left:50%;top:50%;background-repeat:no-repeat;background-position:center;-webkit-background-size:cover;background-size:cover;margin:-50px 0 0 -50px;}

.loader{
    width: 50px;
    height: 50px;
    margin: 50px auto 0; 
    position: relative; 
} 
.loader .inner_loader{
    background: #fff;
    width: 10%;
    height: 50%;
    border-radius: 50%;
    transform-origin: center 150%;
    transform: translateX(-50%);
    position: absolute;
    top: -15%;
    left: 50%;
    animation: 1s showToggle infinite linear;
}
.loader .inner_loader:nth-of-type(1){
    transform: rotate(18deg);
    animation-delay: 0.05s;
}
.loader .inner_loader:nth-of-type(2){
    transform: rotate(36deg);
    animation-delay: 0.1s;
}
.loader .inner_loader:nth-of-type(3){
    transform: rotate(54deg);
    animation-delay: 0.15s;
}
.loader .inner_loader:nth-of-type(4){
    transform: rotate(72deg);
    animation-delay: 0.2s;
}
.loader .inner_loader:nth-of-type(5){
    transform:  rotate(90deg);
    animation-delay: 0.25s;
}
.loader .inner_loader:nth-of-type(6){
    transform: rotate(108deg);
    animation-delay: 0.3s;
}
.loader .inner_loader:nth-of-type(7){
    transform: rotate(126deg);
    animation-delay: 0.35s;
}
.loader .inner_loader:nth-of-type(8){
    transform: rotate(144deg);
    animation-delay: 0.4s;
}
.loader .inner_loader:nth-of-type(9){
    transform: rotate(162deg);
    animation-delay: 0.45s;
}
.loader .inner_loader:nth-of-type(10){
    transform: rotate(180deg);
    animation-delay: 0.5s;
}
.loader .inner_loader:nth-of-type(11){
    transform: rotate(198deg);
    animation-delay: 0.55s;
}
.loader .inner_loader:nth-of-type(12){
    transform: rotate(216deg);
    animation-delay: 0.6s;
}
.loader .inner_loader:nth-of-type(13){
    transform: rotate(234deg);
    animation-delay: 0.65s;
}
.loader .inner_loader:nth-of-type(14){
    transform: rotate(252deg);
    animation-delay: 0.7s;
}
.loader .inner_loader:nth-of-type(15){
    transform: rotate(270deg);
    animation-delay: 0.75s;
}
.loader .inner_loader:nth-of-type(16){
    transform: rotate(288deg);
    animation-delay: 0.8s;
}
.loader .inner_loader:nth-of-type(17){
    transform: rotate(306deg);
    animation-delay: 0.85s;
}
.loader .inner_loader:nth-of-type(18){
    transform: rotate(324deg);
    animation-delay: 0.9s;
}
.loader .inner_loader:nth-of-type(19){
    transform: rotate(342deg);
    animation-delay: 0.95s;
}
.loader .inner_loader:nth-of-type(20){
    transform: rotate(360deg);
    animation-delay: 1s;
}
@keyframes showToggle{
    from{ opacity: 1; }
    to {  opacity: 0; }
}
		</style>
<?php
	}
}
add_action('wp_head' , 'dc_custom_preloader_option_css');

/* Adding Preloader Options Section */
function dc_preloader_option_section(){ 
	if( et_get_option('divi_dc_preloader_option') != '' ){
		$divi_dc_preloader_option = et_get_option('divi_dc_preloader_option');
	}else{
		$divi_dc_preloader_option = 'on';
	}
	$is_et_fb_enabled = function_exists( 'et_core_is_fb_enabled' ) && et_core_is_fb_enabled();
	if( $divi_dc_preloader_option == 'on' && !$is_et_fb_enabled){
	?>		
		<!-- Preloader -->
		<div class="preloader">
		  <div class="status">
				<div class="loader">
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
    <div class="inner_loader"></div>
</div>
		  </div>
		</div>		
		<?php 
	}
}
add_action('wp_body_open' , 'dc_preloader_option_section');

/* Adding Preloader Active jQuery */
function dc_preloader_js(){ 
	if( et_get_option('divi_dc_preloader_option') != '' ){
		$divi_dc_preloader_option = et_get_option('divi_dc_preloader_option');
	}else{
		$divi_dc_preloader_option = 'on';
	}
	if( $divi_dc_preloader_option == 'on' ){
?>
<script type="text/javascript">
 jQuery(window).load(function() { 
	jQuery('.status').fadeOut('fast');
	jQuery('.preloader').delay(350).fadeOut('slow');
	jQuery('body').delay(550).css({'overflow':'visible'});
})
</script>
<?php
	}
}
add_action('wp_footer' , 'dc_preloader_js');

/* Save Preloader Theme Options */
function et_dc_library_layouts() {
	$libs = array();
	$args = array('post_type' => 'et_pb_layout', 'posts_per_page' => -1);
    $alllibrarys = get_posts($args);
    $all_ids = wp_list_pluck( $alllibrarys , 'post_title','post_title' );
	if(!empty($all_ids)){
	$libs += [null => 'None'];	
	foreach($all_ids as $key=>$val){
		$libs += [$key => esc_html__( $val, 'et_builder' )];
	}
	}else{
		$libs += [null => 'Sorry, Divi Library is empty. Create some layouts...'];
	}
	return $libs;    	
}
