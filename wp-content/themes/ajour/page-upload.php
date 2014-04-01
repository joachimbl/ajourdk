<?php define("QUICK_CACHE_ALLOWED", false);  ?>
<?php
	
	$target_path = dirname(__FILE__) . "/uploads/";
	
	if($_POST){
		
		$allowed_extensions = array("jpg", "jpeg", "png");	
		$extension = end(explode(".", strtolower($_FILES['ulfile']['name'])));
		$target = $target_path . base64_encode($_POST['ulname']) . "." . $extension;
		$filesize = filesize($_FILES['ulfile']['tmp_name']);
		$maxsize = 3000000; // bytes
		$minsize = 20000; // bytes
		
		if (!in_array($extension, $allowed_extensions)) {
			$msg = 'OBS: Ugyldig filtype!';
		}
		elseif($_POST['ulname'] == 'Virksomhed …' OR empty($_POST['ulname'])){
			$msg = 'OBS: Angiv din virksomheds navn!';
		}
		elseif($filesize < $minsize){
			$msg = 'OBS: Filen er for lille!';
		}
		elseif($filesize > $maxsize){
			$msg = 'OBS: Filen er for stor!';
		}
		elseif(move_uploaded_file($_FILES['ulfile']['tmp_name'], $target)) {
			$msg = 'Dit billed blev uploadet!';
		}
		else{
			$msg = 'Beklager! Der opstod en fejl.';
		}
	}
	elseif($_GET['delete']){
		
		$file = $target_path . $_GET['delete'];
		if(file_exists($file)){
			if(unlink($file)){
				$msg = 'Billedet blev slettet!';
			}
		}
	}

?>


<?php get_header(); ?>

<style type="text/css">
	#ulform{
		margin: 0 auto;
		padding:30px 50px 0 50px;
		box-sizing: border-box;
	}
	
	#ulfile_container,
	.field{
		background: #ddd;
		color: #777;
		line-height: 40px;
		height: 40px;
		padding: 0 20px;
		text-shadow: 0 1px 0 rgba(255, 255, 255, .4);
		box-shadow: inset 0 4px 8px rgba(0, 0, 0, .2);
		-moz-box-shadow: inset 0 4px 8px rgba(0, 0, 0, .2);
		-webkit-box-shadow: inset 0 4px 8px rgba(0, 0, 0, .2);
		overflow: hidden;
		border: none;
		outline: none;
		font-size: 15px;
		width: 100%;
		white-space:nowrap;
	}
	
	input[type="file"]{
		background: red;
		width: 490px;
		height: 40px;
		opacity: 0;
		-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
		filter: alpha(opacity=0);
		margin-left: -100px;
		display: block;
		position: absolute;
	}

	@-moz-document url-prefix() {
		input[type="submit"]{
			padding-top: 7px;
			padding-bottom: 7px;
		}
	}
	
	.status{
		line-height: 40px;
		background: #eee;
		color: #777;
		text-align: center;
	}
	
	#wrapper h2{
		padding-left:30px;
	}
	
	#note{
		color: #999;
	}
	#note strong{
		padding-left: 20px;
	}
	
	#files{
		list-style: none;
		margin: 0;
		padding: 0;
	}
	#files li{
		margin: 0;
		padding: 0 4px 0 20px;
		border: 1px solid transparent;
	}
	#files li:hover{
		border-radius: 15px;
		background: #eee;
		border: 1px solid #ccc;
		background: -webkit-linear-gradient(top, #fff, #eee);
		background: -moz-linear-gradient(top, #fff, #eee);
		box-shadow: 0 0 10px rgba(0, 0, 0, .2);
	}
	#files li:hover .delete{
		display: block;
	}
	#files li .file,
	#files li .delete{
		color: #777;
		margin: 0;
	}
	#files li .file{
		line-height: 30px;
		color: #666;
		min-width: 300px;
	}
	#files li .file:hover{
		background: none;
		box-shadow: none;
		color: #000;
	}
	#files li .delete{
		margin: 4px 0 0 0;
		line-height: 23px;
		padding: 0 10px;
		border-radius: 12px;
		font-size: 12px;
		color: #666;
		background: -webkit-linear-gradient(top, #eee, #ddd);
		background: -moz-linear-gradient(top, #eee, #ddd);
		box-shadow: inset 0 2px 4px rgba(0, 0, 0, .2), inset 0 -1px 0 rgba(255, 255, 255, 1);
		float: right;
		display: none;
	}
	#files li .delete:hover{
		color: #fff;
		background: -webkit-linear-gradient(top, #e97c7c, #c86565);
		background: -moz-linear-gradient(top, #e97c7c, #c86565);
		box-shadow: inset 0 2px 4px rgba(0, 0, 0, .2), inset 0 -1px 0 #e97c7c;
	}
</style>

<script type=""text/javascript>

	$(document).ready(function() {
		
		$('#ulfile').mouseover(function(){
			$('#note').slideDown('fast');
		});
		$('#ulfile').mouseout(function(){
			$('#note').slideUp('slow');
		});
		
		$('.status').delay(5000).slideUp(400);
		
	});
	
</script>

<h2 class="grid8 centered border-box">Upload billed til kort</h2>
<form enctype="multipart/form-data" action="" method="post" id="ulform" name="ulform" class="grid8 whitebox rounded" onsubmit="this.ulbutton.value = 'Sender ...';">
	
	<input name="ulname" id="ulname" type="text" class="field rounded display-block border-box" value="Virksomhed …" onfocus="this.value = '';" onblur="if(this.value == ''){this.value = this.defaultValue};" />
	
	<input name="ulfile" id="ulfile" type="file" class="field rounded display-block margin-top" onchange="document.getElementById('ulfile_container').innerHTML = document.ulform.ulfile.value;" />
	<div id="ulfile_container" class="rounded margin-top border-box">V&aelig;lg billed:</div>
	<div id="note" class="hidden"><strong>Min:</strong> 20 kb <strong>Max:</strong> 3 Mb <strong>Type:</strong> .jpg eller .png</div>
	<input type="submit" name="ulbutton" class="light-button margin-top margin-bottom" value="Upload billed" />
	
	<?php echo (isset($msg) ? '<p class="status rounded">' . $msg . '</p>' : null); ?>
	
	<?php 
		if( is_user_logged_in() ){
		
			echo '<ul id="files">';
			
			$search = dirname(__FILE__) . "/uploads/*";
			
			$items = glob($search);
			if($items){
				foreach(glob($search) as $item){
					
					$part = pathinfo($item);
					
					echo '<li>';
					echo '<a href="' . get_bloginfo( 'template_directory' ) . "/uploads/" . $part['basename'] . '" class="file">' . base64_decode($part['filename']) . '</a>'; 
					echo '<a href="' . "?delete=" . $part['basename'] . '" class="delete">Slet</a>';
					echo '</li>';
				}
			}
						
			echo '</ul>';
		}
	?>
	
</form>

<?php get_footer(); ?>