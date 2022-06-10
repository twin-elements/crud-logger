<?php

namespace TwinElements\Component\CrudLogger;

interface CrudLoggerInterface
{
    public function createLog(string $entity, string $action, int $id): void;
}
