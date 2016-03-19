<?php

namespace Adoptify\Controllers;

use Standard\Abstracts\ApiController;

class ImageApiController extends ApiController
{
    public function imageProcess()
    {
        $this->respond($_FILES['file']);
    }
}