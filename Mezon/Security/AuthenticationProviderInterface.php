<?php
namespace Mezon\Security;

/**
 * Interface AuthenticationProviderInterface
 *
 * @package Security
 * @subpackage AuthenticationProviderInterface
 * @author Dodonov A.A.
 * @version v.1.0 (2019/08/08)
 * @copyright Copyright (c) 2019, http://aeon.su
 */

/**
 * Interface for security provider with authorization
 */
interface AuthenticationProviderInterface extends ProviderInterface
{

    /**
     * Method creates session from existing token or fetched from HTTP headers
     *
     * @param string $token
     *            session token
     * @return string session token
     */
    public function createSession(string $token): string;

    /**
     * Method creates conection session
     *
     * @param string $login
     *            login
     * @param string $password
     *            password
     * @return string session id of the created session
     */
    public function connect(string $login, string $password): string;

    /**
     * Method returns id of the session user
     *
     * @return int id of the session user
     */
    public function getSelfId(): int;

    /**
     * Method returns login of the session user
     *
     * @return string login of the session user
     */
    public function getSelfLogin(): string;

    /**
     * Method returns field name for login
     *
     * @return string field name
     */
    public function getLoginFieldName(): string;

    /**
     * Method returns field name for session_id
     *
     * @return string field name
     */
    public function getSessionIdFieldName(): string;
}
