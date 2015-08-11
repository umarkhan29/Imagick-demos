<?php

namespace ImagickDemo;

use Auryn\Injector;
use Tier\Caching\Caching;
use Tier\Caching\CachingDisabled;
use Tier\Caching\CachingRevalidate;
use Tier\Caching\CachingTime;
use Tier\TierException;

class Config
{
    const FLICKR_KEY = 'flickr.key';
    const FLICKR_SECRET = 'flickr.secret';
    
    const GITHUB_ACCESS_TOKEN = 'github.access_token';
    const GITHUB_REPO_NAME = 'github.repo_name';
    
    //Server container
    const AWS_SERVICES_KEY = 'aws.services.key';
    const AWS_SERVICES_SECRET = 'aws.services.secret';

    const AMAZON_EC2_MACHINEIMAGENAME = 'amazon.ec2.machine_image_name';
    const AMAZON_EC2_INSTANCE_TYPE = 'amazon.ec2.instance_type';

    const AMAZON_EC2_VPC = 'amazon.ec2.vpc';
    const AMAZON_EC2_SECURITY_GROUP = 'amazon.ec2.security_group';
    const AMAZON_EC2_SSH_KEY_PAIR_NAME = 'amazon.ec2.ssh_key_pair_name';
    
    const LIBRATO_KEY = 'librato.key';
    const LIBRATO_USERNAME = 'librato.username';
    const LIBRATO_STATSSOURCENAME = 'librato.stats_source_name';
    
    const JIG_COMPILE_CHECK = 'jig.compilecheck';
    
    //const SITE_NAME = 'site.name';
    
    const DOMAIN_CANONICAL = 'domain.canonical';
    const DOMAIN_CDN_PATTERN= 'domain.cdn.pattern';
    const DOMAIN_CDN_TOTAL= 'domain.cdn.total';

    const CACHING_SETTING = 'caching.setting';

    public static function getConfigNames()
    {
        $reflClass = new \ReflectionClass(__CLASS__);

        return $reflClass->getConstants();
    }

    public static function getEnv($key)
    {
        $key = str_replace('.', "_", $key);
        $value = getenv($key);

        if ($value === null || $value === false) {
            throw new \Exception("Missing config of $key");
        }

        return $value;
    }

    public function createLibrato()
    {
        return\ImagickDemo\Config\Librato::make(
            self::getEnv(self::LIBRATO_KEY),
            self::getEnv(self::LIBRATO_USERNAME),
            self::getEnv(self::LIBRATO_STATSSOURCENAME)
        );
    }

    public function createJigConfig()
    {
        $jigConfig = new \Jig\JigConfig(
            "../templates/",
            "../var/compile/",
            'tpl',
            $this->getEnv(self::JIG_COMPILE_CHECK)
        );

        return $jigConfig;
    }
    
    public function createDomain()
    {
        return new \Tier\Domain(
            self::getEnv(self::DOMAIN_CANONICAL),
            self::getEnv(self::DOMAIN_CDN_PATTERN),
            self::getEnv(self::DOMAIN_CDN_TOTAL)
        );
    }

    public function createCaching()
    {
        $cacheSetting = self::getEnv(Config::CACHING_SETTING);
        switch ($cacheSetting) {
            case Caching::CACHING_DISABLED: {
                return new CachingDisabled();
                break;
            }
            case Caching::CACHING_REVALIDATE: {
                return new CachingRevalidate(3600 * 2, 3600);
                break;
            }
            case Caching::CACHING_TIME: {
                return new CachingTime(3600 * 10, 3600);
                break;
            }
            default: {
                throw new TierException("Unknown caching setting '$cacheSetting'.");
            }
        }
    }
}
