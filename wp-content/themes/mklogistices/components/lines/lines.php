<?php
  $class = empty($class) ? 'absolute inset-0 container' : $class;
  $line_class = empty($line_class) ? 'bg-white bg-opacity-20' : $line_class;
?>
<div class="lines pointer-events-none <?= $class ?>">
  <div class="absolute bottom-0 left-5 w-[1px] h-0 [.lines--active_&]:h-[100px] md:left-[54px] [.lines--active_&]:md:h-[208px] lg:left-[96px] transition-all duration-300 ease-in <?= $line_class ?>"></div>
  <div class="absolute bottom-0 left-1/2 w-[1px] h-0 [.lines--active_&]:h-[300px] [.lines--active_&]:md:h-full [.lines--active_&]:lg:h-[720px] transition-all duration-300 ease-in delay-300 <?= $line_class ?>"></div>
  <div class="absolute bottom-0 right-5 w-[1px] h-0 [.lines--active_&]:h-full md:right-[157px] lg:right-[301px] transition-all duration-300 ease-in delay-[600ms] <?= $line_class ?>"></div>
</div>
