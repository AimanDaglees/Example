<?php

namespace Drupal\smartlabs_doc\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Documents List Title Block.
 *
 * @Block(
 *   id = "sl_doc_list_title",
 *   admin_label = @Translation("Documents List Title Block"),
 *   category = @Translation("SmartLabs"),
 * )
 */
class SLDocListTitleBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
    $text = empty($config['summary_text'])
      ? ''
      : $config['summary_text'];

    $build = [];
    $build['#theme'] = 'sldoc_list_title';
    $build['#text'] = $text;
    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['summary_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Summary text'),
      '#description' => $this->t('Summary intro information description.'),
      '#default_value' => isset($config['summary_text']) ? $config['summary_text'] : '',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['summary_text'] = $values['summary_text'];
  }

}
