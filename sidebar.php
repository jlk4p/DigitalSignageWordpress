<?php
/**
 * Use this to define the contents of the docks at the bottom of the digital sign.
 */
?>
     <div id="dock">
          <div id="DockLeft" class="dockleft">
			<p>
				<span id="dig-sign-time" class="time"></span><br />
				<span id="dig-sign-date" class="date"></span>
			</p>
          </div> <!-- .dockleft -->
          <div id="DockCenter" class="dockcenter">
               <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar(DockCenter)) : ?>
               	
               <?php endif; ?>
          </div> <!-- .dockcenter -->
          <div id="DockRight" class="dockright">
               <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar(DockRight)) : ?>
               	
               <?php endif; ?>
          </div> <!-- .dockright -->
          <div id="DockFarRight" class="dockfarright">
               <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar(DockFarRight)) : ?>
               	
               <?php endif; ?>
          </div> <!-- .dockfarright -->
     </div> <!-- #dock -->
