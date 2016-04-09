<?php

namespace Adoptify\Controllers;

use Adoptify\Entities\Post;
use Adoptify\Entities\User;
use Standard\Abstracts\ApiController;

class ImageApiController extends ApiController
{

    /**
     * @Inject
     * @var User
     */
    private $user;

    /**
     * This function processes an image, one by one. Even if multiple images
     * are selected, they are sent to this method one by one by Dropzone
     *
     * Only logged in users can upload images
     *
     * @auth-groups users
     */
    public function addImageToDraftPostAction()
    {
        

        $this->respond($_FILES['file']);
    }
}