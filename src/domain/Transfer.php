<?php
/**
 * Transfer (Domain Entity).
 *
 * @since 0.1.2
 */

namespace BitskiPHPFileTransfer\domain;

use DateTimeImmutable;

class Transfer
{
    protected int $id;
    protected DateTimeImmutable $createdAt;
    protected string $initiator;
    protected string $recipient;
    protected string $mimeType;
    protected string $fileName;

    /**
     * @since 0.1.8
     */
    public function __construct(
        int $id,
        DateTimeImmutable $createdAt,
        string $initiator,
        string $recipient,
        string $mimeType,
        string $fileName,
    ) {
        $this->id        = $id;
        $this->createdAt = $createdAt;
        $this->initiator = $initiator;
        $this->recipient = $recipient;
        $this->mimeType  = $mimeType;
        $this->fileName  = $fileName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getInitiator(): string
    {
        return $this->initiator;
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }
}
