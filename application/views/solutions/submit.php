<!doctype html>
<html>
<head>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
   <link href="/www/css/ajaxfileupload.css" rel="stylesheet" />
</head>
<body>
   <h1>Upload File</h1>
   <form method="post" action="/solutions/upload" enctype="multipart/form-data" >
      <label for="title">Title</label>
      <input type="text" name="title" id="title" value="" />
      <label for="userfile">File</label>
      <input type="file" name="solution" size="20" />
      <input type="hidden" name="competition_id" id="competition_id" value="<?= $competition_id ?>">	
      <input type="submit" name="submit" id="submit" />
   </form>
   <h2>Files</h2>
   <div id="files">
   <?php
		if (isset($solutions) && count($solutions))
		{
		   ?>
		      <ul>
		         <?php
		         foreach ($solutions as $solution)
		         {
		            ?>
		            <li class="image_wrap">
		               <strong><?php echo $solution['title']?></strong>
		        		<br/>
		               <?php echo $solution['file_name']?>	
		            	<br/>
		            	<br/>
		            	<form action="/solutions/delete" method="POST">
		            		<input type="hidden" name="solution_id" value="<?= $solution['id'] ?>" />
		            		<input type="submit" name="submit" value="Delete"> 
		            	</form>
		            </li>
		            <?php
		         }
		         ?>
		      </ul>
		   </form>
		   <?php
		}
		else
		{
		   ?>
		   <p>No Files Uploaded</p>
		   <?php
		}
	?>
   </div>
</body>
</html>