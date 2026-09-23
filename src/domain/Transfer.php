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
    protected string $fileName;
    protected string $mimeType;

    /**
     * @since 0.1.8
     */
    public function __construct(
        ?int $id,
        DateTimeImmutable $createdAt,
        string $initiator,
        string $recipient,
        string $fileName,
        string $mimeType,
    ) {
        $this->id        = $id;
        $this->createdAt = $createdAt;
        $this->initiator = $initiator;
        $this->recipient = $recipient;
        $this->fileName  = $fileName;
        $this->mimeType  = $mimeType;
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

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }
}
