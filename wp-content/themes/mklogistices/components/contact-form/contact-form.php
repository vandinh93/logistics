<?php if (!empty($gravify_form_id) || !empty($contact_details)) : ?>
  <section class="js-contact-form relative" data-module="contact-form">
    <div class="flex flex-wrap">
      <?php if (!empty($contact_details['left_title']) || !empty($contact_details['phone_number']) || !empty($contact_details['email']) || !empty($contact_details['right_title']) || !empty($contact_details['address_detail'])) : ?>
        <div class="js-line-row contact-form__line-row contact-form__line-row--1"></div>
        <div class="relative flex flex-wrap w-full">
          <div class="relative flex flex-col text-center w-full py-10 px-5 border-0 md:py-12 lg:w-1/2 lg:py-[76px]">
            <div class="js-line-col contact-form__line-col contact-form__line-col--1 hidden lg:block"></div>
            <?php if (!empty($contact_details['left_title'])) : ?>
              <h3 class="mb-4 text-fs-13 text-cinder lg:mb-9 lg:text-base"><?= $contact_details['left_title']; ?></h3>
            <?php endif; ?>
            <?php if (!empty($contact_details['phone_number'])) : ?>
              <p class="font-heading text-fs-20 md:text-fs-31 3xl:text-fs-45"><a class="contact-form__link" href="tel:<?= $contact_details['phone_number']; ?>"><?= $contact_details['phone_number']; ?></a></p>
            <?php endif; ?>
            <?php if (!empty($contact_details['email'])) : ?>
              <p class="font-heading text-fs-20 md:text-fs-31 3xl:text-fs-45"><a class="contact-form__link" href="mailto:<?= $contact_details['email']; ?>"><?= $contact_details['email']; ?></a></p>
            <?php endif; ?>
          </div>
          <div class="relative flex flex-col text-center w-full py-10 px-5 border-0 md:py-12 lg:w-1/2 lg:py-[76px]">
            <div class="js-line-row contact-form__line-row contact-form__line-row--2 block lg:hidden"></div>
            <?php if (!empty($contact_details['right_title'])) : ?>
              <h3 class="mb-4 text-fs-13 text-cinder lg:mb-9 lg:text-base"><?= $contact_details['right_title']; ?></h3>
            <?php endif; ?>
            <?php if (!empty($contact_details['address_detail'])) : ?>
              <p class="font-heading text-fs-20 md:text-fs-31 3xl:text-fs-45"><?= $contact_details['address_detail']; ?></p>
            <?php endif; ?>
          </div>
          <div class="js-line-row contact-form__line-row contact-form__line-row--3 contact-form__line-row-bottom"></div>
        </div>
      <?php endif; ?>
      <?php if (!empty($gravify_form_id)) : ?>
        <div class="contact-form relative">
          <?php
            $form_shortcode = '[gravityform id="'. $gravify_form_id .'" title="false" ajax="true"]';
            echo do_shortcode($form_shortcode);
          ?>
          <div class="js-contact-form-line contact-form__line">
            <div class="js-line-row contact-form__line-row contact-form__line-row--4"></div>
            <div class="js-line-row contact-form__line-row contact-form__line-row--5"></div>
            <div class="js-line-row contact-form__line-row contact-form__line-row--6"></div>
            <div class="js-line-row contact-form__line-row contact-form__line-row--7"></div>
            <div class="js-line-row contact-form__line-row contact-form__line-row--8"></div>
            <div class="js-line-col contact-form__line-col-bottom contact-form__line-col-bottom--1"></div>
            <div class="js-line-col contact-form__line-col-bottom contact-form__line-col-bottom--2"></div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>
