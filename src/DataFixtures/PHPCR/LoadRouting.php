<?php

namespace App\DataFixtures\PHPCR;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ODM\PHPCR\DocumentManager;
use PHPCR\Util\NodeHelper;
use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Phpcr\Route;

/**
 * @author Maximilian Berghoff <Maximilian.Berghoff@mayflower.de>
 */
class LoadRouting implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager|DocumentManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $routingPath = '/cms/routes';
        $session = $manager->getPhpcrSession();
        NodeHelper::createPath($session, $routingPath);

        $routeRootNode = $manager->find(null, $routingPath);

        $route = new Route();
        $route->setName('my-first-route');
        $route->setParentDocument($routeRootNode);
        $route->setDefaults(['_controller' => 'App\Controller\DynamicRoutingController:indexAction']);

        $manager->persist($route);
        $manager->flush();
    }
}
