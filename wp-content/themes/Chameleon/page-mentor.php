<?php

/* Template Name: Page-Mentor */

get_header(); ?>
 <script type="text/javascript">

 
	    function applyBut(butObj)
	      {
	      
		    if (confirm('Are you sure you want to apply for ' + butObj.getAttribute("value") + ' as your mentor?' ) )
		    {
		      values= [];
		      values[0] = "Mentor"
		      values[1] = butObj.getAttribute("value");
		      sendToPhp();
		     }
	      };
	      
	      function sendToPhp()
	      {
		$.post("<?php echo get_bloginfo('url'); ?>/ajax/", { emailType: values[0], emailTypeName: values[1] });
		openSendingMailWindow();
	      };
	      
	      function openSendingMailWindow() {
		sendingMailWindow = window.open('<?php echo get_bloginfo('url'); ?>/?p=77/',
		'open_window',
		'menubar, toolbar, location, directories, status, scrollbars, resizable, dependent, width=640, height=480, left=0, top=0')
		}
	      
  </script> 
  <?php

    $found_mentor = false;

    global $pods;
    $mentor_slug  = pods_url_variable(-1);
    $mentor       = new Pod('mentor', $mentor_slug);

    if( !empty( $mentor->data ) )
    {
      $found_mentor = true;

      // set our variables

              $mentor_name      = $mentor->get_field('name');
              $mentor_role  	= $mentor->get_field('role');
              $mentor_location = $mentor->get_field('location');
              $mentor_slug      = $mentor->get_field('detail_url');
	      $mentor_pic 	= $mentor->get_field('picture');
	      $mentor_sector 	= $mentor->get_field('sector');
	      $mentor_description = $mentor->get_field('description');
	      $mentor_closingDate =$mentor->get_field('closingdate');
	      
	      //data cleanup
	      $mentor_pic      = $mentor_pic[0]['guid'];
    }
  ?>
 <?php 
	  get_template_part('includes/breadcrumbs'); ?>
      
      <div id="category-name">
	<div id="category-inner">
		<h1 class="category-title"><?php echo wp_kses( $mentor_name, array( 'span' => array() ) ); ?></h1>
	</div> <!-- end #category-inner -->
      </div> <!-- end #category-name -->
      
  
<div id="content" class="clearfix" role="main">
	<div id="left-area">
    <?php if( $found_mentor ) : ?>

      <div class="entry post clearfix">
        <div class="entry">
	  <div id="mentor-pic">
		  
		  <?php if( !empty( $mentor_pic ) ) : ?>
		    <img src="<?php echo $mentor_pic; ?>" style="width:150px;" alt="Photo of <?php echo $mentor_name; ?>" />
		  <?php endif ?>
           </div>
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
				  <td>
				    <?php echo $mentor_role; ?>
				    </td>
				  </tr>
				  <tr>
				    <td>
				      <?php 
				      echo  $mentor_location[0]['name'];
					//echo $mentor_location; ?>
				      </td>
				    </tr>
				    <tr>
				      <td>
					<?php 
					for ($i=0; $i< sizeof($mentor_sector); $i++)
					{
					  echo  $mentor_sector[$i]['name']. "<br />";
					  }
					  
					    ?>
					  </td>
					</tr>			  		 
				      </tbody>
				    </table>
				    
				    <table id="tb_mentorDescription">
				      <thead>
					<tr>
					  <th>About <?php echo $mentor_name; ?> </th>
					</tr>
				      </thead>
				      <tbody>
					<tr>
					  <td>
					     <?php echo $mentor_description; ?>
					  </td>
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
					  <td>
					    <?php echo $mentor_closingDate; ?>
					    </td>
					  </tr>
					</tbody>
				      </table>
        </div>
	<a href="#" value="<?php echo $mentor_name?>" onclick="applyBut(this);" id="apply_but" class="icon-button paper-icon"><span class="et-icon"><span>Apply</span></span></a>
      </div>

    <?php else: ?>
	
      <div class="post">
	    <h2>Team mentor Not Found</h2>
	    <div class="entry">
	      <p>Sorry, that Team mentor could not be found!</p>
	    </div>
	  </div>
	
    <?php endif ?>
  
    </div> <!-- end of left area-->

<?php get_sidebar(); ?>
</div> <!-- end of content-->
<?php get_footer(); ?>