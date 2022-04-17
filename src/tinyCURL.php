<?php

/**
 * @package tinyCURL
 * @author Ugur Cengiz <ugurcengiz.mail@gmail.com>
 * @website ugurcengiz.com
 */

namespace Muffinweb;

class tinyCURL
{
    //cURL Object
    public $instance;

    //Response Object
    public $response;

    //Response Info
    public $info;


    public $url;
    public $type = 'GET';
    public $data = [];

    public $defaults = [

        // Return response
        CURLOPT_RETURNTRANSFER => true,

        //Keep track redirections
        CURLOPT_FOLLOWLOCATION => true,

        //Verify HOST | SSL
        CURLOPT_SSL_VERIFYHOST => false,

        //Verify PEER | SSL
        CURLOPT_SSL_VERIFYPEER => false

    ];

    /**
     * Creates tinyCURL Request
     */
    public function prepare(&$instance) : void
    {
        $instance = curl_init();

        $payload = $this->defaults;
        $merges = [
            CURLOPT_URL => $this->url,
            CURLOPT_CUSTOMREQUEST => $this->type,
            CURLOPT_POSTFIELDS => http_build_query($this->data)
        ];

        foreach($merges as $key => $value){
            $payload[$key] = $value;
        }

        curl_setopt_array($this->instance, $payload);
    }

    /** Standart, simple GET Request */
    public function get(String $request_url, Array $data = [])
    {
        if(filter_var($request_url, FILTER_VALIDATE_URL)){
            $this->url = $request_url;

            if(gettype($data) == 'array'){
                $this->data = $data;
            }

            $this->prepare($this->instance);

            $this->response = curl_exec($this->instance);
            $this->info = curl_getinfo($this->instance);

            return $this;
        }else{
            throw new tinyCURLException("Invalid URL entered!", 500);
        }
    }

    /** Standart, simple POST Request */
    public function post(String $request_url, Array $data = [])
    {
        if(filter_var($request_url, FILTER_VALIDATE_URL)){
            $this->url = $request_url;

            if(gettype($data) == 'array'){
                $this->data = $data;
            }

            $this->type = 'POST';

            $this->prepare($this->instance);

            $this->response = curl_exec($this->instance);
            $this->info = curl_getinfo($this->instance);

            return $this;
        }else{
            throw new tinyCURLException("Invalid URL entered!", 500);
        }
    }

    /** If successful request passed, render content */
    public function render(){
        if($this->info['http_code'] == '200'){
            echo $this->response;
        }
    }

    /** Get cURL Response Info Details as Array */
    public function info(){
        return $this->info;
    }

}