<?php

/* Template Name: Team */

 get_header(); ?>
      <?php get_template_part('includes/breadcrumbs'); ?>
      
      <div id="category-name">
	<div id="category-inner">
		<h1 class="category-title"><?php echo wp_kses( "Find A Mentor", array( 'span' => array() ) ); ?></h1>
	</div> <!-- end #category-inner -->
      </div> <!-- end #category-name -->

      
      
<div id="content" class="clearfix">
	<div id="left-area">

        <div id="search-mentor-details">
	  <p>Here can be some information on how to use the search function, just like a smalll intraduction </p>
        </div>
        
        <?php
          $mentor = new Pod('mentor');
          $mentor->findRecords('name ASC');       
          $total_mentors = $mentor->getTotalRows();
        ?>
        
        <?php if( $total_mentors>0 ) : ?>
          <?php while ( $mentor->fetchRecord() ) : ?>
            
            <?php
              // set our variables

              $mentor_name      = $mentor->get_field('name');
              $mentor_position  = $mentor->get_field('role');
              $mentor_slug      = $mentor->get_field('detail_url');

            ?>
            
           <li>
                <a href="<?php echo get_permalink(); ?><?php echo $mentor_slug; ?>">
                  <?php echo $mentor_name; ?> - <?php echo $mentor_position; ?>
                </a>
           </li>
            <!-- /mentor -->
            
          <?php endwhile ?>
        <?php endif ?>

        </div>
    </div>
        
<?php get_footer(); ?>