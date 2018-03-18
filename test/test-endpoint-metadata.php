<?php
/**
 * Created by PhpStorm.
 * User: afakes
 * Date: 18/3/18
 * Time: 12:36
 */

class testEndpointMetadata extends \PHPUnit\Framework\TestCase
{

    private $endpointData = null;

    public function setUp() {
        $this->endpointData = file_get_contents("http://adamfakes.com/afakes-myob-devops/api/metadata.php");
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

        $this->assertArrayHasKey('myapplication', $testValue, "key missing [myapplication]");
        $this->assertArrayHasKey('commitLog', $testValue['myapplication'], "key missing [result][commitLog]");
        $this->assertArrayHasKey(0, $testValue['myapplication']['commitLog'], "key missing [result][commitLog][0]");

        $firstCommit = $testValue['myapplication']['commitLog'][0];

        $this->assertContains('Initial commit', $firstCommit, "could not find initial commit message");

    }


}
