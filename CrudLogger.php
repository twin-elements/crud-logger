<?php

namespace TwinElements\Component\CrudLogger;

use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CrudLogger implements CrudLoggerInterface
{
    const CreateAction = 'create';
    const EditAction = 'edit';
    const DeleteAction = 'delete';

    private string $username;

    private LoggerInterface $logger;

    public function __construct(TokenStorageInterface $tokenStorage, LoggerInterface $logger)
    {
        if (is_null($tokenStorage->getToken())) {
            throw new \Exception('User is not logged in');
        }

        $this->username = $tokenStorage->getToken()->getUserIdentifier();
        $this->logger = $logger;
    }

    public function createLog(string $entity, string $action, int $id): void
    {
        if (!in_array($action, [self::CreateAction, self::EditAction, self::DeleteAction])) {
            throw new \Exception('Action is not available');
        }

        $message = [
            'Entity: ' . $entity,
            'Action: ' . $action,
            'ID ' . $id,
            'User: ' . $this->username
        ];

        $this->logger->info(implode(' | ', $message));
    }
}
