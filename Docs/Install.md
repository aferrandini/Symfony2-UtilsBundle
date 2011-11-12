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


## Enable each util ##

To enable the different utils you have to add the enable configuration in your ./app/config/config.yml

    #./app/config/config.yml
    ferrandini_utils:
        distance:
            enabled:      true
        slugger:
            enabled:      true
            max_length:   50
        slugger:
            enabled:    true
        blackberry_push:
            enabled:    true
            applications:
                default:
                    name:       default
                    host:       https://pushapi.eval.blackberry.com
                    username:   1450-xxxxxxxxxxxxxxxxxx
                    password:   12345678
                    app_id:     1450-xxxxxxxxxxxxxxxxxx


## Usage ##

For usage please read Docs folder or Wiki
