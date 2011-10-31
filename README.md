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
