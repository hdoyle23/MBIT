<?php

/**
 * Helper class for TM BG Youtube module
 */
class ModTMBGYoutubeHelper
{

    public static function getContainer($params)
    {
        // Theme Layouts
        $themeLayout = $params->get('themeLayout');

        switch ($themeLayout) {
            case '0':
                $containerClass = 'container';
                break;

            case '1':
                $containerClass = 'container-fluid';
                break;

            default:
                $containerClass = 'container';
                break;
        }
        return $containerClass;
    }

    public static function getRow($params)
    {
        // Theme Layouts
        $themeLayout = $params->get('themeLayout');

        switch ($themeLayout) {
            case '0':
                $rowClass = 'row';
                break;

            case '1':
                $rowClass = 'row-fluid';
                break;

            default:
                $rowClass = 'row';
                break;
        }
        return $rowClass;
    }


    public static function getIdFromUrl($url)
    {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]
+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
            $url, $match)) {
            return $match[1];
        }
    }
}

