<?php

namespace Opteck;

use GuzzleHttp;
use Opteck\Requests\CreateLead as CreateLeadRequest;
use Opteck\Responses\Auth as AuthResponse;
use Opteck\Responses\CreateLead as CreateLeadResponse;
use Opteck\Responses\GetDeposits as GetDepositsResponse;
use Opteck\Responses\GetLeadDetails as GetLeadDetailsResponse;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

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

    protected $url = 'https://api.optaffiliates.com/v1';

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
            'affiliateID' => $this->affiliateId,
            'email'       => $request->getEmail(),
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
            'marker'      => $request->getMarker(),
        ];

        $data['checksum'] = $this->getChecksum($data);

        $payload = new Payload($this->postRequest($this->getUrl().'/lead/create', $data));
        $response = new CreateLeadResponse($payload);

        return $response;
    }

    /**
     * Creates a session on the platform and returns a token used in some requests along with lead info.
     *
     * @param string $email
     * @param string $password
     *
     * @return \Opteck\Responses\Auth
     *
     * @throws \Opteck\Exceptions\LeadNotFoundException
     */
    public function auth($email, $password)
    {
        $data = [
            'affiliateID' => $this->affiliateId,
            'email'       => $email,
            'password'    => $password,
        ];

        $data['checksum'] = $this->getChecksum($data);

        $payload = new Payload($this->postRequest($this->getUrl().'/trade/auth', $data));
        $response = new AuthResponse($payload);

        return $response;
    }

    /**
     * Returns lead information.
     *
     * @param string $email
     *
     * @return \Opteck\Responses\GetLeadDetails
     */
    public function getLeadDetails($email)
    {
        $data = [
            'affiliateID' => $this->affiliateId,
            'email'       => $email,
        ];

        $data['checksum'] = $this->getChecksum($data);

        $payload = new Payload($this->postRequest($this->getUrl().'/trade/getLeadDetails', $data));
        $response = new GetLeadDetailsResponse($payload);

        return $response;
    }

    /**
     * Returns list of deposits made in the specified date range.
     *
     * @param int $fromTimestamp UNIX timestamp
     * @param int $toTimestamp UNIX timestamp
     *
     * @return \Opteck\Entities\Deposit[]
     */
    public function getDeposits($fromTimestamp, $toTimestamp = null)
    {
        $toTimestamp = !is_null($toTimestamp) ? $toTimestamp : time();

        $data = [
            'affiliateID' => $this->affiliateId,
            'dateFrom'    => date('c', intval($fromTimestamp)),
            'dateTo'      => date('c', intval($toTimestamp)),
        ];

        $data['checksum'] = $this->getChecksum($data);

        $payload = new Payload($this->postRequest($this->getUrl().'/lead/getDeposits', $data));
        $response = new GetDepositsResponse($payload);

        return $response->getDeposits();
    }

    /**
     * Returns array with ISO 3166-1 codes for countries forbidden for signup.
     *
     * @return array
     */
    public function getForbiddenCountries(){
        return [
            'IL',
            'US',
            'IQ',
            'NG',
            'DZ',
            'MA',
            'SD',
            'LY',
            'YE',
            'BW',
            'TN',
            'SY',
            'UM',
            'VI',
            'IR',
            'KP',
            'CU',
            'BZ',
        ];
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
        $stringForHash = $this->partnerId.http_build_query($data);

        return strtoupper(hash('md5', $stringForHash));
    }

    protected function postRequest($url, $data)
    {
        try {
            $response = (string) $this->getHttpClient()
                ->post($url, [
                    'form_params' => $data,
                    'headers'     => [
                        'User-Agent'   => 'Opteck API Client',
                    ],
                ])->getBody();

            return $response;
        } catch (GuzzleHttp\Exception\ClientException $e) {
            throw new \Exception($e->getResponse()->getReasonPhrase(), $e->getResponse()->getStatusCode());
        }

    }
}
