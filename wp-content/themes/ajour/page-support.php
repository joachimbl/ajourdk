<?php define("QUICK_CACHE_ALLOWED", false);  ?>
<?php get_header(); ?>

<div class="grid7 float-left margin-right notmobile">
	<?php
		// Hvis submitted
		if(isset($_POST["cf_name"])){ 
			
			// Hvis validering ok
			if($_POST["cf_validation"] == 5){
				
				// Vælg mail til afdeling
				switch($_POST['cf_department']){
					
					case 1: // Finans
						$company_mail = get_field('financemail');
						break;
						
					case 2: // Teknik
						$company_mail = get_field('techmail');
						break;
				}
				
				// Send mail til Ajour
				$mail_to_company = sendmail($_POST["cf_mail"], $company_mail, $_POST["cf_name"] . "(Mobil: " . $_POST["cf_mobile"] . ") via ajour.dk", $_POST["cf_message"]);
				
				// Send mail til kunde
				$message_to_customer = "Hej " . $_POST["cf_name"] . "\n" . get_field('msg_to_customer') . "\n\n" . "Fortsat go' " . goodday() . "!\nMed venlig hilsen\nAjour";
				$mail_to_customer = sendmail($company_mail, $_POST["cf_mail"], "Kvittering: Modtaget henvendelse via ajour.dk", $message_to_customer);
				
				// Hvis sendt mail
				if($mail_to_company){
					
					// Send SMS til kunde
					$sms_to_customer = "Hej " . $_POST["cf_name"] . ",\n" . get_field('sms_to_customer') . "\nFortsat go' " . goodday() . "!\n- Ajour";
					$status_sms_to_customer = sendsms($_POST["cf_mobile"], $sms_to_customer);					
					
					// Vis kvittering på side
					echo "<h2>Hej " . $_POST["cf_name"] . "</h2>";
					echo "<p>Vi har modtaget din besked med f&oslash;lgende data:</p>";
					
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
				<label for="mail" class="grid1 float-left margin-right clear-left">E-mail</label><input class="grid5 rounded" type="text" name="cf_mail" id="mail" />
				<label for="validation" class="grid1 float-left margin-right clear-left" id="validationlabel">3 + 2?</label><input class="grid5 rounded" type="text" name="cf_validation" id="validation" />
				<label for="department" class="grid1 float-left margin-right clear-left" id="departmentlabel">Afdeling</label><select name="cf_department" id="department">
					<option value="0">V&aelig;lg:</option>
					<option value="1">Finans support</option>
					<option value="2">Teknisk support</option>
				</select>
				<label for="message" class="grid1 float-left margin-right clear-left">Besked</label><textarea class="grid5 rounded" name="cf_message" id="message"></textarea>
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