<?php

namespace Standard\Controllers;

use Twig_Environment;

class HomeController
{

    /**
     * @var Twig_Environment
     */
    private $twig;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Example of an invokable class, i.e. a class that has an __invoke() method.
     *
     * @see http://php.net/manual/en/language.oop5.magic.php#object.invoke
     */
    public function __invoke()
    {
        $message = 'Hello from Home, invoked';

        echo $this->twig->render('home.twig', [
            'message' => $message,
        ]);
    }

    public function about()
    {
        echo $this->twig->render('pages/about.twig');
    }
}
