<section class="pt-[120px] pb-20 text-white style-guide">
  <div class="container">
    <h2 class="text-black">Moss button</h2>
    <div class="flex items-center gap-10 mb-10 bg-white p-10">
      <?php
      the_component( 'button', array(
        'class' => 'btn--green',
        'text'  => 'Primary CTA',
        'link'  => '#',
        'target' => '_blank'
      ) );
      ?>
    </div>
    <div class="flex items-center gap-10 mb-10 bg-white p-10">
      <?php
      the_component( 'button', array(
        'class' => 'btn--green',
        'text'  => 'Download',
        'link'  => '#',
        'target' => '_blank',
        'icon' => 'icon-down'
      ) );
      ?>
    </div>
    <h2 class="text-black">White button</h2>
    <div class="flex items-center gap-10 mb-10 bg-black p-10">
      <?php
      the_component( 'button', array(
        'class' => 'btn--transparent-white',
        'text'  => 'Primary CTA',
        'link'  => '#',
        'target' => '_blank'
      ) );
      ?>
    </div>
    <div class="flex items-center gap-10 mb-10 bg-black p-10">
      <?php
      the_component( 'button', array(
        'class' => 'btn--transparent-white',
        'text'  => 'Download',
        'link'  => '#',
        'target' => '_blank',
        'icon' => 'icon-down'
      ) );
      ?>
    </div>
  </div>
</section>
