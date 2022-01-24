<?php
namespace Mezon\Security\Tests;

use Mezon\Security\AuthenticationProvider;
use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class AuthenticationProviderUnitTest extends TestCase
{

    /**
     *
     * {@inheritdoc}
     * @see TestCase::setUp()
     */
    protected function setUp(): void
    {
        Conf::setConfigStringValue('session/layer', 'mock');
    }

    /**
     * Testing getLoginFieldName
     */
    public function testGetLoginFieldName(): void
    {
        // setup
        $securityProvider = new AuthenticationProvider();

        // assertions
        $this->assertEquals('login', $securityProvider->getLoginFieldName());
    }

    /**
     * Testing getSessionIdFieldName
     */
    public function testGetSessionIdFieldName(): void
    {
        // setup
        $securityProvider = new AuthenticationProvider();

        // assertions
        $this->assertEquals('session-id', $securityProvider->getSessionIdFieldName());
    }

    /**
     * Testing getSelfLogin
     */
    public function testGetSelfLogin(): void
    {
        // setup
        $securityProvider = new AuthenticationProvider();
        $_SESSION[$securityProvider->sessionUserLoginFieldName] = 'session-login';

        // assertions
        $this->assertEquals('session-login', $securityProvider->getSelfLogin());
    }

    /**
     * Testing getSelfId
     */
    public function testGetSelfId(): void
    {
        // setup
        $securityProvider = new AuthenticationProvider();
        $_SESSION['session-user-id'] = 111;

        // assertions
        $this->assertEquals(111, $securityProvider->getSelfId());
    }

    /**
     * Testing createSession
     */
    public function testCreateSession(): void
    {
        // setup
        $securityProvider = new AuthenticationProvider();
        $_SESSION[$securityProvider->sessionUserLoginFieldName] = 'login';

        // test body
        $token = $securityProvider->createSession('created-token');

        // assertions
        $this->assertEquals('created-token', $token);
    }

    /**
     * Testing createSession
     */
    public function testCreateSessionException(): void
    {
        // setup
        $securityProvider = new AuthenticationProvider();

        if (isset($_SESSION[$securityProvider->sessionUserLoginFieldName])) {
            unset($_SESSION[$securityProvider->sessionUserLoginFieldName]);
        }

        // assertions
        $this->expectException(\Exception::class);

        // test body
        $securityProvider->createSession('not-created-token');
    }

    /**
     * Testing connect method
     */
    public function testConnect(): void
    {
        // setup
        $securityProvider = new AuthenticationProvider();

        // test body
        $securityProvider->connect('login@localhost', 'root');

        // assertions
        $this->assertEquals('login@localhost', $_SESSION[$securityProvider->sessionUserLoginFieldName]);
        $this->assertEquals(1, $_SESSION['session-user-id']);
    }
}