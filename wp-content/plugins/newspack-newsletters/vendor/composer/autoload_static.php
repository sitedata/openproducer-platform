<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita5a519b5faa4d4158e8565f41d676c0c
{
    public static $files = array (
        'ad155f8f1cf0d418fe49e248db8c661b' => __DIR__ . '/..' . '/react/promise/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'React\\Promise\\' => 14,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Stream\\' => 18,
            'GuzzleHttp\\Ring\\' => 16,
            'GuzzleHttp\\' => 11,
        ),
        'D' => 
        array (
            'DrewM\\MailChimp\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'React\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/promise/src',
        ),
        'GuzzleHttp\\Stream\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/streams/src',
        ),
        'GuzzleHttp\\Ring\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/ringphp/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'DrewM\\MailChimp\\' => 
        array (
            0 => __DIR__ . '/..' . '/drewm/mailchimp-api/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'Ctct' => 
            array (
                0 => __DIR__ . '/..' . '/constantcontact/constantcontact/src',
            ),
        ),
    );

    public static $classMap = array (
        'CS_REST_Administrators' => __DIR__ . '/..' . '/campaignmonitor/createsend-php/csrest_administrators.php',
        'CS_REST_Campaigns' => __DIR__ . '/..' . '/campaignmonitor/createsend-php/csrest_campaigns.php',
        'CS_REST_Clients' => __DIR__ . '/..' . '/campaignmonitor/createsend-php/csrest_clients.php',
        'CS_REST_Events' => __DIR__ . '/..' . '/campaignmonitor/createsend-php/csrest_events.php',
        'CS_REST_General' => __DIR__ . '/..' . '/campaignmonitor/createsend-php/csrest_general.php',
        'CS_REST_JourneyEmails' => __DIR__ . '/..' . '/campaignmonitor/createsend-php/csrest_journey_emails.php',
        'CS_REST_Journeys' => __DIR__ . '/..' . '/campaignmonitor/createsend-php/csrest_journeys.php',
        'CS_REST_Lists' => __DIR__ . '/..' . '/campaignmonitor/createsend-php/csrest_lists.php',
        'CS_REST_People' => __DIR__ . '/..' . '/campaignmonitor/createsend-php/csrest_people.php',
        'CS_REST_Segments' => __DIR__ . '/..' . '/campaignmonitor/createsend-php/csrest_segments.php',
        'CS_REST_Subscribers' => __DIR__ . '/..' . '/campaignmonitor/createsend-php/csrest_subscribers.php',
        'CS_REST_Templates' => __DIR__ . '/..' . '/campaignmonitor/createsend-php/csrest_templates.php',
        'CS_REST_Transactional_ClassicEmail' => __DIR__ . '/..' . '/campaignmonitor/createsend-php/csrest_transactional_classicemail.php',
        'CS_REST_Transactional_SmartEmail' => __DIR__ . '/..' . '/campaignmonitor/createsend-php/csrest_transactional_smartemail.php',
        'CS_REST_Transactional_Timeline' => __DIR__ . '/..' . '/campaignmonitor/createsend-php/csrest_transactional_timeline.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita5a519b5faa4d4158e8565f41d676c0c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita5a519b5faa4d4158e8565f41d676c0c::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInita5a519b5faa4d4158e8565f41d676c0c::$prefixesPsr0;
            $loader->classMap = ComposerStaticInita5a519b5faa4d4158e8565f41d676c0c::$classMap;

        }, null, ClassLoader::class);
    }
}
