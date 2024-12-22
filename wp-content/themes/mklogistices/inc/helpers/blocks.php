<?php
/*
 * Global Function for displaying blocks
 */
function the_content_blocks($post = false){
  (new SLS_Blocks)->the_content($post);
}
