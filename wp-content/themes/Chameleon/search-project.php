<?php

/* Template Name: search-project */

 get_header(); 
 ?>
 
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
	  get_template_part('includes/breadcrumbs'); ?>
      
      <div id="category-name">
	<div id="category-inner">
		<h1 class="category-title"><?php echo wp_kses( "Find A Project", array( 'span' => array() ) ); ?></h1>
	</div> <!-- end #category-inner -->
      </div> <!-- end #category-name -->


    
<div id="content" class="clearfix">
	<div id="left-area">

<p>Here can be some information on how to use the search function, just like a smalll intraduction </p>

<div id="all_projects">
	  
        <?php
          $project = new Pod('project');
          $project->findRecords('name ASC');       
          $total_projects = $project->getTotalRows();
	  ?>

      <div id="et-search">
	<div id="et-search-inner" class="clearfix">
	<p style="margin-bottom: 0;" id="et-search-title"><span><?php esc_html_e('search for a project','Chameleon'); ?></span></p>
	  <?php echo $project->getFilters('sector, location', 'Search'); ?>
	</div>
    </div>
	  
 
       
      
        <?php if( $total_projects>0 ) : ?>
          <?php while ( $project->fetchRecord() ) : ?>
            
            <?php
              // set our variables
	      $id =		$project->get_field('id');
              $project_name      = $project->get_field('name');
              $project_leader  	= $project->get_field('projectleader');
              $project_leaderRole = $project->get_field('projectleaderrole');
              $project_slug      = $project->get_field('detail_url');
              $project_organisation = $project->get_field('organisation');

	      $project_location = $project->get_field('location');
	      $project_pic 	= $project->get_field('picture');
	      $project_sector 	= $project->get_field('sector');
	      $project_closingDate =$project->get_field('closingdate');
	      
	      //data cleanup
	      $project_pic      = $project_pic[0]['guid'];
	     
	     ?>
          <div id="project">
	    <div id="project-details">
		
		    <a id="project-link" href="<?php echo get_permalink(); ?><?php echo $project_slug; ?>">
			<span id="project-name"> <?php echo $project_name; ?> </span>
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
			    <td><?php echo $project_role; ?></td>
			  </tr>
			  <tr>
			    <td><?php 
			    echo  $project_location[0]['name'];
			    //echo $project_location; ?></td>
			  </tr>
			  <tr>
			    <td><?php 
				for ($i=0; $i< sizeof($project_sector); $i++)
				{
				 echo  $project_sector[$i]['name']. "<br />";
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
			      <td> <?php echo $project_closingDate; ?> </td>
			</tr>
		      </tbody>
		    </table>  
		 
		
	    </div>
           <div id="project-pic">
		  
		  <?php if( !empty( $project_pic ) ) : ?>
		    <img src="<?php echo $project_pic; ?>" style="width:150px;" alt="Photo of <?php echo $project_name; ?>" />
		  <?php endif ?>
           </div>
           
           <a href="#" data-id="<?php echo $id;?>" value="<?php echo $project_name?>" onclick="applyBut(this);" id="apply_but" class="icon-button paper-icon"><span class="et-icon"><span>Apply</span></span></a>
           
           </div>
           
    
    <!-- /project -->
            
          <?php endwhile ?>
        <?php endif ?>
        
</div>
        </div>
    </div>
        
<?php get_footer(); ?>