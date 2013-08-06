<?php 
namespace DigitalBeesSDK;
use Zend\Http\Client as Zc;
use Zend\Http\Request;

/**
 * HTTP Client for Digitalbees service
 */
class Client
    extends Zc
{
    
    public function __construct()
    {
        parent::__construct('http://api.digitalbees.it');
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
        $request->setUri("{$this->getUri()->toString()}get/{$id}");
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
        $request->setUri("{$this->getUri()->toString()}search/video?query=@category {$category}");
        foreach($params as $key => $val){
            $request->getQuery()->$key = $val;
        }
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
        //TODO
    }
    
    /**
     * This request return a videos array
     * @param string $query
     * @param array $params default('current' => '1', 'limit' => '100')
     */
    public function searchVideo($query, $params = array())
    {
        $request = $this->getRequest();
        $request->setUri("{$this->getUri()->toString()}search/video?query={$query}");
        foreach($params as $key => $val){
            $request->getQuery()->$key = $val;
        }
        $this->setRequest($request);
        $this->setResponse($this->send());
        return json_decode($this->getResponse()->getBody(), true);
    }
    
    public function searchAuthor($query, $params = array())
    {
        $request = $this->getRequest();
        $request->setUri("{$this->getUri()->toString()}search/author?query={$query}");
        foreach($params as $key => $val){
            $request->getQuery()->$key = $val;
        }
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
        $this->setRequest($request);
        $this->setResponse($this->send());
        return json_decode($this->getResponse()->getBody(), true);
    }
}