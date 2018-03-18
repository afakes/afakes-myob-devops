<?php
/**
 * Created by PhpStorm.
 * User: afakes
 * Date: 18/3/18
 * Time: 12:36
 */

class testEndpointMetadata extends \PHPUnit\Framework\TestCase
{

    private $endpointBase = "http://adamfakes.com/staging/afakes-myob-devops/api";
    private $endpointData = null;

    public function setUp() {
        $this->endpointData = file_get_contents("{$this->endpointBase}/metadata.php");
    }

    public function testEndpointMetadataContent()
    {
        $testValue = $this->endpointData;
        $this->assertNotNull($testValue, "Cannot get endpoint [metadata]");
    }

    public function testEndpointMetadataData()
    {
        $testValue = json_decode($this->endpointData, true);
        $this->assertNotFalse($testValue, "Endpoint data is not JSON");

        $this->assertArrayHasKey('metadata', $testValue, "key missing [metadata]");
        $this->assertArrayHasKey('commitLog', $testValue['metadata'], "key missing [metadata][commitLog]");
        $this->assertArrayHasKey(0, $testValue['metadata']['commitLog'], "key missing [metadata][commitLog][0]");

        $firstCommit = $testValue['metadata']['commitLog'][0];

        $this->assertContains('Initial commit', $firstCommit, "could not find initial commit message");

    }


}
