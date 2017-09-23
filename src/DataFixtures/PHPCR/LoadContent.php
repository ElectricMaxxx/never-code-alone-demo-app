<?php

namespace App\DataFixtures\PHPCR;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ODM\PHPCR\DocumentManager;
use PHPCR\Util\NodeHelper;
use Symfony\Cmf\Bundle\ContentBundle\Doctrine\Phpcr\StaticContent;
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

        $session = $manager->getPhpcrSession();

        NodeHelper::createPath($session, $contentPath);
        NodeHelper::createPath($session, $routingPath);

        $contentRootNode = $manager->find(null, $contentPath);
        $routeRootNode = $manager->find(null, $routingPath);

        $deRoute = new Route();
        $deRoute->setPosition($routeRootNode, 'de');
        $manager->persist($deRoute);

        $enRoute = new Route();
        $enRoute->setPosition($routeRootNode, 'en');
        $manager->persist($enRoute);

        $content = new StaticContent();
        $content->setParentDocument($contentRootNode);
        $content->setName('my-first-content');
        $manager->persist($content);

        $content->setTitle('My first content');
        $content->setBody('This is really my first content');
        $manager->bindTranslation($content, 'en');

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
