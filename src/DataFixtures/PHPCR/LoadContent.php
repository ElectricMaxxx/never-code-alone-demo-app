<?php

namespace App\DataFixtures\PHPCR;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ODM\PHPCR\DocumentManager;
use PHPCR\Util\NodeHelper;
use Symfony\Cmf\Bundle\ContentBundle\Doctrine\Phpcr\StaticContent;
use Symfony\Cmf\Bundle\MenuBundle\Doctrine\Phpcr\Menu;
use Symfony\Cmf\Bundle\MenuBundle\Doctrine\Phpcr\MenuNode;
use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Phpcr\Route;

/**
 * @author Maximilian Berghoff <Maximilian.Berghoff@mayflower.de>
 */
class LoadContent implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager|DocumentManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $contentPath = '/cms/content';
        $routingPath = '/cms/routes';
        $menuPath = '/cms/menu';

        $session = $manager->getPhpcrSession();

        NodeHelper::createPath($session, $contentPath);
        NodeHelper::createPath($session, $routingPath);
        NodeHelper::createPath($session, $menuPath);

        $contentRootNode = $manager->find(null, $contentPath);
        $routeRootNode = $manager->find(null, $routingPath);
        $menuRootPath = $manager->find(null, $menuPath);

        $deRoute = new Route();
        $deRoute->setPosition($routeRootNode, 'de');
        $deRoute->setDefaults(['_controller' => 'App\Controller\DefaultController::indexAction']);
        $manager->persist($deRoute);

        $enRoute = new Route();
        $enRoute->setPosition($routeRootNode, 'en');
        $enRoute->setDefaults(['_controller' => 'App\Controller\DefaultController::indexAction']);
        $manager->persist($enRoute);

        $menu = new Menu();
        $menu->setPosition($menuRootPath, 'main');
        $manager->persist($menu);

        $menuHomeNode = new MenuNode();
        $menuHomeNode->setUri('/');
        $menuHomeNode->setParentDocument($menu);
        $menuHomeNode->setName('home');
        $manager->persist($menuHomeNode);
        $menuHomeNode->setLabel('Home');
        $manager->bindTranslation($menuHomeNode, 'en');
        $menuHomeNode->setLabel('Startseite');
        $manager->bindTranslation($menuHomeNode, 'de');

        $staticMenuNode = new MenuNode();
        $staticMenuNode->setUri('/article/test-static');
        $staticMenuNode->setPosition($menu, 'test-static');
        $manager->persist($staticMenuNode);
        $staticMenuNode->setLabel('Quasi Static');
        $manager->bindTranslation($staticMenuNode, 'en');
        $staticMenuNode->setLabel('Quasi Statik');
        $manager->bindTranslation($staticMenuNode, 'de');

        $content = new StaticContent();
        $content->setParentDocument($contentRootNode);
        $content->setName('my-first-content');
        $manager->persist($content);

        $content->setTitle('My first content');
        $content->setBody('This is really my first content');
        $manager->bindTranslation($content, 'en');

        $menuNode = new MenuNode();
        $menuNode->setName('my-first-content');
        $menuNode->setParentDocument($menu);
        $menuNode->setContent($content);
        $manager->persist($menuNode);
        $menuNode->setLabel('My First');
        $manager->bindTranslation($menuNode, 'en');
        $menuNode->setLabel('Mein Erster');
        $manager->bindTranslation($menuNode, 'de');

        $route = new Route();
        $route->setPosition($enRoute, 'my-first-route');
        $route->setContent($content);
        $manager->persist($route);

        $content->setTitle('Mein erster Inhalt');
        $content->setBody('Das ist wirklich mein erster Inhalt');
        $manager->bindTranslation($content, 'de');

        $route = new Route();
        $route->setPosition($deRoute, 'mein-erster-inhalt');
        $route->setContent($content);
        $manager->persist($route);

        $manager->flush();
    }
}
