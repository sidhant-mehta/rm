<?php 
/*
Template Name: Login Page (Custom)
*/
?>
<?php 
global $current_user;
 $current_user = wp_get_current_user();
	$et_ptemplate_settings = array();
	$et_ptemplate_settings = maybe_unserialize( get_post_meta($post->ID,'et_ptemplate_settings',true) );
	
	$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : false;
?>

<?php get_header(); ?>
<!--
<script type="text/javascript">
window.onload = function() {
  multiSelect = document.getElementById('cimy_uef_9');
  multiSelect.onchange= countSelected(this,3);
}
var selectedOptions = [];
 function countSelected(select,maxNumber){ 
   for(var i=0; i<select.length; i++){
     if(select.options[i].selected && !new RegExp(i,'g').test(selectedOptions.toString())){
        selectedOptions.push(i); 
     }

     if(!select.options[i].selected && new RegExp(i,'g').test(selectedOptions.toString())){
      selectedOptions = selectedOptions.sort(function(a,b){return a-b});  
       for(var j=0; j<selectedOptions.length; j++){ 
         if(selectedOptions[j] == i){
            selectedOptions.splice(j,1);
         }
       } 
     }

     if(selectedOptions.length > maxNumber){
        alert('You may only choose '+maxNumber+' options!!');
        select.options[i].selected = false;
        selectedOptions.pop();
        document.body.focus();
     }  
   }    
 }
 
</script>
-->
<?php get_template_part('includes/breadcrumbs'); ?>
<div id="category-name">
	<div id="category-inner">
		<h1 class="category-title"><?php echo wp_kses( "My Profile", array( 'span' => array() ) ); ?></h1>
	</div>
</div>

<div id="content" class="clearfix<?php if($fullwidth) echo(' fullwidth');?>">
	<div id="left-area">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="entry post clearfix">							
			<?php if (get_option('chameleon_page_thumbnails') == 'on') { ?>
				<?php 
					$thumb = '';
					$width = 186;
					$height = 186;
					$classtext = 'post-thumb';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'Entry');
					$thumb = $thumbnail["thumb"];
				?>
				
				<?php if($thumb <> '') { ?>
					<div class="post-thumbnail">
						<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
						<span class="post-overlay"></span>
					</div> 	<!-- end .post-thumbnail -->
				<?php } ?>
			<?php } ?>
			
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages','Chameleon').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			
			<div id="login">
			  <?php theme_my_login( ); ?>
			</div>
			
			<div class="clear"></div>
			
			<?php edit_post_link(esc_html__('Edit this page','Chameleon')); ?>			
		</div> <!-- end .entry -->
	<?php endwhile; endif; ?>
	</div> 	<!-- end #left-area -->
	<div id="right-area">
	    <div id="profile_pic">
	   
	      <?php echo get_avatar( $current_user ); ?>
	    </div>
	    <div id="right-area-lower">
	    </div>
	</div> <!-- end right-area -->
</div> <!-- end #content -->
		
<?php get_footer(); ?>