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

        $content = new StaticContent();
        $content->setParentDocument($contentRootNode);
        $content->setName('my-first-content');
        $content->setTitle('My first content');
        $content->setBody('This is really my first content');
        $manager->persist($content);

        $route = new Route();
        $route->setPosition($routeRootNode, 'my-first-route');
        $route->setContent($content);
        $manager->persist($route);

        $manager->flush();
    }
}
