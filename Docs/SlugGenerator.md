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

Also you can limit the slug length with a second parameter.

To get a SLUG of 10 characters call the method with a second integer parameter:

    $slug = $this->get('ferrandini_utils.slugger')
        ->generate("I want to get the SLUG from this text", 10);

