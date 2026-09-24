<?php
/**
 * Transfer service.
 *
 * @since 0.1.0
 */

namespace BitskiPHPFileTransfer\application;

use BitskiPHPFileTransfer\domain\TransferCreator;
use BitskiPHPFileTransfer\infrastructure\FileStorage;
use BitskiPHPFileTransfer\infrastructure\Mailer;
use BitskiPHPFileTransfer\infrastructure\PeerAuthenticator;
use BitskiPHPFileTransfer\infrastructure\TransferCleanup;
use BitskiPHPFileTransfer\infrastructure\TransferRepository;

class TransferService
{
    private PeerAuthenticator $peerAuthenticator;
    private TransferCleanup $transferCleanup;
    private TransferCreator $transferCreator;
    private TransferRepository $transferRepository;
    private FileStorage $fileStorage;
    private Mailer $mailer;

    public function __construct(
        PeerAuthenticator $peerAuthenticator,
        TransferCleanup $transferCleanup,
        TransferCreator $transferCreator,
        TransferRepository $transferRepository,
        FileStorage $fileStorage,
        Mailer $mailer,
    ) {
        $this->peerAuthenticator  = $peerAuthenticator;
        $this->transferCleanup    = $transferCleanup;
        $this->transferCreator    = $transferCreator;
        $this->transferRepository = $transferRepository;
        $this->fileStorage        = $fileStorage;
        $this->mailer             = $mailer;
    }

    /**
     * Creates a new transfer.
     */
    public function create(array $formData): bool
    {
        $initiator = $this->peerAuthenticator->getAuthorizedPeer();

        if ($initiator === false) {
            return false;
        }

        $recipient = $formData['recipient'];
        $file      = $formData['file'];
        $fileName  = $file['name'];
        $mimeType  = $file['type'];

        $this->transferCleanup->cleanup();

        /*
         * Creates the transfer without a persistence ID.
         *
         * The persistence layer generates the ID during saving, which is then assigned
         * to the transfer before continuing with the rest of the workflow.
         */
        $transfer = $this->transferCreator->createTransfer(
            $initiator,
            $recipient,
            $fileName,
            $mimeType,
        );

        $transferId = $this->transferRepository->save($transfer);

        if ($transferId === null) {
            return false;
        }

        $transfer->assignId($transferId);

        if (!$this->fileStorage->save($transfer, $file)) {
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
