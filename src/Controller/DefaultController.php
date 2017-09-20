<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Maximilian Berghoff <Maximilian.Berghoff@mayflower.de>
 */
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('default/index.html.twig', ['value' => 'my value']);
    }
}
