<?php

use App\DbProvider\Db;
use App\User\Factory\UserFactory;
use App\Service\Logger;
use App\Service\UserService;
use App\User\Storage\CachedUserStorageDecorator;
use App\User\Storage\Memcache\KeyGenerator\MemcacheKeyGenerator;
use App\User\Storage\Result\Factory\UserStorageFindByIdsResultFactory;
use App\User\Storage\Result\Serializer\UserStorageFindByIdsResultSerializer;
use App\User\Storage\UserStorage;
use Error\Factory\ErrorFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

require_once('vendor/autoload.php');

$logger = new Logger();
$db     = new Db();

$userFactory = new UserFactory();
$errorFactory = new ErrorFactory();
$resultFactory = new UserStorageFindByIdsResultFactory();
$userStorage = new UserStorage($logger, $db, $userFactory, $errorFactory, $resultFactory);

$memcached = new Memcached('', null, '');
$memcached->addServer('localhost', 11211);

$keyGenerator = new MemcacheKeyGenerator();
$serializer = new UserStorageFindByIdsResultSerializer($resultFactory);
$userStorageCached = new CachedUserStorageDecorator($userStorage, $memcached, $keyGenerator, $serializer);

$userService = new UserService($userStorageCached);

$request = Request::createFromGlobals();
$id = $request->get('id');
$userVisits = $userService->getUserVisits($id);

return new JsonResponse(['user_visits' => $userVisits]);
