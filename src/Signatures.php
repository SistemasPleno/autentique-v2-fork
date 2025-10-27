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
  public function approveBiometric( array $attributes): array
    {
      $variables = [
            "verification_id" => $attributes["verification_id"],
            "public_id" => $attributes["public_id"],
        ];

        $queryFile = __FUNCTION__;


        $graphMutation = $this->query->query($queryFile);
        $graphMutation = $this->query->setVariables(
            ["variables", "sandbox"],
            [json_encode($variables), $this->sandbox],
            $graphMutation
        );

        return $this->api->request($this->token, $graphMutation, "json");
    }

}