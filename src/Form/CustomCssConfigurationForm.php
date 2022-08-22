<?php

namespace Drupal\customcss\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class CustomCssConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'customcss_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'customcss.admin_settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('customcss.admin_settings');
    $form['customcss_urls_classes'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Urls and css classes'),
      '#default_value' => $config->get('customcss_urls_classes'),
      '#format' => 'plain_text',
      '#description' => $this->t('Specify single or multiple CSS classes that can then be applied to the <body> tag on specific pages on the front end.<br>Format: url1, url2...urln | css | urla, urlb ... urlx | classes2'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('customcss.admin_settings')
      ->set('customcss_urls_classes', $form_state->getValue('customcss_urls_classes'))
      ->save();
    parent::submitForm($form, $form_state);
  }
}
