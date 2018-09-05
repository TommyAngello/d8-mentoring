<?php

namespace Drupal\config_d8_example\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConfigEntityExampleForm.
 */
class ConfigEntityExampleForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $config_entity_example = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $config_entity_example->label(),
      '#description' => $this->t("Label for the Config Entity Example."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $config_entity_example->id(),
      '#machine_name' => [
        'exists' => '\Drupal\config_d8_example\Entity\ConfigEntityExample::load',
      ],
      '#disabled' => !$config_entity_example->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $config_entity_example = $this->entity;
    $status = $config_entity_example->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Config Entity Example.', [
          '%label' => $config_entity_example->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Config Entity Example.', [
          '%label' => $config_entity_example->label(),
        ]));
    }
    $form_state->setRedirectUrl($config_entity_example->toUrl('collection'));
  }

}
