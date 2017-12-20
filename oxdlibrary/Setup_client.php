<?php

/**
 * Gluu-oxd-library
 *
 * An open source application library for PHP
 *
 *
 * @copyright Copyright (c) 2017, Gluu Inc. (https://gluu.org/)
 * @license      MIT   License            : <http://opensource.org/licenses/MIT>
 *
 * @package      Oxd Library by Gluu
 * @category  Library, Api
 * @version   3.0.1
 *
 * @author    Gluu Inc.          : <https://gluu.org>
 * @link      Oxd site           : <https://oxd.gluu.org>
 * @link      Documentation      : <https://gluu.org/docs/oxd/3.0.1/libraries/php/>
 * @director  Mike Schwartz      : <mike@gluu.org>
 * @support   Support email      : <support@gluu.org>
 * @developer Volodya Karapetyan : <https://github.com/karapetyan88> <mr.karapetyan88@gmail.com>
 *
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2017, Gluu inc, USA, Austin
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 */

require_once 'Client_Socket_OXD_RP.php';
require_once 'Client_OXD_RP.php';

/**
 * Client Setup_client class
 *
 * Class is connecting to oxd-server via socket, and registering site in gluu server.
 *
 * @package          Gluu-oxd-library
 * @subpackage    Libraries
 * @category      Relying Party (RP) and User Managed Access (UMA)
 * @see            Client_Socket_OXD_RP
 * @see            Client_OXD_RP
 * @see            Oxd_RP_config
 */

class Setup_client extends Client_OXD_RP
{
    /**
     * request_op_host
     * @var string $request_op_host Gluu server url
     */
    private $request_op_host = null;
    /**
     * request_authorization_redirect_uri
     * @var string $request_authorization_redirect_uri Site authorization redirect uri
     */
    private $request_authorization_redirect_uri = null;
    /**
     * request_client_id
     * @var string $request_client_id OpenID provider client id
     */
    private $request_client_id = null;
    /**
     * request_client_name
     * @var string $request_client_name OpenID provider client name
     */
    private $request_client_name = null;
    /**
     * request_authorization_redirect_uri
     * @var string $request_authorization_redirect_uri OpenID provider client secret
     */
    private $request_client_secret = null;
    /**
     * request_post_logout_redirect_uri
     * @var string $request_post_logout_redirect_uri Site logout redirect uri
     */
    private $request_post_logout_redirect_uri = null;
    /**
     * request_application_type
     * @var string $request_application_type web or mobile
     */
    private $request_application_type = 'web';
    /**
     * request_acr_values
     * @var array $request_acr_values Gluu login acr type, can be basic, duo, u2f, gplus and etc.
     */
    private $request_acr_values = array();
    /**
     * request_client_jwks_uri
     * @var string $request_client_jwks_uri
     */
    private $request_client_jwks_uri = '';
    /**
     * request_client_jwks_uri
     * @var string $request_client_token_endpoint_auth_method
     */
    private $request_client_token_endpoint_auth_method = '';
    /**
     * request_client_sector_identifier_uri
     * @var array $request_client_sector_identifier_uri
     */
    private $request_client_sector_identifier_uri = '';
    /**
     * $request_client_request_uris
     * @var array $request_client_request_uris
     */
    private $request_client_request_uris = null;
    /**
     * request_contacts
     * @var array $request_contacts
     */
    private $request_contacts = null;
    /**
     * request_scope
     * @var array $request_scope For getting needed scopes from gluu-server
     */
    private $request_scope = array();
    /**
     * request_grant_types
     * @var array $request_grant_types OpenID Token Request type
     */
    private $request_grant_types = array();
    /**
     * request_response_types
     * @var array $request_response_types OpenID Authentication response types
     */
    private $request_response_types = array();
    /**
     * request_client_logout_uris
     * @var array $request_client_logout_uris
     */
    private $request_client_logout_uris = null;
    /**
     * request_ui_locales
     * @var array $request_ui_locales
     */
    private $request_ui_locales = null;
    /**
     * request_claims_locales
     * @var array $request_claims_locales
     */
    private $request_claims_locales = null;
    /**
     * Response parameter from oxd-server
     * It is basic parameter for other protocols
     *
     * @var string $response_oxd_id
     */
    private $response_oxd_id;

    /**
     * Response parameter from oxd-server
     *
     * @var string $response_op_host
     */
    private $response_op_host;

    /**
     * Response parameter from oxd-server
     *
     * @var string $response_client_id
     */
    private $response_client_id;

    /**
     * Response parameter from oxd-server
     *
     * @var string $response_client_secret
     */
    private $response_client_secret;


    /**
     * Setup_client constructor.
     * @param null $config
     */
    public function __construct($config = null)
    {
        if (is_array($config)) {
            Client_Socket_OXD_RP::setUrl(substr($config["host"], -1) !== '/' ? $config["host"] . "/" . $config["setup_client"] : $config["host"] . $config["setup_client"]);
        }
        parent::__construct(); // TODO: Change the autogenerated stub
        $this->setRequestApplicationType();
    }

    /**
     * getRequestClientName
     * @return string
     */
    public function getRequestClientName()
    {
        return $this->request_client_name;
    }

    /**
     * setRequestClientName
     * @param string $request_client_name
     */
    public function setRequestClientName($request_client_name)
    {
        $this->request_client_name = $request_client_name;
    }

    /**
     * getRequestClientSecret
     * @return string
     */
    public function getRequestClientSecret()
    {
        return $this->request_client_secret;
    }

    /**
     * setRequestClientSecret
     * @param string $request_client_secret
     */
    public function setRequestClientSecret($request_client_secret)
    {
        $this->request_client_secret = $request_client_secret;
    }

    /**
     * getRequestClientId
     * @return string
     */
    public function getRequestClientId()
    {
        return $this->request_client_id;
    }

    /**
     * setRequestClientId
     * @param string $request_client_id
     */
    public function setRequestClientId($request_client_id)
    {
        $this->request_client_id = $request_client_id;
    }

    /**
     * getRequestOpHost
     * @return string
     */
    public function getRequestOpHost()
    {
        return $this->request_op_host;
    }

    /**
     * setRequestOpHost
     * @param string $request_op_host
     * @return void
     */
    public function setRequestOpHost($request_op_host)
    {
        $this->request_op_host = $request_op_host;
    }

    /**
     * getRequestClientLogoutUris
     * @return array
     */
    public function getRequestClientLogoutUris()
    {
        return $this->request_client_logout_uris;
    }

    /**
     * setRequestClientLogoutUris
     * @param array $request_client_logout_uris
     * @return void
     */
    public function setRequestClientLogoutUris($request_client_logout_uris)
    {
        $this->request_client_logout_uris = $request_client_logout_uris;
    }

    /**
     * getRequestResponseTypes
     * @return array
     */
    public function getRequestResponseTypes()
    {
        return $this->request_response_types;
    }

    /**
     * setRequestResponseTypes
     * @param array $request_response_types
     * @return void
     */
    public function setRequestResponseTypes($request_response_types)
    {
        $this->request_response_types = $request_response_types;
    }

    /**
     * getRequestGrantTypes
     * @return array
     */
    public function getRequestGrantTypes()
    {
        return $this->request_grant_types;
    }

    /**
     * setRequestGrantTypes
     * @param array $request_grant_types
     * @return void
     */
    public function setRequestGrantTypes($request_grant_types)
    {
        $this->request_grant_types = $request_grant_types;
    }

    /**
     * getRequestScope
     * @return array
     */
    public function getRequestScope()
    {
        return $this->request_scope;
    }

    /**
     * setRequestScope
     * @param array $request_scope
     * @return void
     */
    public function setRequestScope($request_scope)
    {
        $this->request_scope = $request_scope;
    }

    /**
     * getRequestPostLogoutRedirectUri
     * @return string
     */
    public function getRequestPostLogoutRedirectUri()
    {
        return $this->request_post_logout_redirect_uri;
    }

    /**
     * setRequestPostLogoutRedirectUri
     * @param string $request_post_logout_redirect_uri
     * @return void
     */
    public function setRequestPostLogoutRedirectUri($request_post_logout_redirect_uri)
    {
        $this->request_post_logout_redirect_uri = $request_post_logout_redirect_uri;
    }

    /**
     * getRequestClientJwksUri
     * @return string
     */
    public function getRequestClientJwksUri()
    {
        return $this->request_client_jwks_uri;
    }

    /**
     * setRequestClientJwksUri
     * @param string $request_client_jwks_uri
     * @return void
     */
    public function setRequestClientJwksUri($request_client_jwks_uri)
    {
        $this->request_client_jwks_uri = $request_client_jwks_uri;
    }

    /**
     * getRequestClientSectorIdentifierUri
     * @return array
     */
    public function getRequestClientSectorIdentifierUri()
    {
        return $this->request_client_sector_identifier_uri;
    }

    /**
     * setRequestClientSectorIdentifierUri
     * @param array $request_client_sector_identifier_uri
     */
    public function setRequestClientSectorIdentifierUri($request_client_sector_identifier_uri)
    {
        $this->request_client_sector_identifier_uri = $request_client_sector_identifier_uri;
    }

    /**
     * getRequestClientTokenEndpointAuthMethod
     * @return string
     */
    public function getRequestClientTokenEndpointAuthMethod()
    {
        return $this->request_client_token_endpoint_auth_method;
    }

    /**
     * setRequestClientTokenEndpointAuthMethod
     * @param string $request_client_token_endpoint_auth_method
     * @return void
     */
    public function setRequestClientTokenEndpointAuthMethod($request_client_token_endpoint_auth_method)
    {
        $this->request_client_token_endpoint_auth_method = $request_client_token_endpoint_auth_method;
    }

    /**
     * getRequestClientRequestUris
     * @return array
     */
    public function getRequestClientRequestUris()
    {
        return $this->request_client_request_uris;
    }

    /**
     * setRequestClientRequestUris
     * @param array $request_client_request_uris
     * @return void
     */
    public function setRequestClientRequestUris($request_client_request_uris)
    {
        $this->request_client_request_uris = $request_client_request_uris;
    }

    /**
     * getRequestApplicationType
     * @return string
     */
    public function getRequestApplicationType()
    {
        return $this->request_application_type;
    }

    /**
     * setRequestApplicationType
     * @param string $request_application_type
     * @return void
     */
    public function setRequestApplicationType($request_application_type = 'web')
    {
        $this->request_application_type = $request_application_type;
    }

    /**
     * getRequestAuthorizationRedirectUri
     * @return string
     */
    public function getRequestAuthorizationRedirectUri()
    {
        return $this->request_authorization_redirect_uri;
    }

    /**
     * setRequestAuthorizationRedirectUri
     * @param string $request_authorization_redirect_uri
     * @return void
     */
    public function setRequestAuthorizationRedirectUri($request_authorization_redirect_uri)
    {
        $this->request_authorization_redirect_uri = $request_authorization_redirect_uri;
    }

    /**
     * getRequestAcrValues
     * @return array
     */
    public function getRequestAcrValues()
    {
        return $this->request_acr_values;
    }

    /**
     * setRequestAcrValues
     * @param array $request_acr_values
     * @return void
     */
    public function setRequestAcrValues($request_acr_values = 'basic')
    {
        $this->request_acr_values = $request_acr_values;
    }

    /**
     * getRequestContacts
     * @return array
     */
    public function getRequestContacts()
    {
        return $this->request_contacts;
    }

    /**
     * setRequestContacts
     * @param array $request_contacts
     * @return void
     */
    public function setRequestContacts($request_contacts)
    {
        $this->request_contacts = $request_contacts;
    }

    /**
     * getResponseOxdId
     * @return string
     */
    public function getResponseOxdId()
    {
        $this->response_oxd_id = $this->getResponseData()->oxd_id;
        return $this->response_oxd_id;
    }

    /**
     * getResponseOpHost
     * @return string
     */
    public function getResponseOpHost()
    {
        $this->response_op_host = $this->getResponseData()->op_host;
        return $this->response_op_host;
    }

    /**
     * getRequestUiLocales
     * @return array
     */
    public function getRequestUiLocales()
    {
        return $this->request_ui_locales;
    }

    /**
     * setRequestUiLocales
     * @param array $request_ui_locales
     */
    public function setRequestUiLocales($request_ui_locales)
    {
        $this->request_ui_locales = $request_ui_locales;
    }

    /**
     * getRequestClaimsLocales
     * @return array
     */
    public function getRequestClaimsLocales()
    {
        return $this->request_claims_locales;
    }

    /**
     * setRequestClaimsLocales
     * @param array $request_claims_locales
     */
    public function setRequestClaimsLocales($request_claims_locales)
    {
        $this->request_claims_locales = $request_claims_locales;
    }

    /**
     * Protocol command to oxd server
     * @return void
     */
    public function setCommand()
    {
        $this->command = 'setup_client';
    }

    /**
     * getResponse_client_id
     * @return string
     */
    function getResponse_client_id()
    {
        return $this->response_client_id;
    }

    /**
     * setResponse_client_id
     * @param $response_client_id
     */
    function setResponse_client_id($response_client_id)
    {
        $this->response_client_id = $response_client_id;
    }

    /**
     * getResponse_client_secret
     * @return string
     */
    function getResponse_client_secret()
    {
        return $this->response_client_secret;
    }

    /**
     * setResponse_client_secret
     * @param $response_client_secret
     */
    function setResponse_client_secret($response_client_secret)
    {
        $this->response_client_secret = $response_client_secret;
    }

    /**
     * Protocol parameter to oxd server
     * @return void
     */
    public function setParams()
    {
        $this->params = array(
            "authorization_redirect_uri" => $this->getRequestAuthorizationRedirectUri(),
            "op_host" => $this->getRequestOpHost(),
            "post_logout_redirect_uri" => $this->getRequestPostLogoutRedirectUri(),
            "application_type" => $this->getRequestApplicationType(),
            "response_types" => $this->getRequestResponseTypes(),
            "grant_types" => $this->getRequestGrantTypes(),
            "scope" => $this->getRequestScope(),
            "acr_values" => $this->getRequestAcrValues(),
            "client_name" => $this->getRequestClientName(),
            "client_jwks_uri" => $this->getRequestClientJwksUri(),
            "client_token_endpoint_auth_method" => $this->getRequestClientTokenEndpointAuthMethod(),
            "client_request_uris" => $this->getRequestClientRequestUris(),
            "client_sector_identifier_uri" => $this->getRequestClientSectorIdentifierUri(),
            "contacts" => $this->getRequestContacts(),
            "ui_locales" => $this->getRequestUiLocales(),
            "claims_locales" => $this->getRequestClaimsLocales(),
            "client_id" => $this->getRequestClientId(),
            "client_secret" => $this->getRequestClientSecret(),
            "client_frontchannel_logout_uris" => $this->getRequestClientLogoutUris(),
            "claims_redirect_uri" => $this->getRequestClaimsRedirectUri(),
            "oxd_rp_programming_language" => 'php'
        );
    }

    /**
     * request_claims_redirect_uris
     * @return void
     */
    private $request_claims_redirect_uris;

    /**
     * getRequestClaimsRedirectUri
     * @return request_claims_redirect_uris
     */
    public function getRequestClaimsRedirectUri()
    {
        return $this->request_claims_redirect_uris;
    }

    /**
     * setRequestClaimsRedirectUri
     * @param $request_claims_redirect_uris
     */
    public function setRequestClaimsRedirectUri($request_claims_redirect_uris)
    {
        $this->request_claims_redirect_uris = $request_claims_redirect_uris;
    }

    /**
     * send function sends the command to the oxd server.
     *
     * Args:
     * command (dict) - Dict representation of the JSON command string
     * @return    void
     **/
    public function request()
    {
        $this->setParams();

        $jsondata = json_encode($this->getData(), JSON_UNESCAPED_SLASHES);

        if (!$this->is_JSON($jsondata)) {
            $this->log("Sending parameters must be JSON.", 'Exiting process.');
            $this->error_message('Sending parameters must be JSON.');
        }
        $lenght = strlen($jsondata);
        if ($lenght <= 0) {
            $this->log("Length must be more than zero.", 'Exiting process.');
            $this->error_message("Length must be more than zero.");
        } else {
            $lenght = $lenght <= 999 ? "0" . $lenght : $lenght;
        }

        if (Client_Socket_OXD_RP::getUrl() != null) {
            $this->getData()["params"];
            $this->response_json = $this->oxd_http_request(Client_Socket_OXD_RP::getUrl(), $this->getData()["params"]);
        } else {
            $this->response_json = $this->oxd_socket_request(utf8_encode($lenght . $jsondata));
            $this->response_json = str_replace(substr($this->response_json, 0, 4), "", $this->response_json);
        }
        if ($this->response_json) {
            $object = json_decode($this->response_json);
            if ($object->status == 'error') {
                $this->error_message($object->data->error . ' : ' . $object->data->error_description);
            } elseif ($object->status == 'ok') {
                $this->response_object = json_decode($this->response_json);
                $this->response_client_id = $this->response_object->data->client_id;
                $this->response_client_secret = $this->response_object->data->client_secret;
            }
        } else {
            $this->log("Response is empty...", 'Exiting process.');
            $this->error_message('Response is empty...');
        }
    }

}