<?php
namespace Mezon\Security\Tests;

use Mezon\Security\MockProvider;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class MockProviderUnitTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Testing session creation.
     */
    public function testCreateSession1(): void
    {
        // setup
        $provider = new MockProvider();

        // test body
        $token = $provider->createSession(md5('1'));

        // assertions
        $this->assertEquals(32, strlen($token));
    }

    /**
     * Testing session creation with already created token
     */
    public function testCreateSession2(): void
    {
        // setup
        $provider = new MockProvider();

        // test body
        $token = $provider->createSession('token');

        // assertions
        $this->assertEquals('token', $token);
    }

    /**
     * Testing session with token creation
     */
    public function testCreateSession3(): void
    {
        // setup
        $provider = new MockProvider();

        // test body
        $token = $provider->createSession('');

        // assertions
        $this->assertEquals(32, strlen($token));
    }

    /**
     * Testing validatePermit method
     */
    public function testValidatePermit(): void
    {
        $provider = new MockProvider();

        $provider->validatePermit('token', 'permit');

        $this->assertTrue(true);
    }

    /**
     * Testing connect method
     */
    public function testConnect(): void
    {
        $provider = new MockProvider();

        $hash = $provider->connect('l', 'p');

        $this->assertEquals(32, strlen($hash));
    }

    /**
     * Testing hasPermit method
     */
    public function testHasPermit(): void
    {
        $provider = new MockProvider();

        $this->assertTrue($provider->hasPermit('t', 'p'));
    }

    /**
     * Testing hasPermit method
     */
    public function testHasPermits(): void
    {
        $provider = new MockProvider();
        $provider->hasPermitResults = [
            true,
            false
        ];

        $this->assertTrue($provider->hasPermit('t', 'p'));
        $this->assertFalse($provider->hasPermit('t', 'p'));
        $this->assertTrue($provider->hasPermit('t', 'p'));
    }
}
