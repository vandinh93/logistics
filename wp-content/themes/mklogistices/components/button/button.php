<?php
  $class = !empty($class) ? $class : '';
  $attrs = !empty($attrs) ? $attrs : '';
  $target = !empty($target) ? $target : '';
  $tag = empty($link) ? 'button' : 'a';
  $icon = !empty($icon) ? $icon : '';
  $class .= $icon ? ' has-icon' : '';
  $expand_class = $class ? ' '.$class : '';

  if ( !empty($text) ) :
    if (!empty($link)) {
      // add aria-label, title and target attributes to <a> tag only
      $attrs = sprintf(' href="%s" title="%s" aria-label="%s" target="%s" %s', $link, $text, $text, $target, $attrs);
    } ?>
    <<?= $tag; ?>
    class="js-btn relative btn <?php echo $class; ?>"
    <?= $attrs; ?>
    <?php if ( !empty($ga) ) : echo 'onClick="'. $ga . '"'; endif; ?>
    >
      <span class=""><?= $text; ?></span>
      <?php if (!empty($icon)) : ?>
        <span class="button__icon"><?= _get_svg($icon) ?></span>
      <?php endif; ?>
    </<?= $tag; ?>>
  <?php endif; ?>
