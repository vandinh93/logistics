<?php
add_filter( 'gform_field_input', 'sls_gravity_form_custom_select', 10, 5 );
function sls_gravity_form_custom_select( $input, $field, $value, $lead_id, $form_id ) {
    if ( !is_admin() && $field['type'] == 'select' && $field['cssClass'] === 'gfield-select-custom' ) {
      ob_start();
    ?>
      <div class="select-field__inner js-select-field">
        <?php if( !empty($field['choices']) ) : ?>
          <button type="button" class="select-field__current js-field-value">
            <?php if( !empty($field['placeholder']) ) :
              echo '<span class="js-field-value-text">' . $field['placeholder'] . '</span>';
            endif; ?>
            <span class="select-field__arrow arrow-down"><?= _get_svg('arrow-down'); ?></span>
            <span class="select-field__arrow arrow-up"><?= _get_svg('arrow-down'); ?></span>
          </button>
          <div class="select-field__desktop">
            <ul class="select-field__dropdown">
              <?php if( !empty($field['placeholder']) ) : ?>
                <li class="select-field__dropdown-item js-field-option-desktop" data-value=""><?= $field['placeholder']; ?></li>
              <?php endif; ?>
              <?php foreach($field['choices'] as $item) : ?>
                <li class="select-field__dropdown-item js-field-option-desktop" data-value="<?php echo $item['value']; ?>"><?php echo $item['text']; ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="select-field__mobile">
            <select
              class="js-field-mobile select-field__select"
              id="input_<?php echo $form_id . '_' . $field['id']; ?>"
              name="<?php echo 'input_' . $field['id']; ?>"
              <?php if ( $field['isRequired'] ) : ?>
                aria-required="true"
              <?php endif; ?>
              <?php if( !empty($field['placeholder']) ) : ?>
                value="<?= $field['placeholder']; ?>"
              <?php endif; ?>
            >
              <?php if( !empty($field['placeholder']) ) : ?>
                <option value="" class="gf_placeholder js-field-option"><?= $field['placeholder']; ?></option>
              <?php endif; ?>
              <?php foreach($field['choices'] as $item) : ?>
                <option class="select-field__option js-field-option" value="<?php echo $item['value']; ?>"><?php echo $item['text']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        <?php endif; ?>
      </div>
      <style>
        .GF_AJAX_POSTBACK .select-field__current,
        .GF_AJAX_POSTBACK .select-field__arrow,
        .GF_AJAX_POSTBACK .select-field__desktop {
          display: none;
        }
      </style>
    <?php
      $input = ob_get_clean();
    }
    return $input;
}

add_filter('gform_validation', 'sls_gravity_validate_phone_numbers');
function sls_gravity_validate_phone_numbers($validation_result) {
  $form = $validation_result['form'];

  foreach ($form['fields'] as &$field) {
    // Check if the field is a phone field
    if ($field->type == 'phone' && $field->phoneFormat != 'standard') {
      $phone_number = rgpost("input_{$field->id}");

      if (!isValidPhoneNumber($phone_number)) {
        $validation_result['is_valid'] = false;
        $field->failed_validation = true;
        $field->validation_message = 'Please enter a valid phone number.';
      }
    }
  }

  $validation_result['form'] = $form;
  return $validation_result;
}

function isValidPhoneNumber($number) {
  $strippedNumber = preg_replace('/\D/', '', $number);
  $length = strlen($strippedNumber);

  if ($length < 6 || $length > 15) {
    return false;
  }

  if (preg_match('/^\+[0-9]{1,2}[ ]\([0-9]{1}\)[ ]([0-9]{9})$/', $number)) {
    return false;
  }

  return true;
}
