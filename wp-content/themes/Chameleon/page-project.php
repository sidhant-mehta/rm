<?php

/* Template Name: Page-Project */

get_header(); ?>
 <script type="text/javascript">

 
	     	      function applyBut(butObj)
	      {
	      
		    if (confirm('Are you sure you want to apply for ' + butObj.getAttribute("value") + ' as your project?' ) )
		    {
		      values= [];
		      values[0] = "Project"
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

    $found_project = false;

    global $pods;
    $project_slug  = pods_url_variable(-1);
    $project       = new Pod('project', $project_slug);

    if( !empty( $project->data ) )
    {
      $found_project = true;

      // set our variables
	     $id =		$project->get_field('id');
              $project_name      = $project->get_field('name');
              $project_leader  	= $project->get_field('projectleader');
              $project_slug      = $project->get_field('detail_url');
	       $project_organisation = $project->get_field('organisation');
	      $project_location = $project->get_field('location');
	      $project_pic 	= $project->get_field('picture');
	      $project_sector 	= $project->get_field('sector');
	      $project_closingDate =$project->get_field('closingdate');
	      $project_description = $project->get_field('description');
	      
	      //data cleanup
	      $project_pic      = $project_pic[0]['guid'];
    }
  ?>
 <?php 
	  get_template_part('includes/breadcrumbs'); ?>
      
      <div id="category-name">
	<div id="category-inner">
		<h1 class="category-title"><?php echo wp_kses( $project_name, array( 'span' => array() ) ); ?></h1>
	</div> <!-- end #category-inner -->
      </div> <!-- end #category-name -->
      
  
<div id="content" class="clearfix" role="main">
	<div id="left-area">
    <?php if( $found_project ) : ?>

      <div class="entry post clearfix">
        <div class="entry">
	  <div id="project-pic">
		  
		  <?php if( !empty( $project_pic ) ) : ?>
		    <img src="<?php echo $project_pic; ?>" style="width:150px;" alt="Photo of <?php echo $project_name; ?>" />
		  <?php endif ?>
           </div>
         <table>
			      <thead>
				<tr>
				  <th>Project Leader</th>
				  <th>Organisation</th>
				  <th>Location</th>
				  <th>Sector(s)</th>
				</tr>
			      </thead>
			      <tbody>
				<tr>
				  <td>
				    <?php echo $project_leader; ?>
				    </td>
				  </tr>
				  <tr>
				  <td>
				    <?php echo $project_organisation; ?>
				    </td>
				  </tr>
				  <tr>
				    <td>
				      <?php 
				      echo  $project_location[0]['name'];
					//echo $project_location; ?>
				      </td>
				    </tr>
				    <tr>
				      <td>
					<?php 
					for ($i=0; $i< sizeof($project_sector); $i++)
					{
					  echo  $project_sector[$i]['name']. "<br />";
					  }
					  
					    ?>
					  </td>
					</tr>			  		 
				      </tbody>
				    </table>
				    
				    <table id="tb_projectDescription">
				      <thead>
					<tr>
					  <th>About <?php echo $project_name; ?> </th>
					</tr>
				      </thead>
				      <tbody>
					<tr>
					  <td>
					     <?php echo $project_description; ?>
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
					    <?php echo $project_closingDate; ?>
					    </td>
					  </tr>
					</tbody>
				      </table>
        </div>
	<a href="#" data-id="<?php echo $id;?>" value="<?php echo $project_name?>" onclick="applyBut(this);" id="apply_but" class="icon-button paper-icon"><span class="et-icon"><span>Apply</span></span></a>
      </div>

    <?php else: ?>
	
      <div class="post">
	    <h2>project Not Found</h2>
	    <div class="entry">
	      <p>Sorry, that project could not be found!</p>
	    </div>
	  </div>
	
    <?php endif ?>
  
    </div> <!-- end of left area-->

<?php get_sidebar(); ?>
</div> <!-- end of content-->
<?php get_footer(); ?>