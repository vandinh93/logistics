<?php
$content = get_field( 'page_builder' );
if (!empty($content)) {
  foreach ($content as $index => $row) {
    $module = $row['acf_fc_layout'];
    $row['module'] = str_replace('_', '-', $module);
    unset($row['acf_fc_layout']);
    $row['index'] = $index + 1;
    $row['total'] = count($content);
    $row = apply_filters_ref_array('mklogistics/flexible/' . $module, array($row));
    the_component($row['module'], $row);
  }
}
