<?php

use App\ABTesting\AB;
use PHPUnit\Framework\TestCase;

class ABTest extends TestCase
{
    /**
     * @var AB
     */
    private $ab;

    /**
     * Common configuration performed before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->ab = new AB(1);
    }

    public function testRedirectReturnsString()
    {
        $result = $this->ab->redirect();
        $this->assertIsString($result);
    }

    public function testChooseDesignReturnsValidDesignId()
    {
        // Making the method accessible for testing
        $reflection = new ReflectionClass(AB::class);
        $method = $reflection->getMethod('chooseDesign');
        // $method->setAccessible(true);

        $result = $method->invoke($this->ab);

        $this->assertIsInt($result);

        $designs = $this->ab->getAbTestData()->getAllDesigns();
        $this->assertGreaterThanOrEqual(1, $result);
        $this->assertLessThanOrEqual(count($designs), $result);
    }

    public function testGetRedirectUrlReturnsValidUrl()
    {
        // Making the method accessible for testing
        $reflection = new ReflectionClass(AB::class);
        $method = $reflection->getMethod('getRedirectUrl');
        $method->setAccessible(true);

        $designId = 1;
        $result = $method->invoke($this->ab, $designId);

        $this->assertIsString($result);
        $this->assertStringContainsString("https://www.exads.com/design$designId", $result);
    }
}
