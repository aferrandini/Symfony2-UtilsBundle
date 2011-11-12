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
     * Max length
     */
    private $max_length;

    /**
     * Constructor method
     * Sets the slug max length property
     */
    public function __construct($max_length)
    {
        $this->setMaxLength($max_length);
    }

    public function setMaxLength($max_length)
    {
        if(is_numeric($max_length) && $max_length>0) {
            $this->max_length = $max_length;

        } else {
            throw new \InvalidArgumentException("The parameter 'max_length' must be a positive number");
        }
    }

    public function getMaxLength()
    {
        return $this->max_length;
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public function generate($url)
    {
        // Convert URL to lowercase
        $slug = strtolower($url);

        // Remove invalid characters
        $slug = preg_replace("/[^a-z0-9\s-]/", "", $slug);

        // Clear spaces and replace spaces+ with spaces
        $slug = trim(preg_replace("/\s+/", " ", $slug));

        // Control the slug length
        if(strlen($slug)>$this->getMaxLength()) {
            $slug = substr($slug, 0, $this->getMaxLength());
        }

        // Replace spaces with -
        $slug = preg_replace("/\s/", "-", $slug);

        return $slug;
    }

}
