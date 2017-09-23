<?php

namespace App;

use App\DependencyInjection\Compiler\DocumentClassPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Maximilian Berghoff <Maximilian.Berghoff@mayflower.de>
 */
class AppBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new DocumentClassPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 100);
    }
}
