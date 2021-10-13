<?php
namespace Mezon\Security;

/**
 * Class MockSecurityProvider
 *
 * @package Security
 * @subpackage MockSecurityProvider
 * @author Dodonov A.A.
 * @version v.1.0 (2019/08/06)
 * @copyright Copyright (c) 2019, aeon.org
 */

/**
 * Class ServiceMockSecurityProvider - provides mockes for all security methods
 */
class MockProvider implements AuthorizationProviderInterface
{

    /**
     * Method creates session from existing token or fetched from HTTP headers
     *
     * @param string $token
     *            Session token
     * @return string Session token
     */
    public function createSession(string $token): string
    {
        if ($token === '') {
            return md5((string) microtime(true));
        } else {
            return $token;
        }
    }

    /**
     * Method creates conection session
     *
     * @param string $login
     *            Login
     * @param string $password
     *            Password
     * @return string Random md5 hash as session id
     */
    public function connect(string $login, string $password): string
    {
        return md5((string) microtime(true));
    }

    /**
     * Method returns id of the session user
     *
     * @return int id of the session user
     */
    public function getSelfId(): int
    {
        return 1;
    }

    /**
     * Method returns login of the session user
     *
     * @return string login of the session user
     */
    public function getSelfLogin(): string
    {
        return 'admin@localhost';
    }

    /**
     * Method allows user to login under another user
     *
     * @param string $token
     *            Token
     * @param string $loginOrId
     *            In this field login or user id are passed
     * @param string $field
     *            Contains 'login' or 'id'
     * @return string New session id
     */
    public function loginAs(string $token, string $loginOrId, string $field): string
    {
        return $token;
    }

    /**
     * Method returns true or false if the session user has permit or not
     *
     * @param string $token
     *            Token
     * @param string $permit
     *            Permit name
     * @return bool True if the
     */
    public function hasPermit(string $token, string $permit): bool
    {
        return true;
    }

    /**
     * Method throws exception if the user does not have permit
     *
     * @param string $token
     *            Token
     * @param string $permit
     *            Permit name
     */
    public function validatePermit(string $token, string $permit): void
    {}

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
     * Method returns field name for session_id
     *
     * @return string Field name
     */
    public function getSessionIdFieldName(): string
    {
        return 'session_id';
    }
}
