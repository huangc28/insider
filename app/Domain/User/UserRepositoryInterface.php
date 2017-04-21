<?php
namespace App\Domain\User;

interface UserRepositoryInterface
{
    public function findUserByEmail($email);
}
