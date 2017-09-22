<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Maximilian Berghoff <Maximilian.Berghoff@mayflower.de>
 */
class ArticleController extends Controller
{
    public function indexAction($articleName)
    {
        return $this->render('article/index.html.twig', ['name' => $articleName]);
    }
}
