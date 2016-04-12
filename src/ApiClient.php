<?php

namespace Opteck;

use GuzzleHttp;
use Opteck\Responses\CreateLead as CreateLeadResponse;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Opteck\Requests\CreateLead as CreateLeadRequest;

class ApiClient implements LoggerAwareInterface
{
    /**
     * @var \GuzzleHttp\ClientInterface A Guzzle HTTP client.
     */
    protected $httpClient;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    protected $url = "https://api.optaffiliates.com/v1";

    /**
     * @var int
     */
    protected $affiliateId;

    /**
     * @var string
     */
    protected $partnerId;

    public function __construct($affiliateId, $partnerId, $url = null)
    {
        $this->affiliateId = $affiliateId;
        $this->partnerId = $partnerId;
        if (!is_null($url)) {
            $this->url = $url;
        }
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param \Opteck\Requests\CreateLead $request
     *
     * @return \Opteck\Responses\CreateLead
     */
    public function createLead(CreateLeadRequest $request)
    {
        $data = [
            'email'       => $request->getEmail(),
            'affiliateID' => $this->affiliateId,
            'firstName'   => $request->getFirstName(),
            'lastName'    => $request->getLastName(),
            'phone'       => $request->getPhone(),
            'password'    => $request->getPassword(),
            'language'    => $request->getLanguage(),
            'country'     => $request->getCountry(),
            'ip'          => $request->getIp(),
            'campaign'    => $request->getCampaign(),
            'subcampaign' => $request->getSubCampaign(),
            'comment'     => $request->getComment(),
        ];

        $data['checksum'] = $this->getChecksum($data);

        $payload = new Payload($this->postRequest($this->getUrl() . "/lead/create", $data));
        $response = new CreateLeadResponse($payload);

        return $response;
    }

    protected function getUrl()
    {
        return $this->url;
    }

    protected function getHttpClient()
    {
        if (!is_null($this->httpClient)) {
            return $this->httpClient;
        }

        $stack = GuzzleHttp\HandlerStack::create();

        if ($this->logger instanceof LoggerInterface) {
            $stack->push(GuzzleHttp\Middleware::log(
                $this->logger,
                new GuzzleHttp\MessageFormatter(GuzzleHttp\MessageFormatter::DEBUG)
            ));
        }

        $this->httpClient = new GuzzleHttp\Client([
            'base_uri' => $this->getUrl(),
            'handler'  => $stack,
        ]);

        return $this->httpClient;
    }

    /**
     * Returns checksum according Opteck Checksum Mechanism.
     *
     * @param $data
     *
     * @return string
     */
    protected function getChecksum($data)
    {
        $stringForHash = $this->partnerId . http_build_query($data);

        return strtoupper(hash('md5', $stringForHash));
    }

    protected function postRequest($url, $data)
    {
        return (string) $this->getHttpClient()
            ->post($url, [
                'form_params' => $data,
                'headers'     => [
                    'User-Agent'   => 'Opteck API Client',
                ],
            ])->getBody();
    }
}