<?php
/**
 * Transfer service.
 *
 * @since 0.1.0
 */

namespace BitskiPHPFileTransfer\application;

use BitskiPHPFileTransfer\domain\TransferCreator;
use BitskiPHPFileTransfer\infrastructure\PeerAuthenticator;

class TransferService
{
    private PeerAuthenticator $peerAuthenticator;
    private TransferCreator $transferCreator;

    public function __construct(PeerAuthenticator $peerAuthenticator, TransferCreator $transferCreator)
    {
        $this->peerAuthenticator = $peerAuthenticator;
        $this->transferCreator = $transferCreator;
    }

    /**
     * Creates a new transfer.
     */
    public function create(): bool
    {
        if (!$this->authorize()) {
            return false;
        }

        $transfer = $this->transferCreator->createTransfer();

        return true;
    }

    protected function authorize(): bool
    {
        if (!$this->peerAuthenticator->isPeerAuthorized()) {
            return false;
        }

        return true;
    }
}
