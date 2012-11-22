<?php echo form_open("{$my_url}save",  array("name" => "form", "id" => "form", "enctype" => "multipart/form-data")); ?>
<?php echo form_hidden("stgID", $stg->stgID); ?>
		<div class="col width-100"> 
			<fieldset>
			     <legend>Studieng&auml;nge</legend>
					<table>
                        <tr>
                            <td><label for="stgKBez">Kurzbezeichnung des Studiengangs: </label><?php echo form_input(array("name" => "stgKBez", "value" => $stg->stgKBez)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgBez">Voller Studiengangsname: </label><?php echo form_input(array("name" => "stgBez", "value" => $stg->stgBez)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgArt">Bachelor </label><?php echo form_radio(array("name" => "stgArt", "value" => "B", "checked" => ($stg->stgArt=="B"? "checked": "") )); ?>
                            	<label for="stgArt"> Master </label><?php echo form_radio(array("name" => "stgArt", "value" => "M", "checked" => ($stg->stgArt=="M"? "checked": "") )); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="stgStgL">Name der Studiengangsleitung: </label><?php echo form_input(array("name" => "stgStgL", "value" => $stg->stgStgL)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgStgLImage">Bild der Studiengangsleitung: <br /></label>
                            	<div>
                            		<?php if($stg->stgStgLImage) { echo "<img height=\"150\" src=\"data:image/jpeg;base64," . base64_encode($stg->stgStgLImage). "\" />"; } ?>
                            		<?php echo form_upload(array("name" => "stgStgLImage", "value" => $stg->stgStgLImage)); ?>
                            	</div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="stgStgA">Name der Studiengangsassistenz: </label><?php echo form_input(array("name" => "stgStgA", "value" => $stg->stgStgA)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgStgAImage">Bild der Studiengangsasistenz: <br /></label>
                            	<div>
                            		<?php if($stg->stgStgAImage) { echo "<img height=\"150\" src=\"data:image/jpeg;base64," . base64_encode($stg->stgStgAImage). "\" />"; } ?>
                            		<?php echo form_upload(array("name" => "stgStgAImage", "value" => $stg->stgStgAImage)); ?>
                            	</div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="stgQuote">Zitat: </label><?php echo form_textarea(array("name" => "stgQuote", "value" => $stg->stgQuote)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgHighlights">Kurze Highlights: </label><?php echo form_textarea(array("name" => "stgHighlights", "value" => $stg->stgHighlights)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgStgLInfo">Info zum Studiengangsleiter: </label><?php echo form_input(array("name" => "stgStgLInfo", "value" => $stg->stgStgLInfo)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgStgAInfo">Info zur Studiengangsassistenz: </label><?php echo form_input(array("name" => "stgStgAInfo", "value" => $stg->stgStgAInfo)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgHImage1">Highlightsbild 1: </label>
                            	<div>
                            		<?php if($stg->stgHImage1) { echo "<img height=\"150\" src=\"data:image/jpeg;base64," . base64_encode($stg->stgHImage1). "\" />"; } ?>
                            		<?php echo form_upload(array("name" => "stgHImage1", "value" => $stg->stgHImage1)); ?>
                            	</div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="stgHImage2">Highlightsbild 2: </label>
                            	<div>
                            		<?php if($stg->stgHImage2) { echo "<img height=\"150\" src=\"data:image/jpeg;base64," . base64_encode($stg->stgHImage2). "\" />"; } ?>
                            		<?php echo form_upload(array("name" => "stgHImage2", "value" => $stg->stgHImage2)); ?>
                            	</div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="stgBigH">Gro&szlig;e Highlights: </label><?php echo form_textarea(array("name" => "stgBigH", "value" => $stg->stgBigH)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgCurriculumImage">Bild des Curriculums: </label>
                            	<div>
                            		<?php if($stg->stgCurriculumImage) { echo "<img height=\"150\" src=\"data:image/jpeg;base64," . base64_encode($stg->stgCurriculumImage). "\" />"; } ?>
                            		<?php echo form_upload(array("name" => "stgCurriculumImage", "value" => $stg->stgCurriculumImage)); ?>
                            	</div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="stgFOrganisationsform"> Vollzeit </label><?php echo form_radio(array("name" => "stgFOrganisationsform", "value" => "vz", "checked" => ($stg->stgFOrganisationsform=="vz"? "checked": "") )); ?>
                            	<label for="stgFOrganisationsform"> berufsbegleitend </label><?php echo form_radio(array("name" => "stgFOrganisationsform", "value" => "bb", "checked" => ($stg->stgFOrganisationsform=="bb"? "checked": "") )); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="stgFStudienplaetze">Anzahl der Studienpl&auml;tze: </label><?php echo form_input(array("name" => "stgFStudienplaetze", "value" => $stg->stgFStudienplaetze)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgFBewerbungsmodus">Bewerbungsmodus: </label><?php echo form_input(array("name" => "stgFBewerbungsmodus", "value" => $stg->stgFBewerbungsmodus)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgFDauer">Dauer: </label><?php echo form_input(array("name" => "stgFDauer", "value" => $stg->stgFDauer)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgFAkadGrad">Akademischer Grad: </label><?php echo form_input(array("name" => "stgFAkadGrad", "value" => $stg->stgFAkadGrad)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgFUnterrichtssprache">Unterrichtssprache: </label><?php echo form_input(array("name" => "stgFUnterrichtssprache", "value" => $stg->stgFUnterrichtssprache)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgFBesonderheit">Besonderheit: </label><?php echo form_input(array("name" => "stgFBesonderheit", "value" => $stg->stgFBesonderheit)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgFAuslandsaufenthalt">Auslandsaufenthalt: </label><?php echo form_input(array("name" => "stgFAuslandsaufenthalt", "value" => $stg->stgFAuslandsaufenthalt)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgFKosten">Kosten: </label><?php echo form_input(array("name" => "stgFKosten", "value" => $stg->stgFKosten)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgFZugangsvoraussetzungen">Zugangsvoraussetzungen: </label><?php echo form_textarea(array("name" => "stgFZugangsvoraussetzungen", "value" => $stg->stgFZugangsvoraussetzungen)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgFImage">Faktenbild: </label>
                            	<div>
                            		<?php if($stg->stgFImage) { echo "<img height=\"150\" src=\"data:image/jpeg;base64," . base64_encode($stg->stgFImage). "\" />"; } ?>
                            		<?php echo form_upload(array("name" => "stgFImage", "value" => $stg->stgFImage)); ?>
                            	</div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="stgBFelder">Berufsfelder: </label><?php echo form_textarea(array("name" => "stgBFelder", "value" => $stg->stgBFelder)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgBImage1">Berufsfelderbild 1: </label>
                            	<div>
                            		<?php if($stg->stgBImage1) { echo "<img height=\"150\" src=\"data:image/jpeg;base64," . base64_encode($stg->stgBImage1). "\" />"; } ?>
                            		<?php echo form_upload(array("name" => "stgBImage1", "value" => $stg->stgBImage1)); ?>
                            	</div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="stgBImage2">Berufsfelderbild 2: </label>
                            	<div>
                            		<?php if($stg->stgBImage2) { echo "<img height=\"150\" src=\"data:image/jpeg;base64," . base64_encode($stg->stgBImage2). "\" />"; } ?>
                            		<?php echo form_upload(array("name" => "stgBImage2", "value" => $stg->stgBImage2)); ?>
                            	</div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="stgKBeschreibung">Kurzbeschreibung: </label><?php echo form_textarea(array("name" => "stgKBeschreibung", "value" => $stg->stgKBeschreibung)); ?></td>
                        </tr>
                        <tr>
                            <td><label for="stgKImage1">Bild 1 zur Kurzbeschreibung: </label>
                            	<div>
                            		<?php if($stg->stgKImage1) { echo "<img height=\"150\" src=\"data:image/jpeg;base64," . base64_encode($stg->stgKImage1). "\" />"; } ?>
                            		<?php echo form_upload(array("name" => "stgKImage1", "value" => $stg->stgKImage1)); ?>
                            	</div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="stgKImage2">Bild 2 zur Kurzbeschreibung: </label>
                            	<div>
                            		<?php if($stg->stgKImage2) { echo "<img height=\"150\" src=\"data:image/jpeg;base64," . base64_encode($stg->stgKImage2). "\" />"; } ?>
                            		<?php echo form_upload(array("name" => "stgKImage2", "value" => $stg->stgKImage2)); ?>
                            	</div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="stgImage">Titelbild des Studienganges: </label>
                            	<div>
                            		<?php if($stg->stgImage) { echo "<img height=\"150\" src=\"data:image/jpeg;base64," . base64_encode($stg->stgImage). "\" />"; } ?>
                            		<?php echo form_upload(array("name" => "stgImage", "value" => $stg->stgImage)); ?>
                            	</div>
                            </td>
                        </tr><tr>
                            <td><label for="freigabe">Freigeben: </label><?php echo form_checkbox(array("name" => "freigabe", "value" => "1", "checked" => ($stg->freigabe ? "checked": "") )); ?></td>
                        </tr><tr>
                        	<td><?php echo form_submit(array("name" => "submit", "value" => "Speichern"))?>&nbsp;&nbsp;<?php echo form_button(array("name" => "back", "value" => true, "content" => "Zur&uuml;ck", "onClick" => "window.location.replace('$my_url')"))?>
                        </tr>
					</table>
			</fieldset>
		</div>

		<div class="clr"></div>
<?php echo form_close(); ?>