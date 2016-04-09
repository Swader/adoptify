<?php

namespace Adoptify\Controllers;

use Adoptify\Entities\Post;
use Adoptify\Entities\User;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class PostController extends AdoptifyTwigController
{
    /** @var Table */
    protected $postTable;

    /**
     * @Inject
     * @var User
     */
    protected $user;

    /**
     * @Inject("titleGenerator")
     */
    protected $titleGenerator;

    public function __construct()
    {
        $this->postTable = TableRegistry::get('post');
        $this->postTable->entityClass(Post::class);
    }

    /**
     *
     * @todo: separate view, edit and insert - user can now choose to continue on a draft, or to start a new one
     *
     * @param int|null $id
     */

    public function upsertPostView(int $id = null)
    {
        if (!$id) {

            // Check if user has drafts
            $post = $this->postTable
                ->find('all')
                ->where(['user_id =' => $this->user->id])
                ->andWhere('stage < 5')
                ->toArray();

            if (empty($post)) {
                // Create a blank post
                $post = $this->postTable->newEntity(
                    [
                        'title' => $this->titleGenerator->generate(),
                        'user_id' => $this->user->id,
                    ]
                );
                $post->newDates();
                $this->postTable->save($post);
            }
        } else {
            $post = $this->postTable->get($id);
            if ($post->user_id != $this->user->id) {
                $this->flasher->error(
                    'You cannot edit this post because you are not its owner.'
                );
                $this->redirect('/');
            }
        }

        $this->twig->display(
            'post/upsert.twig', [
            'post' => $post,
        ]
        );
    }
}