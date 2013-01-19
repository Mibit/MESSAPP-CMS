
      <?php if(isset($info) && is_array($info) && count($info)) { ?>
      <dl id="system-message">
        <dt class="message">Message</dt>
        <dd class="message fade">
            <ul>
                <?php
                        foreach($info as $item) {
                            echo '<li><p>';
                            echo strip_tags($item, '<a><img><span><br>');
                            echo '</p></li>';
                        }
                ?>
            </ul>
        </dd>
      </dl>
      <?php } ?>
      
      <?php if(isset($success) && is_array($success) && count($success)) { ?>
      <dl id="system-message">
        <dt class="message">Success</dt>
        <dd class="message fade">
            <ul>
                <?php
                        foreach($success as $item) {
                            echo '<li><p>';
                            echo strip_tags($item, '<a><img><span><br>');
                            echo '</p></li>';
                        }
                ?>
            </ul>
        </dd>
      </dl>
      <?php } ?>
      
      <?php if(isset($alert) && is_array($alert) && count($alert)) { ?>
      <dl id="system-message">
        <dt class="notice">Alert</dt>
        <dd class="notice message fade">
            <ul>
                <?php
                        foreach($alert as $item) {
                            echo '<li><p>';
                            echo strip_tags($item, '<a><img><span><br>');
                            echo '</p></li>';
                        }
                ?>
            </ul>
        </dd>
      </dl>
      <?php } ?>

      <?php if(validation_errors() || isset($error) && is_array($error) && count($error) ) { ?>
      <dl id="system-message">
        <dt class="error">Error</dt>
        <dd class="error message fade">
            <ul>
                <?php if(validation_errors()) { ?>
                <li><?php echo validation_errors(); ?></li>
                <?php } ?>
                <?php if(isset($error)) {
                        foreach($error as $item) {
                            echo '<li><p>';
                            echo strip_tags($item, '<a><img><span><br>');
                            echo '</p></li>';
                        }
                    }
             	?>
        	</ul>
    	</dd>
      	</dl>     	
    	<?php } ?>
      