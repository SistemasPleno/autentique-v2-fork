<?php

namespace vinicinbgs\Autentique;

use Exception;
use vinicinbgs\Autentique\exceptions\EmptyTokenException;
use vinicinbgs\Autentique\Utils\Query;

class Signatures extends BaseResource {

  /**
     * @var Query
     */
    private $query;

  /**
   * Signatures Constructor
   *
   * @param string|null $token
   * @param int $timeout
   */
  public function __construct ( string $token = null, int $timeout = 60 ) {
    parent::__construct($token, $timeout);

    $this->query = new Query($this->resourcesEnum::SIGNATURES);
  }

  /**
   * @param int $page
   * @return array
   * @throws EmptyTokenException
   * @throws Exception
   */
  public function approveBiometric( int $page = 1): array
    {
        $graphQuery = $this->query->query(__FUNCTION__);

        $graphQuery = $this->query->setVariables("page", $page, $graphQuery);

        return $this->api->request($this->token, $graphQuery, "json");
    }

}