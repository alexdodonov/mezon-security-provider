<?php
namespace Mezon\Security;

/**
 * Interface ProviderInterface
 *
 * @package Security
 * @subpackage ProviderInterface
 * @author Dodonov A.A.
 * @version v.1.0 (2019/08/08)
 * @copyright Copyright (c) 2019, http://aeon.su
 */

/**
 * Interface for security providers
 */
interface ProviderInterface
{

    /**
     * Method creates session from existing token or fetched from HTTP headers
     *
     * @param string $token
     *            session token
     * @return string session token
     */
    public function createSession(string $token): string;
}
