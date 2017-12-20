<?php
	
	/**
	 * Gluu-oxd-library
	 *
	 * An open source application library for PHP
	 *
	 *
	 * @copyright Copyright (c) 2017, Gluu Inc. (https://gluu.org/)
	 * @license	  MIT   License            : <http://opensource.org/licenses/MIT>
	 *
	 * @package	  Oxd Library by Gluu
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


	require_once 'Client_OXD_RP.php';


/**
 * Client Logout class
 *
 * @package		  Gluu-oxd-library
 * @subpackage	Libraries
 * @category	  Relying Party (RP) and User Managed Access (UMA)
 * @see	        Client_Socket_OXD_RP
 * @see	        Client_OXD_RP
 * @see	        Oxd_RP_config
 *
 * Class is connecting to oxd-server via socket, and doing logout from gluu-server.
 */
	class Logout extends Client_OXD_RP
	{
	    /**
	     * @var string $request_oxd_id                             Need to get after registration site in gluu-server
	     */
	    private $request_oxd_id = null;
	    /**
	     * @var string $request_id_token                           Need to get after registration site in gluu-server
	     */
	    private $request_id_token = null;
	    /**
	     * @var string $request_post_logout_redirect_uri           Need to get after registration site in gluu-server
	     */
	    private $request_post_logout_redirect_uri = null;
	    /**
	     * @var string $request_session_state                      Need to get after registration site in gluu-server
	     */
	    private $request_session_state = null;
	    /**
	     * @var string $request_state                              Need to get after registration site in gluu-server
	     */
	    private $request_state = null;
	    /**
	     * Response parameter from oxd-server
	     * Doing logout user from all sites
	     *
	     * @var string $response_claims
	     */
	    private $response_html;
            /**
	     * @var string $request_access_token     access token for each request
	     */
            private $request_protection_access_token;

        /**
         * getter for  request for protection_access_token
         *
         * @return string
         */
        function getRequest_protection_access_token() {
                return $this->request_protection_access_token;
            }

        /**
         *setter for  request for protection_access_token
         *
         * @param $request_protection_access_token
         */
        function setRequest_protection_access_token($request_protection_access_token) {
                $this->request_protection_access_token = $request_protection_access_token;
            }


        /**
         * Logout constructor.
         *
         * @param null oxdHttpConfig returned from oxdHttpConfig
         */
        public function __construct($oxdHttpConfig = null)
	    {
                if(is_array($oxdHttpConfig)){
                    Client_Socket_OXD_RP::setUrl(substr($oxdHttpConfig["host"], -1) !== '/'?$oxdHttpConfig["host"]."/".$oxdHttpConfig["get_logout_uri"]:$oxdHttpConfig["host"].$oxdHttpConfig["get_logout_uri"]);
                }
	        parent::__construct();
	    }


        /**
         * getter for current request state
         *
         * @return string
         */
        public function getRequestState()
	    {
	        return $this->request_state;
	    }


        /**
         * setter for current request state
         * @param $request_state
         */
        public function setRequestState($request_state)
	    {
	        $this->request_state = $request_state;
	    }

        /**
         * getter for current request state
         *
         * @return string
         */
	    public function getRequestSessionState()
	    {
	        return $this->request_session_state;
	    }
	
	    /**
         * setter   function
         *
	     * @param string $request_session_state
	     * @return	void
	     */
	    public function setRequestSessionState($request_session_state)
	    {
	        $this->request_session_state = $request_session_state;
	    }
	
	
	    /**
         * setter function
         *
	     * @param string $request_post_logout_redirect_uri
	     * @return	void
	     */
	    public function setRequestPostLogoutRedirectUri($request_post_logout_redirect_uri)
	    {
	        $this->request_post_logout_redirect_uri = $request_post_logout_redirect_uri;
	    }
	
	    /**
         * getter for response of getResponseData in HTML form
         *
	     * @return string
	     */
	    public function getResponseHtml()
	    {
	        $this->response_html = $this->getResponseData()->url;
	        return $this->response_html;
	    }
	
	    /**
         * getter function
	     * @return string
	     */
	    public function getRequestIdToken()
	    {
	        return $this->request_id_token;
	    }
	
	    /**
         * getter function
	     * @return string
	     */
	    public function getRequestPostLogoutRedirectUri()
	    {
	        return $this->request_post_logout_redirect_uri;
	    }
	
	    /**
         * setter for $request_id_token for Logout request
         *
	     * @param string $request_id_token
	     * @return	void
	     */
	    public function setRequestIdToken($request_id_token)
	    {
	        $this->request_id_token = $request_id_token;
	    }
	
	    /**
         * getter for OXd-ID for Logout request
         *
	     * @return string
	     */
	    public function getRequestOxdId()
	    {
	        return $this->request_oxd_id;
	    }
	
	    /**
         *
         * setter for $request_oxd_id for logout request
	     * @param string $request_oxd_id
	     * @return	void
	     */
	    public function setRequestOxdId($request_oxd_id)
	    {
	        $this->request_oxd_id = $request_oxd_id;
	    }
	    /**
	     * Protocol command to oxd server
	     * @return void
	     */
	    public function setCommand()
	    {
	        $this->command = 'get_logout_uri';
	    }
	    /**
	     * Protocol parameter to oxd server
	     * @return void
	     */
	    public function setParams()
	    {
	        $this->params = array(
	            "oxd_id" => $this->getRequestOxdId(),
	            "id_token_hint" => $this->getRequestIdToken(),
	            "post_logout_redirect_uri" => $this->getRequestPostLogoutRedirectUri(),
	            "state" => $this->getRequestState(),
	            "session_state" => $this->getRequestSessionState(),
	            "protection_access_token"=> $this->getRequest_protection_access_token()
	        );
	    }
	
	}
