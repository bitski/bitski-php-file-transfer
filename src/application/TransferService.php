<?php
/**
 * Transfer service.
 *
 * @since 0.1.0
 */

namespace BitskiPHPFileTransfer\application;

use BitskiPHPFileTransfer\infrastructure\PeerAuthenticator;

class TransferService
{
    private PeerAuthenticator $peerAuthenticator;

    public function __construct(PeerAuthenticator $peerAuthenticator)
    {
        $this->peerAuthenticator = $peerAuthenticator;
    }

    /**
     * Creates a new transfer.
     */
    public function create(): bool
    {
        if ( ! $this->authorize()) {
            return false;
        }

        return true;
    }

    protected function authorize(): bool
    {
        if ( ! $this->peerAuthenticator->isPeerAuthorized()) {
            return false;
        }

        return true;
    }
}
