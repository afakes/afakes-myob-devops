<?php
/**
 * Created by PhpStorm.
 * User: afakes
 * Date: 18/3/18
 * Time: 12:36
 */

class testEndpointHealth extends \PHPUnit\Framework\TestCase
{

    private $endpointData = null;

    public function setUp() {
        $this->endpointData = file_get_contents("http://adamfakes.com/afakes-myob-devops/api/health.php");
    }

    public function testEndpointHealthContent()
    {
        $testValue = $this->endpointData;
        $this->assertNotNull($testValue, "Cannot get endpoint [health]");
    }

    public function testEndpointHealthData()
    {
        $testValue = json_decode($this->endpointData, true);
        $this->assertNotFalse($testValue, "Endpoint data is not JSON");

        $this->assertArrayHasKey('result', $testValue, "key missing [result]");
        $this->assertArrayHasKey('checksum', $testValue['result'], "key missing [result][checksum]");

        $this->assertGreaterThan(5, strlen($testValue['result']['checksum']), "CHECKSUMS is not longer than 5 chars");

    }


}
