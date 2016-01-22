<?php
namespace Craft;

class AjaxFormPlugin extends BasePlugin
{
    function getName()
    {
         return Craft::t('Ajax Form Handler');
    }

    function getVersion()
    {
        return '1.0';
    }

    function getDeveloper()
    {
        return 'Bowst';
    }

    function getDeveloperUrl()
    {
        return 'http://bowst.com';
    }
}