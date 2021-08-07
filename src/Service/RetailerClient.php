<?php

namespace Knops\BolcomClient\Service;

use Knops\BolcomClient\Model\AccessToken;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\{RequestFactoryInterface, ResponseInterface};

final class RetailerClient
{
    private string $loginUrl = 'https://login.bol.com';
    private string $baseUrl = 'https://api.bol.com';
    private string $environment = 'retailer'; // 'retailer-demo' for testing
    private ?AccessToken $accessToken = null;

    public function __construct(
        private ClientInterface $httpClient,
        private RequestFactoryInterface $httpRequestFactory,
        private string $clientId,
        private string $clientSecret,
    ) {}

    public function offers(): OfferApi
    {
        return new OfferApi($this);
    }

    protected function authenticate()
    {
        $uri = $this->loginUrl . '/token?grant_type=client_credentials';
        $authorization = 'Basic ' . \base64_encode(\implode(':', [$this->clientId, $this->clientSecret]));

        $request = $this->httpRequestFactory->createRequest('POST', $uri)
            ->withHeader('Accept', 'application/json')
            ->withHeader('Authorization', $authorization);

        $response = $this->httpClient->sendRequest($request);
        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Authentication Failed');
        }

        $this->accessToken = AccessToken::fromObject(\json_decode($response->getBody()->getContents()));
    }

    public function request(
        string $method,
        string $path,
        array $body = [],
        array $query = [],
        array $headers = []
    ): ResponseInterface {
        if (null === $this->accessToken) {
            $this->authenticate();
        }
        if ($path[0] !== '/') {
            $path = '/' . $path;
        }

        $uri = sprintf('%s/%s', $this->baseUrl, $this->environment);
        $authorization = sprintf('%s %s', $this->accessToken->getTokenType(), $this->accessToken->getAccessToken());

        $request = $this->httpRequestFactory->createRequest($method, $uri . $path)
            ->withHeader('Accept', 'application/json')
            ->withHeader('Authorization', $authorization);

        foreach ($headers as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        if ($query) {
            $request = $request->withUri($request->getUri()->withQuery(\http_build_query($query)));
        }

        if ($body) {
            $request = $request->withHeader('Content-Type', 'application/json');
            $request->getBody()->write(\json_encode($body));
        }

        return $this->httpClient->sendRequest($request);
    }
}