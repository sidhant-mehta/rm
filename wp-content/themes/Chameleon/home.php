<?php get_header(); ?>

<?php if ( get_option('chameleon_featured') == 'on' ) get_template_part('includes/featured'); ?>		

<?php if ( get_option('chameleon_quote') == 'on' ) { ?>
	<div id="category-name"> 
		<div id="category-inner"> 
		<?php if ( get_option('chameleon_quote_one') <> '' ) { ?>
			<h3>"<?php echo esc_html(get_option('chameleon_quote_one')); ?>"</h3>
		<?php } ?>
		<?php if ( get_option('chameleon_quote_two') <> '' ) { ?>
			<p><?php echo esc_html(get_option('chameleon_quote_two')); ?></p>
		<?php } ?>	
        </div>
	</div> <!-- end .category-name -->
<?php } ?>

<div id="content-area">
      
	<?php if ( get_option('chameleon_blog_style') == 'false' ) { ?>
	
	
		<?php if ( get_option('chameleon_display_blurbs') == 'on' ){ ?>
			<div id="services" class="clearfix">
				<?php for ($i=1; $i <= 3; $i++) { ?>
					<?php query_posts('page_id=' . get_pageId(html_entity_decode(get_option('chameleon_home_page_'.$i)))); while (have_posts()) : the_post(); ?>
						<?php 
							global $more; $more = 0;
						?>
						<div class="service<?php if ( $i == 3 ) echo ' last'; ?>">
							<h3 class="title"><?php the_title(); ?></h3>
							
							<?php
								$thumb = '';
								$width = 232;
								$height = 117;
								if ( 'on' == get_option('chameleon_responsive_layout') ){
									$width = 376;
									$height = 160;
								}
								$classtext = 'item-image';
								$titletext = get_the_title();
								$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'etservice');
								$thumb = $thumbnail["thumb"];
								$et_service_link = get_post_meta($post->ID,'etlink',true) ? get_post_meta($post->ID,'etlink',true) : get_permalink();
							?>
							<?php if ( $thumb <> '' ) { ?>
								<div class="thumb">
									<a href="<?php echo $et_service_link; ?>">
										<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
										<span class="more-icon"></span>
									</a>
								</div> <!-- end .thumb -->
							<?php } ?>
							
							<?php the_content(''); ?>
						</div> <!-- end .service -->
					<?php endwhile; wp_reset_query(); ?>
				<?php } ?>
			</div> <!-- end #services -->
		<?php } ?>
		
		<div id="from-blog">			
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage') ) : ?> 
			<?php endif; ?>
		</div> <!-- end #from-blog -->
	
	<!-- MENTOR MEDIA SLIDER START-->
		<?php if ( get_option('chameleon_display_media') == 'on' ) { ?>
			<div id="multi-media-bar" style="float:left;">
				<h3 class="title">Meet our mentors</h3>
				<div id="et-multi-media" class="clearfix">
					<a id="left-multi-media" href="#"><?php esc_html_e('Previous','Chameleon'); ?></a>
					<a id="right-multi-media" href="#"<?php esc_html_e('Next','Chameleon'); ?>></a>
					<div id="media-slides">
						<?php 
							$args=array(
								'showposts' => (int) get_option('chameleon_posts_media'),
								'category__not_in' => (array) get_option('chameleon_exlcats_media')
							);
							query_posts($args);
							$media_current_post = 1;
							$media_open = false;
							$et_videos_output = '';
						?>
						
						
						<!-- The search will be of the pods Mentor DB. 
						give the variables below the results from the search. 
						title: mentor name
						thumbnail: the url. or below change the code line 118 to take just the url. then have css change the dimensions. !-->
						<?php
						$mentorPod = new Pod('mentor');
						$mentorPod -> findRecords('name ASC');
						$total_mentors = $mentorPod -> getTotalRows();
						?>
						<?php if ($total_mentors > 0) : ?>
						
						<?php while ($mentorPod->fetchRecord() ) : ?>
						  <?php
						      $mentorName = $mentorPod->get_field('name');
						      $mentorPicURL = $mentorPod->get_field('picture');
						      $mentorOrganisation = $mentorPod -> get_field('organisation');
						      
						      //data cleanup
						      $mentorPicURL = $mentorPicURL[0]['guid'];
						      

						  ?> 			
													
							<?php if ( $media_current_post == 1 || ($media_current_post - 1) % 4 == 0 ) { 
								$media_open = true; ?>
								<div class="media-slide">
							<?php } ?>
							<div class="thumb">
																												<a href="<?php echo $mentorPicURL; ?>" rel="media" class="fancybox" 
								    title="<?php echo $mentorName; ?>">
																												<img src="<?php echo $mentorPicURL; ?>" class="multi-media-image" alt="Mentor 1"  style="opacity: 1; ">					
																												<span class="more" style="opacity: 0; display: inline; "></span>
											</a>
										<div class="media-description" style="display: block; opacity: 0; bottom: 63px; ">
											<p><?php echo "<b>".$mentorName ."</b><br />".$mentorOrganisation; ?></p>
											<span class="media-arrow"></span>
										</div>
									</div>
									 	<!-- end .thumb -->
							<?php if ( $media_current_post % 4== 0 ) { 
								$media_open = false; ?>
								</div> <!-- end .media-slide -->
							<?php } ?>

							<?php $media_current_post++;?>
						    <?php endwhile ?>
						  <?php endif ?>
						
						<?php if ( $media_open ) { ?>
							</div> <!-- end .media-slide -->
						<?php } ?>
					</div> <!-- end #media-slides -->
				</div> <!-- end #et-multi-media -->
			</div> <!-- end #multi-media-bar -->
			
			
			
			<?php if ( '' != $et_videos_output ) echo '<div class="et_embedded_videos">' . $et_videos_output . '</div>'; ?>
		<?php } ?>
		
	
	<!-- MENTOR MEDIA SLIDER END-->
	
		
			
		<div class="clear"></div>
		
	<?php } else { ?>
		<div id="left-area">
			<?php get_template_part('includes/entry','home'); ?>
		</div> 	<!-- end #left-area -->

		<?php get_sidebar(); ?>
		<div class="clear"></div>
	<?php } ?>
	
</div> <!-- end #content-area -->

<?php get_footer(); ?>