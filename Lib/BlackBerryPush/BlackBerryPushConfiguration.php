<?php
/**
 * RequestPush class allows send PUSH request to the BlackBerry Push Servers.
 * 
 * @author Ariel Ferrandini Price
 *
 */
namespace Ferrandini\UtilsBundle\Lib\BlackBerryPush;

class BlackBerryPushConfiguration
{
    const PUSH_RESOURCE = "/mss/PD_pushRequest";

    protected $name       = null;
    protected $host       = null;
    protected $username   = null;
    protected $password   = null;
    protected $app_id     = null;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $app_id
     */
    public function __construct($name, $host, $username, $password, $app_id)
    {
        if(!$this->setName($name)) {
            throw new \InvalidArgumentException('The parameter "name" must be set');
        }
        
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
    }

    /**
     * Returns the URL to the Push Service
     *
     * @return string
     */
    public function getServiceUrl()
    {
        return $this->getHost() . BlackBerryPushConfiguration::PUSH_RESOURCE;
    }

    /**
     * Returns the Name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Sets the Name
     *
     * @param $name string
     */
    public function setName($name='') {
        if($name!='') {
            $this->name = $name;

            return true;
        }

        return false;
    }

    /**
     * Returns the Host
     *
     * @return string
     */
    public function getHost() {
        return $this->host;
    }

    /**
     * Sets the Host
     *
     * @param $host string
     */
    public function setHost($host='') {
        if($host!='') {
            $this->host = $host;

            return true;
        }

        return false;
    }

    /**
     * Sets the username
     *
     * @param $username string
     */
    public function setUsername($username='') {
        if($username!='') {
            $this->username = $username;

            return true;
        }

        return false;
    }

    /**
     * Returns the username
     *
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Sets the Password
     *
     * @param $password string
     */
    public function setPassword($password='') {
        if($password!='') {
            $this->password = $password;

            return true;
        }

        return false;
    }

    /**
     * Returns the password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Sets the AppID
     *
     * @param $app_id string
     */
    public function setAppId($app_id='') {
        if($app_id!='') {
            $this->app_id = $app_id;

            return true;
        }

        return false;
    }

    /**
     * Returns the AppId
     *
     * @return string
     */
    public function getAppId() {
        return $this->app_id;
    }
}
