<?php
/**
 * Create by
 * User: aferrandini
 * Date: 07/11/11
 * Time: 12:33
 *
 */

namespace Ferrandini\UtilsBundle\Lib\SlugGenerator;

class SlugGenerator {

    /**
     * @param string $url
     * @param int $length
     *
     * @return string
     */
    public function generate($url, $length=50)
    {
        $slug = strtolower($url);
        $slug = preg_replace("/[^a-z0-9\s-]/", "", $slug);
        $slug = trim(preg_replace("/\s+/", " ", $slug));
        $slug = trim(substr($slug, 0, $length));
        $slug = preg_replace("/\s/", "-", $slug);

        return $slug;
    }

}
