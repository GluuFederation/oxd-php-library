<?php
/**
 * Created Vlad Karapetyan
 */

require_once 'Client_OXD.php';

class Register_site extends Client_oxd
{
    /**start parameter for request!**/
        private $request_authorization_redirect_uri = null;
        private $request_logout_redirect_uri = null;
        private $request_application_type = null;
        private $request_redirect_uris = null;
        private $request_acr_values = null;
        private $request_client_jwks_uri = null;
        private $request_client_token_endpoint_auth_method = null;
        private $request_client_request_uris = null;
        private $request_contacts = null;
    /**end request parameter**/

    /**start parameter for response!**/
        private $response_oxd_id;
    /**end response parameter**/

    public function __construct()
    {
        /**
         * request_access_token_status constructor.
         **/
        parent::__construct(); // TODO: Change the autogenerated stub
        $this->setRequestApplicationType();
    }

    /**
     * @return null
     */
    public function getRequestLogoutRedirectUri()
    {
        return $this->request_logout_redirect_uri;
    }

    /**
     * @param null $request_logout_redirect_uri
     */
    public function setRequestLogoutRedirectUri($request_logout_redirect_uri)
    {
        $this->request_logout_redirect_uri = $request_logout_redirect_uri;
    }

    /**
     * @return null
     */
    public function getRequestClientJwksUri()
    {
        return $this->request_client_jwks_uri;
    }

    /**
     * @param null $request_client_jwks_uri
     */
    public function setRequestClientJwksUri($request_client_jwks_uri)
    {
        $this->request_client_jwks_uri = $request_client_jwks_uri;
    }

    /**
     * @return null
     */
    public function getRequestClientTokenEndpointAuthMethod()
    {
        return $this->request_client_token_endpoint_auth_method;
    }

    /**
     * @param null $request_client_token_endpoint_auth_method
     */
    public function setRequestClientTokenEndpointAuthMethod($request_client_token_endpoint_auth_method)
    {
        $this->request_client_token_endpoint_auth_method = $request_client_token_endpoint_auth_method;
    }

    /**
     * @return null
     */
    public function getRequestClientRequestUris()
    {
        return $this->request_client_request_uris;
    }

    /**
     * @param null $request_client_request_uris
     */
    public function setRequestClientRequestUris($request_client_request_uris)
    {
        $this->request_client_request_uris = $request_client_request_uris;
    }

    /**
     * @return mixed
     */
    public function getRequestApplicationType()
    {
        return $this->request_application_type;
    }

    /**
     * @param mixed $request_application_type
     */
    public function setRequestApplicationType($request_application_type = 'web')
    {
        $this->request_application_type = $request_application_type;
    }

    /**
     * @return null
     */
    public function getRequestAuthorizationRedirectUri()
    {
        return $this->request_authorization_redirect_uri;
    }

    /**
     * @param null $request_authorization_redirect_uri
     */
    public function setRequestAuthorizationRedirectUri($request_authorization_redirect_uri)
    {
        $this->request_authorization_redirect_uri = $request_authorization_redirect_uri;
    }

    /**
     * @return null
     */
    public function getRequestRedirectUris()
    {
        return $this->request_redirect_uris;
    }

    /**
     * @param null $request_redirect_uris
     */
    public function setRequestRedirectUris($request_redirect_uris)
    {
        $this->request_redirect_uris = $request_redirect_uris;
    }

    /**
     * @return null
     */
    public function getRequestAcrValues()
    {
        return $this->request_acr_values;
    }

    /**
     * @param null $request_acr_values
     */
    public function setRequestAcrValues($request_acr_values = 'basic')
    {
        $this->request_acr_values = $request_acr_values;
    }

    /**
     * @return null
     */
    public function getRequestContacts()
    {
        return $this->request_contacts;
    }

    /**
     * @param null $request_contacts
     */
    public function setRequestContacts($request_contacts)
    {
        $this->request_contacts = $request_contacts;
    }

    /**
     * @return mixed
     */
    public function getResponseOxdId()
    {
        $this->response_oxd_id = $this->getResponseData()->oxd_id;
        return $this->response_oxd_id;
    }

    /**
     * @param mixed $response_oxd_id
     */
    public function setResponseOxdId($response_oxd_id)
    {
        $this->response_oxd_id = $response_oxd_id;
    }

    public function setCommand()
    {
        $this->command = 'register_site';
    }

    public function setParams()
    {
        $this->params = array(
            "authorization_redirect_uri" => $this->getRequestAuthorizationRedirectUri(),
            "logout_redirect_uri" => $this->getRequestLogoutRedirectUri(),
            "application_type" => $this->getRequestApplicationType(),
            "redirect_uris" => $this->getRequestRedirectUris(),
            "acr_values" => $this->getRequestAcrValues(),
            "client_jwks_uri" => $this->getRequestClientJwksUri(),
            "client_token_endpoint_auth_method" => $this->getRequestClientTokenEndpointAuthMethod(),
            "client_request_uris" => $this->getRequestClientRequestUris(),
            "contacts" => $this->getRequestContacts()
        );
    }

}