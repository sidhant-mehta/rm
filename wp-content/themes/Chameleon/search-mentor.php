<?php

/* Template Name: search-mentor */

 get_header(); 
 ?>
 
 <script type="text/javascript">
 	      function applyBut(butObj)
	      {
	      
		    if (confirm('Are you sure you want to apply for ' + butObj.getAttribute("value") + ' as your project?' ) )
		    {
		      values= [];
		      values[0] = "Mentor"
		      values[1] = butObj.getAttribute("value");
		      values[2] = butObj.getAttribute("data-id");
		      sendToPhp();
		     }
	      };
	      
	      function sendToPhp()
	      {
		$.post("<?php echo get_bloginfo('url'); ?>/ajax/", { emailType: values[0], emailTypeName: values[1], emailTypeID: values[2] });
		openSendingMailWindow();
	      };
	      
	      function openSendingMailWindow() {
		sendingMailWindow = window.open('<?php echo get_bloginfo('url'); ?>/?p=77/',
		'open_window',
		'menubar, toolbar, location, directories, status, scrollbars, resizable, dependent, width=640, height=480, left=0, top=0')
		}
 
 </script>       
      <?php 
	  get_template_part('includes/breadcrumbs'); ?>
      
      <div id="category-name">
	<div id="category-inner">
		<h1 class="category-title"><?php echo wp_kses( "Find A Mentor", array( 'span' => array() ) ); ?></h1>
	</div> <!-- end #category-inner -->
      </div> <!-- end #category-name -->


    
<div id="content" class="clearfix">
	<div id="left-area">

<p id="intro">Please use our search facility below to find a project that meets your requirements.</p>

<div id="all_mentors">
	  
        <?php
          $mentor = new Pod('mentor');
          $mentor->findRecords('name ASC');       
          $total_mentors = $mentor->getTotalRows();
	  ?>

      <div id="et-search">
	<div id="et-search-inner" class="clearfix">
	<p style="margin-bottom: 0;" id="et-search-title"><span><?php esc_html_e('search for a mentor','Chameleon'); ?></span></p>
	  <?php echo $mentor->getFilters('sector, location', 'Search'); ?>
	</div>
    </div>
	  
 
       
      
        <?php if( $total_mentors>0 ) : ?>
          <?php while ( $mentor->fetchRecord() ) : ?>
            
            <?php
              // set our variables
	      $id =		$mentor->get_field('id');
              $mentor_name      = $mentor->get_field('name');
              $mentor_role  	= $mentor->get_field('role');
              $mentor_location = $mentor->get_field('location');
              $mentor_slug      = $mentor->get_field('detail_url');
	      $mentor_pic 	= $mentor->get_field('picture');
	      $mentor_sector 	= $mentor->get_field('sector');
	      $mentor_closingDate =$mentor->get_field('closingdate');
	      
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
			    <td><?php 
			    echo  $mentor_location[0]['name'];
			    //echo $mentor_location; ?></td>
			  </tr>
			  <tr>
			    <td><?php 
				for ($i=0; $i< sizeof($mentor_sector); $i++)
				{
				 echo  $mentor_sector[$i]['name']. "<br />";
				}
				
				?></td>
			  </tr>			  
			</tbody>
		    </table>
		    
		    <table id="tb_closingDate">
		      <thead>
			<tr>
			  <th>Closing Date</th>
			</tr>
		      </thead>
		      
		      <tbody>
			<tr>
			      <td> <?php echo $mentor_closingDate; ?> </td>
			</tr>
		      </tbody>
		    </table>  
		 
		
	    </div>
           <div id="mentor-pic">
		  
		  <?php if( !empty( $mentor_pic ) ) : ?>
		    <img src="<?php echo $mentor_pic; ?>" style="width:150px;" alt="Photo of <?php echo $mentor_name; ?>" />
		  <?php endif ?>
           </div>
           
           <a href="#" data-id="<?php echo $id;?>" value="<?php echo $mentor_name?>" onclick="applyBut(this);" id="apply_but" class="icon-button paper-icon"><span class="et-icon"><span>Apply</span></span></a>
           
           </div>
           
    
    <!-- /mentor -->
            
          <?php endwhile ?>
        <?php endif ?>
        
</div>
        </div>
    </div>
        
<?php get_footer(); ?>