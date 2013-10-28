<?php 
namespace DigitalBeesSDK;
use Zend\Http\Client as Zc;
use Zend\Http\Request;
use ZendTest\XmlRpc\Server\Exception;

/**
 * HTTP Client for Digitalbees service
 */
class Client
    extends Zc
{

    protected $apiKey;
    protected $apiSecret;
    /**
     * @param array $configuration
     */
    public function __construct($apiKey, $apiSecret, $options = array())
    {
        if(!isset($options['host'])){
            $options['host'] = 'http://api.digitalbees.it';
        }
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        parent::__construct($options['host']);
    }
    
    /**
     * Return all videos
     * @return array
     * @param array $params default('current' => '1', 'limit' => '100')
     */
    public function getVideos($params = array())
    {
        $request = $this->getRequest();
        $request->setUri("{$this->getUri()->toString()}list/video");
        foreach($params as $key => $val){
            $request->getQuery()->$key = $val;
        }
        $request->getQuery()->apisecret = $this->apiSecret;
        $request->getQuery()->apikey = $this->apiKey;
        $this->setRequest($request);
        $this->setResponse($this->send());
        return json_decode($this->getResponse()->getBody(), true);
    }
    
    /**
     * Return one video from id
     * @param integer $id
     */
    public function getVideo($id)
    {
        $request = $this->getRequest();
        $request->setUri("{$this->getUri()->toString()}get/video/{$id}");
        $request->getQuery()->apisecret = $this->apiSecret;
        $request->getQuery()->apikey = $this->apiKey;
        $this->setRequest($request);
        $this->setResponse($this->send());
        return json_decode($this->getResponse()->getBody(), true);
    }

    /**
     * Return set of video from single category
     * @param array $video
     * @param array $params default('current' => '1', 'limit' => '100')
     */
    public function getVideosByCategory($category, $params = array())
    {
        $request = $this->getRequest();
        $request->setUri("{$this->getUri()->toString()}search/video?q=@category {$category}");
        foreach($params as $key => $val){
            $request->getQuery()->$key = $val;
        }
        $request->getQuery()->apisecret = $this->apiSecret;
        $request->getQuery()->apikey = $this->apiKey;
        $this->setRequest($request);
        $this->setResponse($this->send());
        return json_decode($this->getResponse()->getBody(), true);
    }
    
    /**
     * Return list of categories
     * @var array
     */
    public function getCategories()
    {
        return array('MUSIC');
    }
    
    /**
     * This request return a videos array
     * @param string $query
     * @param array $params default('current' => '1', 'limit' => '100')
     */
    public function searchVideo($query, $params = array())
    {
        $request = $this->getRequest();
        $request->setUri("{$this->getUri()->toString()}search/video?q={$query}");
        foreach($params as $key => $val){
            $request->getQuery()->$key = $val;
        }
        $request->getQuery()->apisecret = $this->apiSecret;
        $request->getQuery()->apikey = $this->apiKey;
        $this->setRequest($request);
        $this->setResponse($this->send());
        return json_decode($this->getResponse()->getBody(), true);
    }
    
    public function searchAuthor($query, $params = array())
    {
        $request = $this->getRequest();
        $request->setUri("{$this->getUri()->toString()}search/author?q={$query}");
        foreach($params as $key => $val){
            $request->getQuery()->$key = $val;
        }
        $request->getQuery()->apisecret = $this->apiSecret;
        $request->getQuery()->apikey = $this->apiKey;
        $this->setRequest($request);
        $this->setResponse($this->send());
        return json_decode($this->getResponse()->getBody(), true);
    }
    
    public function getAuthors($params = array())
    {
        $request = $this->getRequest();
        $request->setUri("{$this->getUri()->toString()}list/author");
        foreach($params as $key => $val){
            $request->getQuery()->$key = $val;
        }
        $request->getQuery()->apisecret = $this->apiSecret;
        $request->getQuery()->apikey = $this->apiKey;
        $this->setRequest($request);
        $this->setResponse($this->send());
        return json_decode($this->getResponse()->getBody(), true);
    }

    /**
     * Return one author from id
     * @param integer $id
     */
    public function getAuthor($id)
    {
        $request = $this->getRequest();
        $request->setUri("{$this->getUri()->toString()}get/author/{$id}");
        $request->getQuery()->apisecret = $this->apiSecret;
        $request->getQuery()->apikey = $this->apiKey;
        $this->setRequest($request);
        $this->setResponse($this->send());
        return json_decode($this->getResponse()->getBody(), true);
    }
}