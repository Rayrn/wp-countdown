<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitac2a0de43bee6d4e4c11896706dc4329
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Rayrn\\WP\\Countdown\\' => 19,
        ),
        'P' => 
        array (
            'Psr\\Container\\' => 14,
        ),
        'L' => 
        array (
            'League\\Container\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Rayrn\\WP\\Countdown\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'League\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/container/src',
        ),
    );

    public static $classMap = array (
        'League\\Container\\Argument\\ArgumentResolverInterface' => __DIR__ . '/..' . '/league/container/src/Argument/ArgumentResolverInterface.php',
        'League\\Container\\Argument\\ArgumentResolverTrait' => __DIR__ . '/..' . '/league/container/src/Argument/ArgumentResolverTrait.php',
        'League\\Container\\Argument\\ClassName' => __DIR__ . '/..' . '/league/container/src/Argument/ClassName.php',
        'League\\Container\\Argument\\ClassNameInterface' => __DIR__ . '/..' . '/league/container/src/Argument/ClassNameInterface.php',
        'League\\Container\\Argument\\RawArgument' => __DIR__ . '/..' . '/league/container/src/Argument/RawArgument.php',
        'League\\Container\\Argument\\RawArgumentInterface' => __DIR__ . '/..' . '/league/container/src/Argument/RawArgumentInterface.php',
        'League\\Container\\Container' => __DIR__ . '/..' . '/league/container/src/Container.php',
        'League\\Container\\ContainerAwareInterface' => __DIR__ . '/..' . '/league/container/src/ContainerAwareInterface.php',
        'League\\Container\\ContainerAwareTrait' => __DIR__ . '/..' . '/league/container/src/ContainerAwareTrait.php',
        'League\\Container\\Definition\\Definition' => __DIR__ . '/..' . '/league/container/src/Definition/Definition.php',
        'League\\Container\\Definition\\DefinitionAggregate' => __DIR__ . '/..' . '/league/container/src/Definition/DefinitionAggregate.php',
        'League\\Container\\Definition\\DefinitionAggregateInterface' => __DIR__ . '/..' . '/league/container/src/Definition/DefinitionAggregateInterface.php',
        'League\\Container\\Definition\\DefinitionInterface' => __DIR__ . '/..' . '/league/container/src/Definition/DefinitionInterface.php',
        'League\\Container\\Exception\\ContainerException' => __DIR__ . '/..' . '/league/container/src/Exception/ContainerException.php',
        'League\\Container\\Exception\\NotFoundException' => __DIR__ . '/..' . '/league/container/src/Exception/NotFoundException.php',
        'League\\Container\\Inflector\\Inflector' => __DIR__ . '/..' . '/league/container/src/Inflector/Inflector.php',
        'League\\Container\\Inflector\\InflectorAggregate' => __DIR__ . '/..' . '/league/container/src/Inflector/InflectorAggregate.php',
        'League\\Container\\Inflector\\InflectorAggregateInterface' => __DIR__ . '/..' . '/league/container/src/Inflector/InflectorAggregateInterface.php',
        'League\\Container\\Inflector\\InflectorInterface' => __DIR__ . '/..' . '/league/container/src/Inflector/InflectorInterface.php',
        'League\\Container\\ReflectionContainer' => __DIR__ . '/..' . '/league/container/src/ReflectionContainer.php',
        'League\\Container\\ServiceProvider\\AbstractServiceProvider' => __DIR__ . '/..' . '/league/container/src/ServiceProvider/AbstractServiceProvider.php',
        'League\\Container\\ServiceProvider\\BootableServiceProviderInterface' => __DIR__ . '/..' . '/league/container/src/ServiceProvider/BootableServiceProviderInterface.php',
        'League\\Container\\ServiceProvider\\ServiceProviderAggregate' => __DIR__ . '/..' . '/league/container/src/ServiceProvider/ServiceProviderAggregate.php',
        'League\\Container\\ServiceProvider\\ServiceProviderAggregateInterface' => __DIR__ . '/..' . '/league/container/src/ServiceProvider/ServiceProviderAggregateInterface.php',
        'League\\Container\\ServiceProvider\\ServiceProviderInterface' => __DIR__ . '/..' . '/league/container/src/ServiceProvider/ServiceProviderInterface.php',
        'Psr\\Container\\ContainerExceptionInterface' => __DIR__ . '/..' . '/psr/container/src/ContainerExceptionInterface.php',
        'Psr\\Container\\ContainerInterface' => __DIR__ . '/..' . '/psr/container/src/ContainerInterface.php',
        'Psr\\Container\\NotFoundExceptionInterface' => __DIR__ . '/..' . '/psr/container/src/NotFoundExceptionInterface.php',
        'Rayrn\\WP\\Countdown\\Action\\ActionAbstract' => __DIR__ . '/../..' . '/src/Action/ActionAbstract.php',
        'Rayrn\\WP\\Countdown\\Action\\RegisterScripts' => __DIR__ . '/../..' . '/src/Action/RegisterScripts.php',
        'Rayrn\\WP\\Countdown\\Action\\RegisterStyles' => __DIR__ . '/../..' . '/src/Action/RegisterStyles.php',
        'Rayrn\\WP\\Countdown\\CountdownPlugin' => __DIR__ . '/../..' . '/src/CountdownPlugin.php',
        'Rayrn\\WP\\Countdown\\Shortcode\\Countdown' => __DIR__ . '/../..' . '/src/Shortcode/Countdown.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitac2a0de43bee6d4e4c11896706dc4329::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitac2a0de43bee6d4e4c11896706dc4329::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitac2a0de43bee6d4e4c11896706dc4329::$classMap;

        }, null, ClassLoader::class);
    }
}
