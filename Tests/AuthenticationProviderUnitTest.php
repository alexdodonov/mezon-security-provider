<?php
use Mezon\Security\AuthenticationProvider;

class AuthenticationProviderUnitTest extends \PHPUnit\Framework\TestCase
{

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
     * Creating mock of the AuthenticationProvider
     *
     * @return object mock of the AuthenticationProvider
     */
    protected function getAuthenticationProviderMock(): object
    {
        return $this->getMockBuilder(AuthenticationProvider::class)
            ->setMethods([
            'sessionId'
        ])
            ->getMock();
    }

    /**
     * Testing createSession
     */
    public function testCreateSession(): void
    {
        // setup
        $mock = $this->getAuthenticationProviderMock();
        $_SESSION[$mock->sessionUserLoginFieldName] = 'login';

        // test body
        $token = $mock->createSession('created-token');

        // assertions
        $this->assertEquals('created-token', $token);
    }

    /**
     * Testing createSession
     */
    public function testCreateSessionException(): void
    {
        // setup
        $mock = $this->getAuthenticationProviderMock();
        unset($_SESSION[$mock->sessionUserLoginFieldName]);

        // assertions
        $this->expectException(\Exception::class);

        // test body
        $mock->createSession('not-created-token');
    }

    /**
     * Testing connect method
     */
    public function testConnect(): void
    {
        // setup
        $mock = $this->getAuthenticationProviderMock();

        // test body
        $mock->connect('login@localhost', 'root');

        // assertions
        $this->assertEquals('login@localhost', $_SESSION[$mock->sessionUserLoginFieldName]);
        $this->assertEquals(1, $_SESSION['session-user-id']);
    }
}