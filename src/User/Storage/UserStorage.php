<?php

declare(strict_types=1);

namespace App\User\Storage;

use App\DbProvider\DatabaseProviderInterface;
use App\User\Factory\UserFactoryInterface;
use App\User\UserInterface;
use App\User\Storage\Result\Factory\UserStorageFindByIdsResultFactoryInterface;
use App\User\Storage\Result\UserStorageFindByIdsResultInterface;
use Error\Factory\ErrorFactoryInterface;
use Generator;
use Psr\Log\LoggerInterface;

class UserStorage implements UserStorageInterface
{
    private LoggerInterface $logger;

    private DatabaseProviderInterface $db;

    private UserFactoryInterface $userFactory;

    private UserStorageFindByIdsResultFactoryInterface $userStorageFindByIdsResultFactory;

    private ErrorFactoryInterface $errorFactory;

    public function __construct(
        LoggerInterface $logger,
        DatabaseProviderInterface $db,
        UserFactoryInterface $userFactory,
        ErrorFactoryInterface $errorFactory,
        UserStorageFindByIdsResultFactoryInterface $userStorageFindByIdsResultFactory
    ) {
        $this->logger = $logger;
        $this->db = $db;
        $this->userFactory = $userFactory;
        $this->errorFactory = $errorFactory;
        $this->userStorageFindByIdsResultFactory = $userStorageFindByIdsResultFactory;
    }

    public function findById(string $id): ?UserInterface
    {
        $result = null;

        try {
            $rows = $this->db->execute(sprintf('SELECT * FROM User WHERE id = %s;', $id));
            if ([] !== $rows) {
                $row = array_pop($rows);
                $result = $this->createUserFromRow($row);
            }
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
        }

        return $result;
    }

    public function findByIds(array $ids): UserStorageFindByIdsResultInterface
    {
        try {
            $rows = $this->db->execute(sprintf('SELECT * FROM User where id in (%s)', implode(',', $ids)));
            $count = count($rows);
            //todo make 1 query for users and count

            $result = $this->userStorageFindByIdsResultFactory->createSuccess(
                $count,
                $this->createUsersFromRows($rows)
            );

        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());

            //TODO
            $error = $this->errorFactory->create('db.error', $exception->getMessage());

            $result = $this->userStorageFindByIdsResultFactory->createError($error);
        }

        return $result;
    }

    // move to serializer
    private function createUsersFromRows(array $rows): Generator
    {
        foreach ($rows as $row) {
            yield $this->createUserFromRow($row);
        }
    }

    private function createUserFromRow(array $row): UserInterface
    {
        return $this->userFactory->create(
            $row['id'],
            $row['name'],
            $row['view_count'],
        );
    }

    public function create(UserInterface $user): bool
    {
        // TODO: Implement create() method.
    }

    public function replace(UserInterface $oldUser, UserInterface $newUser): bool
    {
        // TODO: Implement replace() method.
    }
}
