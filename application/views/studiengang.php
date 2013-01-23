<?php echo form_open("{$my_url}save", array("name" => "form", "id" => "form", "enctype" => "multipart/form-data")); ?>
<?php echo form_hidden("stgID", $stg->stgID); ?>
<?php echo form_hidden("target"); ?>
<!-- Test -->
<div class="stgForm stgEdit">
	<fieldset>
		<legend>
			<a id="Studiengang">Studiengang</a>
		</legend>
		<table>
			<tr>
				<td><label for="stgKBez">Kurzbezeichnung des Studiengangs:</label></td>
				<td><?php echo form_input(array("name" => "stgKBez", "value" => $stg->stgKBez, "onKeyUp" => "javascript:charCounter(this)")); charCounter(5) ?>
				</td>
			</tr>
			<tr>
				<td><label for="stgBez">Voller Studiengangsname:</label></td>
				<td><?php echo form_input(array("name" => "stgBez", "value" => $stg->stgBez, "onKeyUp" => "javascript:charCounter(this)")); charCounter(60) ?>
				</td>
			</tr>
			<tr>
				<td><label>Art des Studiengangs:</label></td>
				<td>Bachelor&nbsp;<?php echo form_radio(array("name" => "stgArt", "value" => "B", "checked" => ($stg->stgArt=="B"? "checked": "") )); ?>
					&nbsp;Master&nbsp;<?php echo form_radio(array("name" => "stgArt", "value" => "M", "checked" => ($stg->stgArt=="M"? "checked": "") )); ?>
					&nbsp;Post&nbsp;Graduate&nbsp;<?php echo form_radio(array("name" => "stgArt", "value" => "P", "checked" => ($stg->stgArt=="P"? "checked": "") )); ?>
				</td>
			</tr>
			<tr>
				<td><label>Organisationsform:</label></td>
				<td>Vollzeit&nbsp;<?php echo form_radio(array("name" => "stgFOrganisationsform", "value" => "vz", "checked" => ($stg->stgFOrganisationsform=="vz"? "checked": "") )); ?>
					&nbsp;Berufsbegleitend&nbsp;<?php echo form_radio(array("name" => "stgFOrganisationsform", "value" => "bb", "checked" => ($stg->stgFOrganisationsform=="bb"? "checked": "") )); ?>
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>
			<a id="&Uuml;bersichtsbild">&Uuml;bersichtsbild</a>
		</legend>
		<table>
			<tr>
				<td><label for="stgGridViewImage">Bild f&uuml;r die &Uuml;bersicht:</label>
				</td>
				<td>
					<div>
						<a
							href="<?php echo "data:image/jpeg;base64," . base64_encode($stg->stgGridViewImage) ?>"
							class="thickbox"><?php if($stg->stgGridViewImage) { 
								echo "<img src=\"data:image/jpeg;base64," . base64_encode($stg->stgGridViewImage). "\" />";
							} ?> </a>
						<?php echo form_upload(array("name" => "stgGridViewImage")); ?>
						<?php echo form_hidden("stgGridViewImage_hidden", base64_encode($stg->stgGridViewImage)); ?>
					</div>
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>
			<a id="Studiengangsleitung">Studiengangsleitung</a>
		</legend>
		<table>
			<tr>
				<td><label for="stgStgL">Name der Studiengangsleitung:</label></td>
				<td><?php echo form_input(array("name" => "stgStgL", "value" => $stg->stgStgL, "onKeyUp" => "javascript:charCounter(this)")); charCounter(75) ?>
				</td>
			</tr>
			<tr>
				<td><label for="stgStgLImage">Bild der Studiengangsleitung:</label>
				</td>
				<td>
					<div>
						<a
							href="<?php echo "data:image/jpeg;base64," . base64_encode($stg->stgStgLImage) ?>"
							class="thickbox"><?php if($stg->stgStgLImage) { 
								echo "<img src=\"data:image/jpeg;base64," . base64_encode($stg->stgStgLImage). "\" />";
							} ?> </a>
						<?php echo form_upload(array("name" => "stgStgLImage")); ?>
						<?php echo form_hidden("stgStgLImage_hidden", base64_encode($stg->stgStgLImage)); ?>
					</div>
				</td>
			</tr>
			<tr>
				<td class="editorLabel"><label for="stgHighlights">Zitat der
						Studiengangsleitung:</label></td>
				<td><?php echo form_textarea(array("name" => "stgQuote", "value" => $stg->stgQuote, "onKeyUp" => "javascript:charCounter(this)")); charCounter(500) ?>
				</td>
			</tr>
			<tr>
				<td><label for="stgStgA">Name der Studiengangsassistenz:</label></td>
				<td><?php echo form_input(array("name" => "stgStgA", "value" => $stg->stgStgA, "onKeyUp" => "javascript:charCounter(this)")); charCounter(75) ?>
				</td>
			</tr>
			<tr>
				<td><label for="stgStgAImage">Bild der Studiengangsasistenz:</label>
				</td>
				<td>
					<div>
						<a
							href="<?php echo "data:image/jpeg;base64," . base64_encode($stg->stgStgAImage) ?>"
							class="thickbox"><?php if($stg->stgStgAImage) { 
								echo "<img src=\"data:image/jpeg;base64," . base64_encode($stg->stgStgAImage). "\" />";
							} ?> </a>
						<?php echo form_upload(array("name" => "stgStgAImage")); ?>
						<?php echo form_hidden("stgStgAImage_hidden", base64_encode($stg->stgStgAImage)); ?>
					</div>
				</td>
			</tr>
			<tr>
				<td><label for="stgStgLInfo">Telefon der Studiengangsassistenz:</label>
				</td>
				<td><?php echo form_input(array("name" => "stgStgLInfo", "value" => $stg->stgStgLInfo, "onKeyUp" => "javascript:charCounter(this)")); charCounter(150) ?>
				</td>
			</tr>
			<tr>
				<td><label for="stgStgAInfo">E-Mail der Studiengangsassistenz:</label>
				</td>
				<td><?php echo form_input(array("name" => "stgStgAInfo", "value" => $stg->stgStgAInfo, "onKeyUp" => "javascript:charCounter(this)")); charCounter(150) ?>
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>
			<a id="Studiengangs&uuml;bersicht">Studiengangs&uuml;bersicht</a>
		</legend>
		<table>
			<tr>
				<td><label for="stgKImage">Bild zur &Uuml;bersicht:</label></td>
				<td>
					<div>
						<a
							href="<?php echo "data:image/jpeg;base64," . base64_encode($stg->stgKImage) ?>"
							class="thickbox"><?php if($stg->stgKImage) { 
								echo "<img src=\"data:image/jpeg;base64," . base64_encode($stg->stgKImage). "\" />";
							} ?> </a>
						<?php echo form_upload(array("name" => "stgKImage")); ?>
						<?php echo form_hidden("stgKImage_hidden", base64_encode($stg->stgKImage)); ?>
					</div>
				</td>
			</tr>
			<tr>
				<td class="editorLabel"><label for="stgKBeschreibung">&Uuml;bersicht:</label>
				</td>
				<td><?php echo form_textarea(array("name" => "stgKBeschreibung", "value" => $stg->stgKBeschreibung, "onKeyUp" => "javascript:charCounter(this)")); charCounter(1000) ?>
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>
			<a id="Zitate">Zitate</a>
		</legend>
		<table>
			<tr>
				<td><label for="stgStudent1Image">Bild für Zitat des 1. Studenten:</label>
				</td>
				<td>
					<div>
						<a
							href="<?php echo "data:image/jpeg;base64," . base64_encode($stg->stgStudent1Image) ?>"
							class="thickbox"><?php if($stg->stgStudent1Image) { 
								echo "<img src=\"data:image/jpeg;base64," . base64_encode($stg->stgStudent1Image). "\" />";
							} ?> </a>
						<?php echo form_upload(array("name" => "stgStudent1Image", "value" => $stg->stgStudent1Image)); ?>
						<?php echo form_hidden("stgStudent1Image_hidden", base64_encode($stg->stgStudent1Image)); ?>
					</div>
				</td>
			</tr>
			<tr>
				<td class="editorLabel"><label for="stgStudent1Quote">Zitat des 1.
						Studenten: </label></td>
				<td><?php echo form_textarea(array("name" => "stgStudent1Quote", "value" => $stg->stgStudent1Quote, "onKeyUp" => "javascript:charCounter(this)")); charCounter(500) ?>
				</td>
			</tr>
			<tr>
				<td><label for="stgStudent2Image">Bild für Zitat des 2. Studenten:</label>
				</td>
				<td>
					<div>
						<a
							href="<?php echo "data:image/jpeg;base64," . base64_encode($stg->stgStudent2Image) ?>"
							class="thickbox"><?php if($stg->stgStudent2Image) { 
								echo "<img src=\"data:image/jpeg;base64," . base64_encode($stg->stgStudent2Image). "\" />";
							} ?> </a>
						<?php echo form_upload(array("name" => "stgStudent2Image", "value" => $stg->stgStudent2Image)); ?>
						<?php echo form_hidden("stgStudent2Image_hidden", base64_encode($stg->stgStudent2Image)); ?>
					</div>
				</td>
			</tr>
			<tr>
				<td class="editorLabel"><label for="stgStudent2Quote">Zitat des 2.
						Studenten:</label></td>
				<td><?php echo form_textarea(array("name" => "stgStudent2Quote", "value" => $stg->stgStudent2Quote, "onKeyUp" => "javascript:charCounter(this)")); charCounter(500) ?>
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>
			<a id="Highlights">Highlights</a>
		</legend>
		<table>
			<tr>
				<td><label for="stgHImage">Highlightsbild:</label></td>
				<td>
					<div>
						<a
							href="<?php echo "data:image/jpeg;base64," . base64_encode($stg->stgHImage) ?>"
							class="thickbox"><?php if($stg->stgHImage) { 
								echo "<img src=\"data:image/jpeg;base64," . base64_encode($stg->stgHImage). "\" />";
							} ?> </a>
						<?php echo form_upload(array("name" => "stgHImage", "value" => $stg->stgHImage)); ?>
						<?php echo form_hidden("stgHImage_hidden", base64_encode($stg->stgHImage)); ?>
					</div>
				</td>
			</tr>
			<tr>
				<td class="editorLabel"><label for="stgHighlights">Highlights:</label>
				</td>
				<td><?php echo form_textarea(array("name" => "stgHighlights", "value" => $stg->stgHighlights, "onKeyUp" => "javascript:charCounter(this)")); charCounter(1000) ?>
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>
			<a id="Fakten">Fakten</a>
		</legend>
		<table>
			<tr>
				<td><label for="stgFImage">Faktenbild:</label></td>
				<td>
					<div>
						<a
							href="<?php echo "data:image/jpeg;base64," . base64_encode($stg->stgFImage) ?>"
							class="thickbox"><?php if($stg->stgFImage) { 
								echo "<img src=\"data:image/jpeg;base64," . base64_encode($stg->stgFImage). "\" />";
							} ?> </a>
						<?php echo form_upload(array("name" => "stgFImage")); ?>
						<?php echo form_hidden("stgFImage_hidden", base64_encode($stg->stgFImage)); ?>
					</div>
				</td>
			</tr>
			<tr>
				<td><label for="stgFStudienplaetze">Anzahl der Studienpl&auml;tze:</label>
				</td>
				<td><?php echo form_input(array("name" => "stgFStudienplaetze", "value" => $stg->stgFStudienplaetze, "onKeyUp" => "javascript:charCounter(this)")); charCounter(3) ?>
				</td>
			</tr>
			<tr>
				<td><label for="stgFBewerbungsmodus">Bewerbungsmodus:</label></td>
				<td><?php echo form_input(array("name" => "stgFBewerbungsmodus", "value" => $stg->stgFBewerbungsmodus, "onKeyUp" => "javascript:charCounter(this)")); charCounter(100) ?>
				</td>
			</tr>
			<tr>
				<td><label for="stgFDauer">Dauer:</label></td>
				<td><?php echo form_input(array("name" => "stgFDauer", "value" => $stg->stgFDauer, "onKeyUp" => "javascript:charCounter(this)")); charCounter(15) ?>
				</td>
			</tr>
			<tr>
				<td><label for="stgFAkadGrad">Akademischer Grad:</label></td>
				<td><?php echo form_input(array("name" => "stgFAkadGrad", "value" => $stg->stgFAkadGrad, "onKeyUp" => "javascript:charCounter(this)")); charCounter(45) ?>
				</td>
			</tr>
			<tr>
				<td><label for="stgFUnterrichtssprache">Unterrichtssprache:</label>
				</td>
				<td><?php echo form_input(array("name" => "stgFUnterrichtssprache", "value" => $stg->stgFUnterrichtssprache, "onKeyUp" => "javascript:charCounter(this)")); charCounter(75) ?>
				</td>
			</tr>
			<tr>
				<td><label for="stgFBesonderheit">Besonderheit:</label></td>
				<td><?php echo form_input(array("name" => "stgFBesonderheit", "value" => $stg->stgFBesonderheit, "onKeyUp" => "javascript:charCounter(this)")); charCounter(150) ?>
				</td>
			</tr>
			<tr>
				<td><label for="stgFAuslandsaufenthalt">Auslandsaufenthalt:</label>
				</td>
				<td><?php echo form_input(array("name" => "stgFAuslandsaufenthalt", "value" => $stg->stgFAuslandsaufenthalt, "onKeyUp" => "javascript:charCounter(this)")); charCounter(150) ?>
				</td>
			</tr>
			<tr>
				<td><label for="stgFKosten">Kosten:</label></td>
				<td><?php echo form_input(array("name" => "stgFKosten", "value" => $stg->stgFKosten, "onKeyUp" => "javascript:charCounter(this)")); charCounter(75) ?>
				</td>
			</tr>

		</table>
	</fieldset>
	<fieldset>
		<legend>
			<a id="Berufsfelder">Berufsfelder</a>
		</legend>
		<table>
			<tr>
				<td><label for="stgBImage">Berufsfelderbild:</label></td>
				<td>
					<div>
						<a
							href="<?php echo "data:image/jpeg;base64," . base64_encode($stg->stgBImage) ?>"
							class="thickbox"><?php if($stg->stgBImage) { 
								echo "<img src=\"data:image/jpeg;base64," . base64_encode($stg->stgBImage). "\" />";
							} ?> </a>
						<?php echo form_upload(array("name" => "stgBImage")); ?>
						<?php echo form_hidden("stgBImage_hidden", base64_encode($stg->stgBImage)); ?>
					</div>
				</td>
			</tr>
			<tr>
				<td class="editorLabel"><label for="stgBFelder">Berufsfelder:</label>
				</td>
				<td><?php echo form_textarea(array("name" => "stgBFelder", "value" => $stg->stgBFelder, "onKeyUp" => "javascript:charCounter(this)")); charCounter(750) ?>
				</td>
			</tr>

		</table>
	</fieldset>
	<fieldset>
		<legend>
			<a id="Curriculum">Curriculum</a>
		</legend>
		<table>
			<tr>
				<td><label for="stgCurriculumImage">Bild des Curriculums:</label></td>
				<td>
					<div>
						<a
							href="<?php echo "data:image/jpeg;base64," . base64_encode($stg->stgCurriculumImage) ?>"
							class="thickbox"><?php if($stg->stgCurriculumImage) { 
								echo "<img src=\"data:image/jpeg;base64," . base64_encode($stg->stgCurriculumImage). "\" />";
							} ?> </a>
						<?php echo form_upload(array("name" => "stgCurriculumImage")); ?>
						<?php echo form_hidden("stgCurriculumImage_hidden", base64_encode($stg->stgCurriculumImage)); ?>
					</div>
				</td>
			</tr>
		</table>
	</fieldset>
</div>
<?php echo form_submit(array("style" => "display:none;")); ?>
<div id="status">
	<?php echo $systemMessages; ?>
	&nbsp;&nbsp;<label for="freigabe" style="font-weight: bold">Freigeben:&nbsp;</label>
	<?php echo form_checkbox(array("name" => "freigabe", "value" => "1", "checked" => ($stg->freigabe ? "checked": "") )); ?>
	&nbsp;&nbsp;
	<?php echo form_button(array("name" => "submit", "content" => "Speichern", "class" => "button", "onClick" => "javascript: save();"))?>
</div>

<div class="clr" style="margin-bottom: <?php echo ((count($info) + count($success) + count($alert) + count($error))* 47  + (validation_errors() ? 47 + ((substr_count(validation_errors(), "<p>")-1) * 21) : 0) + 50); ?>px"></div>
<?php echo form_close(); ?>
