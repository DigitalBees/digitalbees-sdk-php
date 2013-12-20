<?php 
namespace DigitalBeesSDKTest;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \DigitalBeesSDK\Client
     */
    protected $client;

    public function setUp()
    {
        $arrayConfig = require __DIR__ . "/../config.test.php";
        $this->client = new \DigitalBeesSDK\Client($arrayConfig['apiKey'], $arrayConfig['apiSecret']);
    }

    public function testMeResponse()
    {
        $response = $this->client->me();
        $this->isJson(json_encode($response));
    }

    public function testMeIsUser()
    {
        $response = $this->client->me();
        $this->isTrue(array_key_exists('user', $response));
    }

    public function testGetAllVideos()
    {
        $response = $this->client->getVideos();
        $c = false;
        if(count($response['data']) > 1){
            $c = true;
        }
        $this->isTrue($c);
    }

    public function testGetVideo()
    {
        $response = $this->client->getVideo(1);
        $this->isJson(json_encode($response));
    }
}