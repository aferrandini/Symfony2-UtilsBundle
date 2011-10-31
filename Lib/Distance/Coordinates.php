<?php
/**
 * Created by.
 * User: aferrandini
 * Date: 31/10/11
 * Time: 12:31
 * Description: 
 * 
 */
namespace Ferrandini\UtilsBundle\Lib\Distance;

class Coordinates {
    /**
     * @var float
     */
    private $latitude;
    
    /**
     * @var float
     */
    private $longitude;

    /**
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @param float $latitude
     * @return void
     */
    public function setLatitude(float $latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @param float $longitude
     * @return void
     */
    public function setLongitude(float $longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->getLatitude();
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->getLongitude();
    }
}
