<?php

namespace Ferrandini\UtilsBundle\Lib\BlackBerryPush;

/**
 * 
 * RequestPush class allows send PUSH request to the BlackBerry Push Servers.
 * 
 * @author Ariel Ferrandini Price
 *
 */
class BlackBerryPushRequest {
    private const PUSH_RESOURCE = "/mss/PD_pushRequest";

    protected $host       = null;
    protected $username   = null;
    protected $password   = null;
    protected $app_id     = null;

    protected $boundary   = null;
    protected $devices    = null;
    protected $message    = null;

    protected $header     = null;
    protected $request    = null;
    protected $response   = null;

    /**
     * 
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $app_id
     */
    public function __construct($host, $username, $password, $app_id) {
        if(!$this->setHost($host)) {
            throw new \InvalidArgumentException('The parameter "host" must be set');
        }

        if(!$this->setUsername($username)) {
            throw new \InvalidArgumentException('The parameter "username" must be set');
        }

        if(!$this->setPassword($password)) {
            throw new \InvalidArgumentException('The parameter "password" must be set');
        }

        if($this->setAppId($app_id)) {
            throw new \InvalidArgumentException('The parameter "app_id" must be set');
        }

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
            $ch = curl_init($this->getUrl());
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_USERPWD, $this->getUser().':'.$this->getPassword());
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/related; type=\"application/xml\"; boundary="'.$this->getBoundary().'"' ));

            $postData = '
  --'.$this->getBoundary().'
  Content-Type: application/xml; charset=UTF-8
  <?xml version="1.0"?>
  <!DOCTYPE pap PUBLIC "-//WAPFORUM//DTD PAP 1.0//EN" "http://www.openmobilealliance.org/tech/DTD/pap_1.0.dtd">
  <pap>
      <push-message push-id="'.time().'" source-reference="'.$this->getServiceId().'" deliver-before-timestamp="'.date('Y-m-dTH:i:sZ', mktime(23,59,59,12,31,date('Y')+10)).'">
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

            curl_setopt ($ch, CURLOPT_POSTFIELDS, $postData);
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
     * Getters/Setters
     */
    public function getResponse() {
        return $this->response;
    }

    private function setResponse($response) {
        $this->response = $response;
    }

    public function getRequest() {
        return $this->request;
    }

    private function setRequest($resquest) {
        $this->request = $resquest;
    }

    private function generateBoundary() {
        $this->boundary = md5(
            microtime(true) . ':'
            . $this->getHost() . ':'
            . $this->getUsername() . ':'
            . getAppId()
        );
    }

    private function getBoundary() {
        return $this->boundary;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url='') {
        if($url!='') {
            $this->url = $url;

            return true;
        }

        return false;
    }

    public function setUser($user='') {
        if($user!='') {
            $this->user = $user;

            return true;
        }

        return false;
    }

    public function getUser() {
        return $this->user;
    }

    public function setPassword($password='') {
        if($password!='') {
            $this->password = $password;

            return true;
        }

        return false;
    }

    private function getPassword() {
        return $this->password;
    }

    public function setServiceId($service_id='') {
        if($service_id!='') {
            $this->service_id = $service_id;

            return true;
        }

        return false;
    }

    public function getServiceId() {
        return $this->service_id;
    }

    public function setDevices($devices=array()) {
        $this->devices = $devices;

        return true;
    }

    public function getDevices() {
        return $this->devices;
    }

    public function setMessage($message='') {
        $this->message = trim($message);

        return true;
    }

    public function getMessage() {
        return $this->message;
    }
}
