<?php

/* Template Name: Team */

get_header(); ?>

  <div id="content" class="narrowcolumn" role="main">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post" id="post-<?php the_ID(); ?>">
    <h2><?php the_title(); ?></h2>
      <div class="entry">
        
        <?php the_content(); ?>
        
        <h2>Our Team</h2>
        
        <?php
          $team = new Pod('team');
          $team->findRecords('name ASC');       
          $total_members = $team->getTotalRows();
        ?>
        
        <?php if( $total_members>0 ) : ?>
          <?php while ( $team->fetchRecord() ) : ?>
            
            <?php
              // set our variables
              $member_id        = $team->get_field('id');
              $member_name      = $team->get_field('name');
              $member_position  = $team->get_field('position');
//               $member_photo     = $team->get_field('photo');
//               $member_bio       = $team->get_field('bio');
//               $member_eom       = $team->get_field('eom');
// 
//               data cleanup
//               $member_bio       = wpautop( $member_bio );
              $member_photo     = $member_photo[0]['guid'];
            ?>
            
            <div class="member" id="member<?php echo $member_id; ?>">
              <h3><?php echo $member_name; ?></h3>
              <h4><?php echo $member_position; ?></h4>
              <?php if( !empty( $member_photo ) ) : ?>
                <img src="<?php echo $member_photo; ?>" alt="Photo of <?php echo $member_name; ?>" />
              <?php endif ?>
<!--               <?php echo $member_bio; ?> -->
            </div>
            <!-- /member -->
            
          <?php endwhile ?>
        <?php endif ?>
          
      </div>
    </div>
    <?php endwhile; endif; ?>
  
  </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>