<?php
/**
 * Create by
 * User: aferrandini
 * Date: 31/10/11
 * Time: 12:26
 *
 */

namespace Ferrandini\UtilsBundle\Lib\Distance;
use Ferrandini\UtilsBundle\Lib\Distance\Coordinates;

class Distance {

    /**
     * @param Coordinates $A
     * @param Coordinates $B
     * @return float
     */
    public function fromAtoB(Coordinates $A, Coordinates $B)
    {
        $theta = $A->getLongitude() - $B->getLongitude();
        $dist  = round(sin(deg2rad($A->getLatitude())) * sin(deg2rad($B->getLatitude())) +  cos(deg2rad($A->getLatitude())) * cos(deg2rad($B->getLatitude())) * cos(deg2rad($theta)),15);
        $dist  = rad2deg(acos($dist)) * 60 * 1.1515 * 1.609344;

        return round($dist*1000, 4);
    }

    /**
     * @param Coordinates $A
     * @param Coordinates $center
     * @param int $radio
     * @return bool
     */
    public function isPointInsideTheCircle(Coordinates $A, Coordinates $center, $radio=0)
    {
        if($radio <= 0) {
            return false;
        }

        $distance = $this->fromAtoB($A, $center);

        if($distance <= $radio) {
            return true;
        } else {
            return false;
        }
    }
}
