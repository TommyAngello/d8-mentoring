<?php

namespace Drupal\content_d8_example\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\content_d8_example\Entity\ContentEntityExampleInterface;

/**
 * Class ContentEntityExampleController.
 *
 *  Returns responses for Content Entity Example routes.
 */
class ContentEntityExampleController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Content Entity Example  revision.
   *
   * @param int $content_entity_example_revision
   *   The Content Entity Example  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($content_entity_example_revision) {
    $content_entity_example = $this->entityManager()->getStorage('content_entity_example')->loadRevision($content_entity_example_revision);
    $view_builder = $this->entityManager()->getViewBuilder('content_entity_example');

    return $view_builder->view($content_entity_example);
  }

  /**
   * Page title callback for a Content Entity Example  revision.
   *
   * @param int $content_entity_example_revision
   *   The Content Entity Example  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($content_entity_example_revision) {
    $content_entity_example = $this->entityManager()->getStorage('content_entity_example')->loadRevision($content_entity_example_revision);
    return $this->t('Revision of %title from %date', ['%title' => $content_entity_example->label(), '%date' => format_date($content_entity_example->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Content Entity Example .
   *
   * @param \Drupal\content_d8_example\Entity\ContentEntityExampleInterface $content_entity_example
   *   A Content Entity Example  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(ContentEntityExampleInterface $content_entity_example) {
    $account = $this->currentUser();
    $langcode = $content_entity_example->language()->getId();
    $langname = $content_entity_example->language()->getName();
    $languages = $content_entity_example->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $content_entity_example_storage = $this->entityManager()->getStorage('content_entity_example');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $content_entity_example->label()]) : $this->t('Revisions for %title', ['%title' => $content_entity_example->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all content entity example revisions") || $account->hasPermission('administer content entity example entities')));
    $delete_permission = (($account->hasPermission("delete all content entity example revisions") || $account->hasPermission('administer content entity example entities')));

    $rows = [];

    $vids = $content_entity_example_storage->revisionIds($content_entity_example);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\content_d8_example\ContentEntityExampleInterface $revision */
      $revision = $content_entity_example_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $content_entity_example->getRevisionId()) {
          $link = $this->l($date, new Url('entity.content_entity_example.revision', ['content_entity_example' => $content_entity_example->id(), 'content_entity_example_revision' => $vid]));
        }
        else {
          $link = $content_entity_example->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->getRevisionLogMessage(), '#allowed_tags' => Xss::getHtmlTagList()],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.content_entity_example.translation_revert', ['content_entity_example' => $content_entity_example->id(), 'content_entity_example_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.content_entity_example.revision_revert', ['content_entity_example' => $content_entity_example->id(), 'content_entity_example_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.content_entity_example.revision_delete', ['content_entity_example' => $content_entity_example->id(), 'content_entity_example_revision' => $vid]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['content_entity_example_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
