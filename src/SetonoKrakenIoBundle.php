<?php

declare(strict_types=1);

namespace Setono\KrakenIoBundle;

use Setono\KrakenIoBundle\DependencyInjection\Compiler\RegisterAliasesPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class SetonoKrakenIoBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new RegisterAliasesPass());
    }
}
