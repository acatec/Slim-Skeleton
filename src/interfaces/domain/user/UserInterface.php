<?php
/**
 * User: ivan
 * Date: 24.02.19
 * Time: 23:29
 */

namespace eduslim\interfaces\domain\user;

interface UserInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param mixed $id
     */
    public function setId($id);

    /**
     * @return mixed
     */
    public function getUsername();

    /**
     * @param mixed $username
     */
    public function setUsername($username);

    /**
     * @return mixed
     */
    public function getPasswordHash();

    /**
     * @param mixed $password_hash
     */
    public function setPasswordHash($password_hash);
}