# Symfony2-UtilsBundle - Distance #

## Usage fromAtoB ##

This method returns the distance from A to B in meters

Get the service from the container and run the method you need:

In a controller get the instance and call the method you want:

    $meters_from_A_to_B = $this->get('ferrandini_utils.distance')
        ->fromAtoB(
            new Ferrandini\UtilsBundle\Lib\Distance\Coordinates($latitude_1, $longitude_1),
            new Ferrandini\UtilsBundle\Lib\Distance\Coordinates($latitude_2, $longitude_2)
        );

From a command:

    $meters_from_A_to_B = $this->container->get('ferrandini_utils.distance')
        ->fromAtoB(
            new Ferrandini\UtilsBundle\Lib\Distance\Coordinates($latitude_1, $longitude_1),
            new Ferrandini\UtilsBundle\Lib\Distance\Coordinates($latitude_2, $longitude_2)
        );

## Usage isPointInsideTheCircle ##

This method returns true or false if the point given is inside the circle create
by the center given and the radius

Get the service from the container and run the method you need:

In a controller get the instance and call the method you want:

    $isInside = $this->get('ferrandini_utils.distance')
        ->isPointInsideTheCircle(
            new Ferrandini\UtilsBundle\Lib\Distance\Coordinates($latitude, $longitude),
            new Ferrandini\UtilsBundle\Lib\Distance\Coordinates($center_latitude, $center_longitude),
            $radius
        );

From a command:

    $isInside = $this->container->get('ferrandini_utils.distance')
        ->isPointInsideTheCircle(
            new Ferrandini\UtilsBundle\Lib\Distance\Coordinates($latitude, $longitude),
            new Ferrandini\UtilsBundle\Lib\Distance\Coordinates($center_latitude, $center_longitude),
            $radius
        );
