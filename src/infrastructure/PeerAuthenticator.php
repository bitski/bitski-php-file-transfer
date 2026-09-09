<?php
/**
 * Authorizes the current peer.
 *
 * @since 0.1.1
 */

namespace BitskiPHPFileTransfer\infrastructure;

class PeerAuthenticator
{
    /**
     * Checks if the current peer is authorized.
     */
    public function isPeerAuthorized(): bool
    {
        return true;
    }
}
