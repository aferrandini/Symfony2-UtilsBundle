<?php
/**
 * 
 * RequestPush class allows send PUSH request to the BlackBerry Push Servers.
 * 
 * @author Ariel Ferrandini Price
 *
 */
namespace Ferrandini\UtilsBundle\Lib\BlackBerryPush;

use Ferrandini\UtilsBundle\Lib\BlackBerryPush\BlackBerryPushConfiguration;

class BlackBerryPushRequest {
    protected $config     = null;

    protected $boundary   = null;
    protected $devices    = null;
    protected $message    = null;

    protected $header     = null;
    protected $request    = null;
    protected $response   = null;

    /**
     * Constructor
     *
     * @param BlackBerryPushConfiguration $config
     */
    public function __construct(BlackberryPushConfiguration $config)
    {
        $this->config = $config;

        // Generate the Boundary for the POST Body
        $this->generateBoundary();
    }

    /**
     * 
     * Send the Request to the BlackBerry PUSH Servers
     */
    public function sendRequest($devices, $message) {
        $this->setDevices($devices);
        $this->setMessage($message);

        try {
            $ch = curl_init($this->config->getServiceUrl());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_USERPWD, $this->config->getUsername().':'.$this->config->getPassword());

            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/related; type=\"application/xml\"; boundary="'.$this->getBoundary().'"' ));

            $postData = '
  --'.$this->getBoundary().'
  Content-Type: application/xml; charset=UTF-8
  <?xml version="1.0"?>
  <!DOCTYPE pap PUBLIC "-//WAPFORUM//DTD PAP 1.0//EN" "http://www.openmobilealliance.org/tech/DTD/pap_1.0.dtd">
  <pap>
      <push-message push-id="'.time().'" source-reference="'.$this->config->getAppId().'" deliver-before-timestamp="'.date('Y-m-d\TH:i:s\Z', mktime(23,59,59,12,31,date('Y')+10)).'">
   ';

            if (is_array($this->getDevices())) {
                foreach ($this->getDevices() as $pin) {
                    // prevent to add two times the same PIN
                    if (!strpos($postData, $pin)) {
                        $postData .= '<address address-value="' . $pin . '"/>';
                    }
                }
            } elseif($this->getDevices()=="all") {
                $postData .= '<address address-value="push_all"/>';
            } else {
                $postData .= '<address address-value="' . $this->getDevices() . '"/>';
            }

            $postData .= '
          <quality-of-service delivery-method="confirmed"/>
      </push-message>
  </pap>
  --'.$this->getBoundary().'
  Content-Type: text/plain

'.$this->getMessage().'
  --'.$this->getBoundary().'--
  ';

            $this->request = $postData;

            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

            $this->setResponse(curl_exec($ch));
            $info = curl_getinfo($ch);
            curl_close ($ch);

            if ($this->getResponse() === false || $info['http_code'] != 200) {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Returns the XML for the Response Object
     *
     * @return string
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * Sets the response object as XML
     *
     * @param $response string
     */
    private function setResponse($response) {
        $this->response = $response;
    }

    /**
     * Returns the XML for the Request Object
     *
     * @return string
     */
    public function getRequest() {
        return $this->request;
    }

    /**
     * Sets the request object as XML
     *
     * @param $request string
     */
    private function setRequest($request) {
        $this->request = $request;
    }

    /**
     * Generates the Boundary POST Body using the
     * host, username and app_id fields
     */
    private function generateBoundary() {
        $this->boundary = md5(
            microtime(true) . ':'
            . $this->config->getHost() . ':'
            . $this->config->getUsername() . ':'
            . $this->config->getAppId()
        );
    }

    /**
     * Returns the Boundary POST Body
     *
     * @return string
     */
    private function getBoundary() {
        return $this->boundary;
    }

   /**
     * Sets the Devices
     *
     * @param $devices mixed
     */
    public function setDevices($devices) {
        $this->devices = $devices;
    }

    /**
     * Returns the Devices
     *
     * @return mixed
     */
    public function getDevices() {
        return $this->devices;
    }

    /**
     * Sets the Message
     *
     * @param $message string
     */
    public function setMessage($message='') {
        $this->message = trim($message);
    }

    /**
     * Returns the Message
     *
     * @return string
     */
    public function getMessage() {
        return $this->message;
    }
}
