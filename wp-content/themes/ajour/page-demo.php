<?php define("QUICK_CACHE_ALLOWED", false);  ?>
<?php get_header(); ?>

<div class="grid7 float-left margin-right notmobile">
	<?php
		// Hvis submitted
		if(isset($_POST["cf_name"])){ 
			
			// Hvis validering ok
			if($_POST["cf_validation"] == 5){
				
				// Send mail til Ajour
				$message_to_company = "Navn: " . $_POST["cf_name"] . "\n\n" . "Mobil: " . $_POST["cf_mobile"] . "\n\n" . "E-mail: " . $_POST["cf_mail"] . "\n\n" . "Adresse: \n" . $_POST["cf_address"] . "\n\n" . "Besked: \n" . $_POST["cf_message"] . "\n";
				$mail_to_company = sendmail($_POST["cf_mail"], get_field('demomail'), $_POST["cf_name"] . " via ajour.dk", $message_to_company);
				
				// Send mail til kunde
				$message_to_customer = "Hej " . $_POST["cf_name"] . "\n" . get_field('msg_to_democustomer') . "\n\n" . "Fortsat go' " . goodday() . "!\nMed venlig hilsen\nAjour";
				$mail_to_customer = sendmail(get_field('demomail'), $_POST["cf_mail"], "Kvittering: Modtaget henvendelse via ajour.dk", $message_to_customer);
				
				// Hvis sendt mail
				if($mail_to_company){
					
					// Send SMS til kunde
					$sms_to_customer = "Hej " . $_POST["cf_name"] . ",\n" . get_field('sms_to_democustomer') . "\nFortsat go' " . goodday() . "!\n- Ajour";
					$status_sms_to_customer = sendsms($_POST["cf_mobile"], $sms_to_customer);					
					
					// Vis kvittering på side
					echo "<h2>Hej " . $_POST["cf_name"] . "</h2>";
					echo "<p>Vi har modtaget din bestilling med f&oslash;lgende data:</p>";
					
					echo "<div class=\"grid6 whitebox margin-bottom\">";
					echo "<p><span>Mobil:</span> " . $_POST["cf_mobile"] . "<br /><span>E-mail:</span> " . $_POST["cf_mail"] . "</p>";
					echo "<p>" . nl2br($_POST["cf_message"]) . "</p>";
					echo "</div>";
			
					echo "<p>Med venlig hilsen<br /><em>Ajour</em></p>";
				}
			}
			else{
				echo "<h2>Spam us again, and we'll kill you!</h2>";
			}
		}
		else{
			?>
			<form method="post" action="" name="contactform">
				<label for="name" class="grid1 float-left margin-right">Navn</label><input class="grid5 rounded" type="text" name="cf_name" id="name" autofocus="autofocus" />
				<label for="mobile" class="grid1 float-left margin-right clear-left">Mobil</label><input class="grid5 rounded" type="text" name="cf_mobile" id="mobile" />
				<label for="mail" class="grid1 float-left margin-right clear-left">E-mail</label><input class="grid5 rounded" type="text" name="cf_mail" id="mail" value="<?php echo $_POST['cf_mail']; ?>" />
				<label for="validation" class="grid1 float-left margin-right clear-left" id="validationlabel">3 + 2?</label><input class="grid5 rounded" type="text" name="cf_validation" id="validation" />
				<label for="address" class="grid1 float-left margin-right clear-left">Adresse</label><textarea class="grid5 rounded" name="cf_address" id="address"></textarea>
				<label for="message" class="grid1 float-left margin-right clear-left">Besked</label><textarea class="grid5 rounded" name="cf_message" id="message"><?php echo get_field('msg_preset'); ?></textarea>
				<label id="statuslabel" class="grid1 float-left margin-right clear-left">OBS:</label><div class="grid5" id="statusmessage">&nbsp;</div>
				<label class="grid1 float-left margin-right clear-left">&nbsp;</label><input class="grid2 light-button" type="submit" name="submit" value="Send" />
			</form>
			<?php
		}
	?>
</div>
<div class="grid5 float-left">
	<?php the_post(); the_content(); ?>
</div>

<?php get_footer(); ?>