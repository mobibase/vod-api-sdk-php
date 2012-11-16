<?php
    Class MobibaseVodClient {
        private $api_key = null;
        private $service_url = 'http://v1.vod.api.mobibase.com/';
        private $last_request = null;
        private $last_response = null;
        private $ua = null;

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

        public function getPackages($options = array()) {
            return $this->service('packages/', $options);
        }

        public function getPackage($id, $options = array()) {
            return $this->service('packages/'.$id, $options);
        }

        public function getVideos($options = array()) {
            return $this->service('videos/', $options);
        }

        public function getVideo($id, $network = null, $ua = null) {
            if ($network) {
                $network = '/'.strtolower($network);
            }
            
            if ($ua) {
                $ua = '/'.base64_encode($ua);
            } else if ($this->ua) {
                $ua = '/'.base64_encode($this->ua);
            }

            if (($network && !$ua) || (!$network && $ua)) {
                throw new MobibaseVodExecption(__METHOD__.': Both Network and User Agent are required.');  
            }

            return $this->service('videos/'.$id.$network.$ua);
        }

        public function isDeviceCompatible($ua = null) {
            if ($ua) {
                $ua = base64_encode($ua);
            } else if ($this->ua) {
                $ua = base64_encode($this->ua);
            }

            if (!$ua) {
                throw new MobibaseVodExecption(__METHOD__.': User Agent is required.');  
            }

            return $this->service('devices/compatibility/'.$ua);
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

        private function service($action, $params = array()) {
            $default = array(
                'apikey' => $this->api_key,
            );
            $params = array_merge($default, $params);

            $request  = $this->service_url.$action.'?'.http_build_query($params);
            $response = $this->curl($request);

            $this->last_request  = $request;
            $this->last_response = $response;

            if (!$response) {
                throw new MobibaseVodExecption(__METHOD__.': Bad URL or Server unavailable.');   
            }

            return json_decode($response);
        }

        private function curl($url) {
            if (function_exists('curl_init')) {
                $ch = curl_init(); 
                
                curl_setopt($ch, CURLOPT_URL, $url); 
                curl_setopt($ch, CURLOPT_HEADER, 0); 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                $content = curl_exec($ch); 

                curl_close($ch); 

                return $content;
            } else {
                throw new MobibaseVodExecption(__METHOD__.': Curl library must be installed.');
            }
        }
    }

    Class MobibaseVodExecption extends Exception {

    }