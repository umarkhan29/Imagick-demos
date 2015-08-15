<?php

use Tier\InjectionParams;

// These classes will only be created once by the injector.
$shares = [
    'Jig\JigConfig',
    'ImagickDemo\AppTimer',
    'ImagickDemo\Config',
    'ImagickDemo\Control',
    'ImagickDemo\Example',
    'ImagickDemo\Navigation\Nav',
    'ImagickDemo\Queue\ImagickTaskQueue',
    'ImagickDemo\Helper\PageInfo',
    'ImagickDemo\Config\Application',
    'ImagickDemo\Config\Librato',
    'ImagickDemo\Framework\VariableMap',
    'Predis\Client',
    'ScriptServer\Service\ScriptInclude',
    'Tier\Path\AutogenPath',
    'Intahwebz\DataPath',
    'Intahwebz\StoragePath',
    'Tier\Path\CachePath',
    'Tier\Path\ExternalLibPath',
    'Tier\Path\YuiCompressorPath',
    'Tier\Path\WebRootPath',
];

$defines = [
    'Tier\Path\AutogenPath'       => [':path' => __DIR__."/../autogen/"],
    'Intahwebz\DataPath'          => [':path' => __DIR__."/../data/"],
    'Intahwebz\StoragePath'       => [':path' => __DIR__."/../var/"],
    'Tier\Path\CachePath'         => [':path' => __DIR__.'/../var/cache/'],
    'Tier\Path\ExternalLibPath'   => [':path' => __DIR__.'/../lib/'],
    'Tier\Path\WebRootPath'       => [':path' => __DIR__.'/../imagick/'],
    'Tier\Path\YuiCompressorPath' => ["/usr/lib/yuicompressor.jar"],
];


// Alias interfaces (or classes) to the actual types that should be used 
// where they are required. 
$aliases = [
    'Intahwebz\Request' => 'Intahwebz\Routing\HTTPRequest',
    'ImagickDemo\DocHelper' => 'ImagickDemo\DocHelperDisplay',
    'ImagickDemo\Framework\VariableMap' => 'ImagickDemo\Framework\RequestVariableMap',
    //$injector->alias('ImagickDemo\Banners\Banner', 'ImagickDemo\Banners\PHPStormBanner');
    'ImagickDemo\Banners\Banner' => 'ImagickDemo\Banners\NullBanner',
    'ImagickDemo\Navigation\Nav' => 'ImagickDemo\Navigation\NullNav',
    'FilePacker\FilePacker' => 'FilePacker\YuiFilePacker',
];


// Delegate the creation of types to callables.
$delegates = [
    'ImagickDemo\Control' => 'createControl',
    'ImagickDemo\Example' => 'createExample',
    'Intahwebz\Routing\HTTPRequest' => 'createHTTPRequest',
    'Predis\Client' => 'createRedisClient',
    'ImagickDemo\Config\Librato' => ['ImagickDemo\Config', 'createLibrato'],
    'Jig\JigConfig' => ['ImagickDemo\Config', 'createJigConfig'],
    'Tier\Caching\Caching' => ['ImagickDemo\Config', 'createCaching'],
    'ScriptServer\Value\ScriptVersion' => ['ImagickDemo\Config', 'createScriptVersion'],
    'Tier\Domain' => ['ImagickDemo\Config', 'createDomain'],
    'ScriptServer\Service\ScriptInclude' => ['ImagickDemo\Config', 'createScriptInclude'],
];

$params = [
];

$prepares = [
    'Jig\Converter\JigConverter' => 'prepareJigConverter',
    'Jig\Jig' => 'prepareJig',
];

$injectionParams = new InjectionParams(
    $shares,
    $aliases,
    $delegates,
    $params,
    $prepares,
    $defines
);

return $injectionParams;
