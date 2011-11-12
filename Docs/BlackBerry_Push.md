# Symfony2-UtilsBundle - BlackBerry Push #

## Usage BlackBerry Push ##

This util allows you to use the BlackBerry Push service to send PUSH messages.

First of all you have to get an AppId from BlackBerry to identify you application
and send PUSH messages to the devices.
To get an Evaluation Push Service go to the follow URL:

    * [BlackBerry Push Service Documentation and Registration](http://us.blackberry.com/developers/platform/pushapi.jsp)

And click the link "Register to evaluate the BlackBerry Push Service"

## Howto configure your applications ##

You have to enable the BlackBerry Push util and then configure the different applications.

    #./app/config/config.yml
    ferrandini_utils:
        blackberry_push:
            enabled:            true
            applications:
                default:
                    name:       default
                    host:       https://<blackberry push service host>
                    username:   <application user name>
                    password:   <application password>
                    app_id:     <application id>

                <name>:
                    name:       <name>
                    host:       https://<blackberry push service host>
                    username:   <application user name>
                    password:   <application password>
                    app_id:     <application id>


You can configure as much applications as you want.

If you configure a default named application it will be available without naming on the service call.

## Using the service ##

You can get the configuration or the request object directly using the DI.

To get the configuration use it like this:

    // To get the default configuration
    $bbp_configuration = $this->get('ferrandini_utils.blackberry_push.configuration');

    // To get a named configuration
    $bbp_configuration = $this->get('ferrandini_utils.blackberry_push.configuration.name');

To get the request object use it like this:

    // To get the default request
    $bbp_request = $this->get('ferrandini_utils.blackberry_push.request');

    // To get a named request
    $bbp_request = $this->get('ferrandini_utils.blackberry_push.request.name');

From a command use it like this:

    $bbp_request = $this->container->get('ferrandini_utils.blackberry_push.request');

Once you have the request service you can send a message like this:

    // The devices must be an array of BlackBerry Device PIN
    $devices = array(
        '2100000a',
        '11111111',
    );

    // The message must be a string for example a JSON
    $message = 'SEND THIS MESSAGE';

    // Call the sendRequest method
    $result = $bbp_request->sendRequest($devices, $message);

The sendRequest function will return a boolean, also you can get the Request and the Response XML like this:

    // Call the sendRequest method
    $result   = $bbp_request->sendRequest($devices, $message);
    $request  = $bbp_request->getRequest();
    $response = $bbp_request->getResponse();

If you have any doubt please use the issues or send me a message on github.