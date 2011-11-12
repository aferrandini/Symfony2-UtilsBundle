# Symfony2-UtilsBundle - Slug Generator #

## Usage Slug Generator ##

This method returns a slug string from a string.

Get the service from the container and run the method you need:

In a controller get the instance and call the method you want:

    $slug = $this->get('ferrandini_utils.slugger')
        ->generate("I want to get the SLUG from this text");

From a command:

    $slug = $this->container->get('ferrandini_utils.slugger')
        ->generate("I want to get the SLUG from this text");

Also you can limit the slug length using the method setMaxLength.

To get a SLUG of 10 characters call the method setMaxLength and then call the generator:

    $slug = $this->get('ferrandini_utils.slugger')
        ->setMaxLength(10)
        ->generate("I want to get the SLUG from this text");

The default slug length is 50 characters, if you want to set a different default max length
please use the config parameter max_length in your ./app/config.yml like this:

    #./app/config/config.yml
    ferrandini_utils:
        slugger:
            enabled:      false
            max_length:   50