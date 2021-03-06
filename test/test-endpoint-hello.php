<?php
/**
 * Created by PhpStorm.
 * User: afakes
 * Date: 18/3/18
 * Time: 12:36
 */

class testEndpointHello extends \PHPUnit\Framework\TestCase
{

    private $endpointBase = "http://adamfakes.com/staging/afakes-myob-devops/api";
    private $endpointData = null;

    public function setUp() {
        $this->endpointData = file_get_contents("{$this->endpointBase}/hello.php");
    }

    public function testEndpointHelloContent()
    {
        $testValue = $this->endpointData;
        $this->assertNotNull($testValue, "Cannot get endpoint [hello]");
    }

    public function testEndpointHelloMessage()
    {
        $testValue = json_decode($this->endpointData, true);
        $this->assertNotFalse($testValue, "Endpoint data is not JSON");
        $this->assertArrayHasKey('message', $testValue, "key missing [message]");
        $this->assertEquals("Hello World", $testValue['message'], "Messages are not the same");

    }


}
