<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Maximilian Berghoff <Maximilian.Berghoff@mayflower.de>
 */
class DynamicRoutingController extends Controller
{
    public function indexAction()
    {
        return $this->render('dynamic-routing/index.html.twig', []);
    }
}
