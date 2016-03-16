<?php

namespace Adoptify\Controllers;

use Standard\Abstracts\Controller;

abstract class AdoptifyTwigController extends Controller
{
    /**
     * @Inject
     * @var \Twig_Environment
     */
    protected $twig;

//    public function __construct()
//    {
//
//    }
//
//    public function __get($name)
//    {
//        if ($name == 'twig') {
//
//        } else {
//            return $this->{$name};
//        }
//    }
//
//    public function __construct(\Twig_Environment $te, $siteConfig)
//    {
//        $te->setLoader(
//            new \Twig_Loader_Filesystem(
//                $siteConfig['root'].'/src/Adoptify/Views'
//            )
//        );
//        $this->twig = $te;
//    }
}