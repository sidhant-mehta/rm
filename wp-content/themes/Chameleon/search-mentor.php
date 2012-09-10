<?php

/* Template Name: search-mentor */

 get_header(); ?>
      <?php 
	  get_template_part('includes/breadcrumbs'); ?>
      
      <div id="category-name">
	<div id="category-inner">
		<h1 class="category-title"><?php echo wp_kses( "Find A Mentor", array( 'span' => array() ) ); ?></h1>
	</div> <!-- end #category-inner -->
      </div> <!-- end #category-name -->


<script type="text/javascript">
	function applyBut()
	{
		alert("<?php echo doChecks(); ?>");
	}
</script>      
<div id="content" class="clearfix">
	<div id="left-area">

<p>Here can be some information on how to use the search function, just like a smalll intraduction </p>

<div id="all_mentors">
	  
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
              $mentor_role  	= $mentor->get_field('role');
              $mentor_location = $mentor->get_field('location');
              $mentor_slug      = $mentor->get_field('detail_url');
	      $mentor_pic 	= $mentor->get_field('picture');
	      $mentor_sector 	= $mentor->get_field('sector');
	      
	      //data cleanup
	      $mentor_pic      = $mentor_pic[0]['guid'];
	     
	     ?>
          <div id="mentor">
	    <div id="mentor-details">
		
		    <a id="mentor-link" href="<?php echo get_permalink(); ?><?php echo $mentor_slug; ?>">
			<span id="mentor-name"> <?php echo $mentor_name; ?> </span>
		    </a>
		    <br />
		   
		   
		   <table>
			<thead>
			  <tr>
			    <th>Role</th>
			    <th>Location</th>
			    <th>Sector(s)</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
			    <td><?php echo $mentor_role; ?></td>
			  </tr>
			  <tr>
			    <td><?php echo $mentor_location; ?></td>
			  </tr>
			  <tr>
			    <td><?php echo $mentor_sector; ?></td>
			  </tr>
			  
			</tbody>
		    </table>
			
		 
		
	    </div>
           <div id="mentor-pic">
		  
		  <?php if( !empty( $mentor_pic ) ) : ?>
		    <img src="<?php echo $mentor_pic; ?>" style="width:150px;" alt="Photo of <?php echo $mentor_name; ?>" />
		  <?php endif ?>
           </div>
           
           <a href="#" onclick="applyBut();" id="apply_but" class="icon-button paper-icon"><span class="et-icon"><span>Apply</span></span></a>
           
           </div>
    
    <!-- /mentor -->
            
          <?php endwhile ?>
        <?php endif ?>
</div>
        </div>
    </div>
        
<?php get_footer(); ?>