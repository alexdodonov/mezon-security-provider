<?php
namespace Mezon\Security;

/**
 * Class AuthenticationProvider
 *
 * @package Security
 * @subpackage AuthenticationProvider
 * @version v.1.0 (2020/03/19)
 * @copyright Copyright (c) 2020, aeon.org
 */

/**
 * Class provides simple and the most common functionality
 */
class AuthenticationProvider implements \Mezon\Security\AuthenticationProviderInterface
{

    /**
     * Field name in session where we store login of the authorized user
     *
     * @var string
     */
    public $sessionUserLoginFieldName = 'session-user-login';

    /**
     *
     * {@inheritdoc}
     * @see AuthenticationProviderInterface::getSelfLogin()
     */
    public function getSelfLogin(): string
    {
        return $_SESSION[$this->sessionUserLoginFieldName];
    }

    /**
     *
     * {@inheritdoc}
     * @see AuthenticationProviderInterface::getLoginFieldName()
     */
    public function getLoginFieldName(): string
    {
        return 'login';
    }

    /**
     *
     * {@inheritdoc}
     * @see AuthenticationProviderInterface::getSessionIdFieldName()
     */
    public function getSessionIdFieldName(): string
    {
        return 'session-id';
    }

    /**
     *
     * {@inheritdoc}
     * @see AuthenticationProviderInterface::getSelfId()
     */
    public function getSelfId(): int
    {
        return $_SESSION['session-user-id'];
    }

    /**
     * Method creates session
     *
     * @param string $token
     * @codeCoverageIgnore
     */
    protected function sessionId(string $token): void
    {
        session_id($token);
    }

    /**
     *
     * {@inheritdoc}
     * @see AuthenticationProviderInterface::createSession()
     */
    public function createSession(string $token): string
    {
        $this->sessionId($token);

        if (isset($_SESSION[$this->sessionUserLoginFieldName]) === false) {
            throw (new \Exception('Authentication error', - 1));
        }

        return $token;
    }

    /**
     *
     * {@inheritdoc}
     * @see AuthenticationProviderInterface::connect()
     */
    public function connect(string $login, string $password): string
    {
        $token = md5((string) microtime(true));

        $this->sessionId($token);

        $_SESSION[$this->sessionUserLoginFieldName] = $login;
        $_SESSION['session-user-id'] = 1;

        return $token;
    }
}
