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