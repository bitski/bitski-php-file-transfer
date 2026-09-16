<?php
/**
 * Transfer service.
 *
 * @since 0.1.0
 */

namespace BitskiPHPFileTransfer\application;

use BitskiPHPFileTransfer\domain\TransferCreator;
use BitskiPHPFileTransfer\domain\TransferRepository;
use BitskiPHPFileTransfer\infrastructure\FileStorage;
use BitskiPHPFileTransfer\infrastructure\Mailer;
use BitskiPHPFileTransfer\infrastructure\PeerAuthenticator;

class TransferService
{
    private PeerAuthenticator $peerAuthenticator;
    private TransferCreator $transferCreator;
    private TransferRepository $transferRepository;
    private FileStorage $fileStorage;
    private Mailer $mailer;

    public function __construct(
        PeerAuthenticator $peerAuthenticator,
        TransferCreator $transferCreator,
        TransferRepository $transferRepository,
        FileStorage $fileStorage,
        Mailer $mailer,
    ) {
        $this->peerAuthenticator  = $peerAuthenticator;
        $this->transferCreator    = $transferCreator;
        $this->transferRepository = $transferRepository;
        $this->fileStorage        = $fileStorage;
        $this->mailer             = $mailer;
    }

    /**
     * Creates a new transfer.
     */
    public function create(): bool
    {
        if (!$this->peerAuthenticator->isPeerAuthorized()) {
            return false;
        }

        $transfer = $this->transferCreator->createTransfer();

        if (!$this->transferRepository->save($transfer)) {
            return false;
        }

        if (!$this->fileStorage->save($transfer)) {
            $this->transferRepository->delete($transfer);

            return false;
        }

        if (!$this->mailer->send($transfer)) {
            $this->fileStorage->delete($transfer);
            $this->transferRepository->delete($transfer);

            return false;
        }

        return true;
    }
}
