<?php
    /*
     * Copyright 2013 Mobibase.
     *
     * http://www.mobibase.com
     *
     * Licensed under the Apache License, Version 2.0 (the "License"); you may
     * not use this file except in compliance with the License. You may obtain
     * a copy of the License at
     *
     *     http://www.apache.org/licenses/LICENSE-2.0
     *
     * Unless required by applicable law or agreed to in writing, software
     * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
     * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
     * License for the specific language governing permissions and limitations
     * under the License.
     */

    Class MobibaseVodClient {
        private $api_key = null;
        private $service_url = 'http://v2.vod.api.mobibase.com/';
        private $last_request = null;
        private $last_posted_data = null;
        private $last_response = null;
        private $ua = null;
        private $cdn = false;

        public function __construct($api_key = null) {
            $this->setApiKey($api_key);
            $this->setUserAgent($_SERVER['HTTP_USER_AGENT']);
        }

        public function setUserAgent($ua) {
            $this->ua = $ua;
        }

        public function getUserAgent() {
            return $this->ua;
        }

        public function setServiceUrl($url) {
            $this->service_url = $url;
        }

        public function getServiceUrl() {
            return $this->service_url;
        }

        public function enableCdn() {
            $this->cdn = true;
        }

        public function disableCdn() {
            $this->cdn = false;
        }

        public function getCdn() {
            return $this->cdn;
        }        

        public function getPackages($options = array()) {
            return $this->service('packages/', $options);
        }

        public function getPackage($id, $options = array()) {
            return $this->service('packages/' . $id, $options);
        }

        public function getVideos($options = array()) {
            return $this->service('videos/', $options);
        }

        public function getVideo($id, $ticket = null, $network = null, $ua = null) {
            if ($this->cdn === true) {
                return $this->getVideoCDN($id);
            }
            
            if ($ticket) {
                $params['ticket'] = $ticket;
            } else {
                $params = array();
            }

            if ($network) {
                $network = '/' . strtolower($network);
            
                if ($ua) {
                    $ua = '/' . base64_encode($ua);
                } else if ($this->ua) {
                    $ua = '/' . base64_encode($this->ua);
                }
            }

            return $this->service('videos/' . $id . $network . $ua, $params);

        }

        public function getVideoCDN($id) {
            return $this->service('videos/' . $id);
        }        


        public function createTicket($profile_id, $tracking_id = null) {
            $posted = array(
                'profile_id'  => $profile_id,
                'tracking_id' => $tracking_id
            );
            return $this->service('tickets/create/', null, $posted);
        }

        public function invalidateTicket($ticket) {
            $posted = array(
                'ticket' => $ticket
            );
            return $this->service('tickets/invalidate/', null, $posted);
        }

        public function isTicketValid($ticket) {
            return $this->service('tickets/validity/' . $ticket);
        }

        public function getTicketProfiles() {
            return $this->service('tickets/profiles/');
        }

        public function getTicketProfile($id) {
            return $this->service('tickets/profiles/' . $id);
        }

        public function isDeviceCompatible($ua = null) {
            if ($ua) {
                $ua = base64_encode($ua);
            } else if ($this->ua) {
                $ua = base64_encode($this->ua);
            }

            if (!$ua) {
                throw new MobibaseVodExecption(__METHOD__ . ': User Agent is required.');  
            }

            return $this->service('devices/compatibility/' . $ua);
        }

        public function setApiKey($api_key) {
            $this->api_key = $api_key;
        }

        public function getApiKey() {
            return $this->api_key;
        }

        public function getLastRequest() {
            return $this->last_request;
        }

        public function getLastResponse() {
            return $this->last_response;
        }

        public function getLastPostedData() {
            return $this->last_posted_data;
        }

        private function service($action, $params = array(), $posted = array()) {
            $default = array(
                'apikey' => $this->api_key,
            );
            $params = array_merge($default, (array) $params);

            $request  = $this->service_url . $action . '?' . http_build_query($params);
            $response = $this->curl($request, $posted);

            $this->last_request     = $request;
            $this->last_posted_data = $posted;
            $this->last_response    = json_decode($response);

            if (!$response) {
                throw new MobibaseVodExecption(__METHOD__ . ': Bad URL or Server unavailable.');   
            }

            return json_decode($response);
        }

        private function curl($url, $posted = array()) {
            if (function_exists('curl_init')) {
                $ch = curl_init(); 
                
                curl_setopt($ch, CURLOPT_URL, $url); 
                curl_setopt($ch, CURLOPT_HEADER, 0); 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

                if ($posted) {
                    curl_setopt($ch,CURLOPT_POST, count($posted));
                    curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($posted));
                }

                $content = curl_exec($ch); 

                curl_close($ch); 

                return $content;
            } else {
                throw new MobibaseVodExecption(__METHOD__ . ': Curl library must be installed.');
            }
        }
    }

    Class MobibaseVodExecption extends Exception {

    }
