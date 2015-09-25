<?php

/**
 * @file
 * Contains \Drupal\facetapi\Form\FacetDeleteConfirmForm.
 */

namespace Drupal\facetapi\Form;

use Drupal\Core\Entity\EntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Defines a confirm form for deleting a server.
 */
class FacetDeleteConfirmForm extends EntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete the facet %name?', array('%name' => $this->entity->label()));
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('entity.facetapi_facet.canonical', array('facetapi_facet' => $this->entity->id(), 'search_api_index' => 'default_index'));
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->entity->delete();
    drupal_set_message($this->t('The facet %name has been deleted.', array('%name' => $this->entity->label())));
    $form_state->setRedirect('entity.search_api_index.facets', array('search_api_index' => 'default_index'));
  }

}