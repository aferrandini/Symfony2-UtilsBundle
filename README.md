# Symfony2-UtilsBundle #

This Bundle includes some utils

## HOWTO Install ##

Add this lines to your deps file:

    [FerrandiniUtilsBundle]
        git=http://github.com/aferrandini/Symfony2-UtilsBundle.git
        target=/bundles/Ferrandini/UtilsBundle

Run ./bin/vendors install

Register the bundle namespace into 'autoload.php' file:

    $loader->registerNamespaces(array(
        ...
        'Ferrandini'       => __DIR__.'/../vendor/bundles',
        ...
    ));

Add the UtilsBundle to your application's kernel:

    public function registerBundles()
    {
        $bundles = array(
            ...
            new Ferrandini\UtilsBundle\FerrandiniUtilsBundle(),
            ...
        );
        ...
    }

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



