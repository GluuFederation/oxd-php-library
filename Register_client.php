<?php
require_once 'Client.php';
class Register_client extends Client
{
    /**start parameter for request!**/
    private $request_discoveryUrl = null;
    private $request_redirectUrl = null;
    private $request_logout_redirect_url = null;
    private $request_client_name = null;
    private $request_response_types = null;
    private $request_app_type = null;
    private $request_grant_types = null;
    private $request_contacts = null;
    private $request_jwks_uri = null;
    /**end request parameter**/

    /**start parameter for response!**/
    private $response_client_id;
    private $response_client_secret;
    private $response_registration_access_token;
    private $response_client_secret_expires_at;
    private $response_registration_client_uri;
    private $response_client_id_issued_at;
    /**end response parameter**/

    public function __construct()
    {
        /**
         * Register_client constructor.
         * @param $protacol='tcp', $ip='127.0.0.1', $port=8099
         **/
        parent::__construct(); // TODO: Change the autogenerated stub
    }

    /**
     * @return null
     */
    public function getRequestLogoutRedirectUrl()
    {
        return $this->request_logout_redirect_url;
    }

    /**
     * @param null $request_logout_redirect_url
     */
    public function setRequestLogoutRedirectUrl($request_logout_redirect_url)
    {
        $this->request_logout_redirect_url = $request_logout_redirect_url;
    }
    /**
     * @return mixed
     */
    public function getRequestDiscoveryUrl()
    {
        return $this->request_discoveryUrl;
    }

    /**
     * @param mixed $request_discoveryUrl
     */
    public function setRequestDiscoveryUrl($request_discoveryUrl)
    {
        $this->request_discoveryUrl = $request_discoveryUrl;
    }

    /**
     * @return mixed
     */
    public function getRequestRedirectUrl()
    {
        return $this->request_redirectUrl;
    }

    /**
     * @param mixed $request_redirectUrl
     */
    public function setRequestRedirectUrl($request_redirectUrl)
    {
        $this->request_redirectUrl = $request_redirectUrl;
    }

    /**
     * @return mixed
     */
    public function getRequestClientName()
    {
        return $this->request_client_name;
    }

    /**
     * @param mixed $request_client_name
     */
    public function setRequestClientName($request_client_name)
    {
        $this->request_client_name = $request_client_name;
    }

    /**
     * @return mixed
     */
    public function getRequestAppType()
    {
        return $this->request_app_type;
    }

    /**
     * @param mixed $request_app_type
     */
    public function setRequestAppType($request_app_type)
    {
        $this->request_app_type = $request_app_type;
    }

    /**
     * @return mixed
     */
    public function getRequestResponseTypes()
    {
        return $this->request_response_types;
    }

    /**
     * @param mixed $request_response_types
     */
    public function setRequestResponseTypes($request_response_types)
    {
        $this->request_response_types = $request_response_types;
    }

    /**
     * @return mixed
     */
    public function getRequestGrantTypes()
    {
        return $this->request_grant_types;
    }

    /**
     * @param mixed $request_grant_types
     */
    public function setRequestGrantTypes($request_grant_types)
    {
        $this->request_grant_types = $request_grant_types;
    }

    /**
     * @return mixed
     */
    public function getRequestContacts()
    {
        return $this->request_contacts;
    }

    /**
     * @param mixed $request_contacts
     */
    public function setRequestContacts($request_contacts)
    {
        $this->request_contacts = $request_contacts;
    }

    /**
     * @return mixed
     */
    public function getRequestJwksUri()
    {
        return $this->request_jwks_uri;
    }

    /**
     * @param mixed $request_jwks_uri
     */
    public function setRequestJwksUri($request_jwks_uri)
    {
        $this->request_jwks_uri = $request_jwks_uri;
    }

    /**
     * @return mixed
     */
    public function getResponseClientId()
    {
        $this->response_client_id = $this->getResponseData()->client_id;
        return $this->response_client_id;
    }

    /**
     * @return mixed
     */
    public function getResponseClientSecret()
    {
        $this->response_client_secret = $this->getResponseData()->client_secret;
        return $this->response_client_secret;
    }

    /**
     * @return mixed
     */
    public function getResponseRegistrationAccessToken()
    {
        $this->response_registration_access_token = $this->getResponseData()->registration_access_token;
        return $this->response_registration_access_token;
    }

    /**
     * @return mixed
     */
    public function getResponseClientSecretExpiresAt()
    {
        $this->response_client_secret_expires_at = $this->getResponseData()->client_secret_expires_at;
        return $this->response_client_secret_expires_at;
    }

    /**
     * @return mixed
     */
    public function getResponseRegistrationClientUri()
    {
        $this->response_registration_client_uri = $this->getResponseData()->registration_client_uri;
        return $this->response_registration_client_uri;
    }

    /**
     * @return mixed
     */
    public function getResponseClientIdIssuedAt()
    {
        $this->response_client_id_issued_at = $this->getResponseData()->client_id_issued_at;
        return $this->response_client_id_issued_at;
    }

    public function setCommand(){
          $this->command = 'register_client';
    }
    public function setParams()
    {
          $this->params =  array(
              "discovery_url"=>$this->getRequestDiscoveryUrl(),
              "redirect_url"=>$this->getRequestRedirectUrl(),
              "logout_redirect_url" => $this->getRequestLogoutRedirectUrl(),
              "client_name"=>$this->getRequestClientName(),
              "response_types"=>$this->getRequestResponseTypes(),
              "app_type"=>$this->getRequestAppType(),
              "grant_types"=>$this->getRequestGrantTypes(),
              "contacts"=>$this->getRequestContacts(),
              "jwks_uri"=>$this->getRequestJwksUri()
          );
    }

}

