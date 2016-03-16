<?php

namespace Adoptify\Controllers;

class PostController extends AdoptifyTwigController
{
    public function upsertPostView(int $id = null)
    {
        $this->twig->display('post/upsert.twig');
    }
}