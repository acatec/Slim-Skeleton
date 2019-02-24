<?php
/**
 * User: ivan
 * Date: 24.02.19
 * Time: 3:15
 */

namespace eduslim\domain\user;


use Atlas\Pdo\Connection;
use Psr\Log\LoggerInterface;

class UserManager
{
    /** @var  LoggerInterface */
    protected $logger;

    /** @var  Connection */
    protected $connection;

    /**
     * UserManager constructor.
     * @param LoggerInterface $logger
     * @param Connection $connection
     */
    public function __construct(LoggerInterface $logger, Connection $connection)
    {
        $this->logger = $logger;
        $this->connection = $connection;
    }


    public function findById($id):?User
    {
        if ($result = $this->connection->fetchObject('select * from user where id=:id', ['id' => $id], User::class)) {
            return $result;
        }
        return null;
    }


    /**
     * @return User[]|null
     */
    public function findAll():?array
    {
        return $this->connection->fetchObjects('select * from user', [], User::class);
    }


    public function save(User $user)
    {
        try {
            if ($user->getId()) {
                $this->connection->perform('UPDATE user SET username=:user, password_hash=:password where id=:id;',
                    [
                        'id' => $user->getId(),
                        'user' => $user->getUsername(),
                        'password' => $user->getPasswordHash(),
                    ]);
            } else {
                $this->connection->perform('insert into user (username, password_hash) VALUES (:user, :password);',
                    [
                        'user' => $user->getUsername(),
                        'password' => $user->getPasswordHash(),
                    ]);
                $id = $this->connection->lastInsertId();
                $user->setId($id); // todo via reflection
            }
            return true;
        } catch (\PDOException $e) {
            $this->logger->error($e->getMessage(), [
                'trace' => $e->getTrace(),
            ]);
            return false;
        }
    }

    public function install()
    {
        $sql = <<<SQL
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
);
SQL;

        $this->connection->query($sql);
    }

}