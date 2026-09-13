<?php
/**
 * Transfer service.
 *
 * @since 0.1.0
 */

namespace BitskiPHPFileTransfer\application;

use BitskiPHPFileTransfer\domain\TransferCreator;
use BitskiPHPFileTransfer\infrastructure\FileStorage;
use BitskiPHPFileTransfer\infrastructure\PeerAuthenticator;

class TransferService
{
    private PeerAuthenticator $peerAuthenticator;
    private TransferCreator $transferCreator;
    private FileStorage $fileStorage;

    public function __construct(PeerAuthenticator $peerAuthenticator, TransferCreator $transferCreator, FileStorage $fileStorage)
    {
        $this->peerAuthenticator = $peerAuthenticator;
        $this->transferCreator = $transferCreator;
        $this->fileStorage = $fileStorage;
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

        if ( ! $this->fileStorage->saveFile($transfer)) {
            return false;
        }

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
