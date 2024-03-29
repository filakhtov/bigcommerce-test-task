<?php namespace BigCommerce\Infrastructure\Configuration;

use \BigCommerce\Infrastructure\Flickr\Contract\FlickrRestConfigurationInterface;
use \InvalidArgumentException;

class Configuration implements FlickrRestConfigurationInterface
{

    /** @var string */
    private $apiKey;

    /** @var string */
    private $apiEndpoint;

    /** @var mixed[] */
    private $databaseConnection;

    /** @throws InvalidArgumentException */
    public function __construct(array $parameters)
    {
        $this->setFlickrConfiguration($parameters)
            ->setDoctrineConfiguration($parameters);
    }

    /**
     * @throws InvalidArgumentException
     * @return Configuration
     */
    private function setFlickrConfiguration(array $parameters)
    {
        if (false === array_key_exists('flickr', $parameters) || false === is_array($parameters['flickr'])) {
            throw new InvalidArgumentException('Invalid flickr configuration parameter. Array expected.');
        }

        $flickrParameters = $parameters['flickr'];

        if (false === array_key_exists('api_key', $flickrParameters) || false === is_string($flickrParameters['api_key'])) {
            throw new InvalidArgumentException('Invalid flickr.api_key parameter. String expected.');
        }
        $this->apiKey = $parameters['flickr']['api_key'];

        if (false === array_key_exists('api_endpoint', $flickrParameters) || false === is_string($flickrParameters['api_endpoint'])) {
            throw new InvalidArgumentException('Invalid flickr.api_endpoint parameter. String expected.');
        }
        $this->apiEndpoint = $parameters['flickr']['api_endpoint'];

        return $this;
    }

    /**
     * @throws InvalidArgumentException
     * @return Configuration
     */
    private function setDoctrineConfiguration(array $parameters)
    {
        if (false === array_key_exists('db', $parameters) || false === is_array($parameters['db'])) {
            throw new InvalidArgumentException('Invalid db configuration parameter. Array expected.');
        }
        $this->databaseConnection = $parameters['db'];

        return $this;
    }

    /** @return string */
    public function apiKey()
    {
        return $this->apiKey;
    }

    /** @return string */
    public function apiEndpoint()
    {
        return $this->apiEndpoint;
    }

    public function databaseConnection()
    {
        return $this->databaseConnection;
    }

}
