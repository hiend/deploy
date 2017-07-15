<?php
/*
 * This file is part of the Deploy.
 *
 * (c) Dmitry Averbakh <adm@ruhub.com>
 */

/**
 * Get application version from composer.json
 *
 * @param string $composer_json
 * @return string
 */
function getAppVersion($composer_json)
{
    if (file_exists($composer_json) and is_readable($composer_json)) {
        $json = json_decode(file_get_contents($composer_json), true);

        if (json_last_error() === JSON_ERROR_NONE and !empty($json['version'])) {
            return $json['version'];
        }
    }

    return 'unknown';
}
