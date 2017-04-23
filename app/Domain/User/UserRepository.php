<?php namespace App\Domain\User;

class UserRepository implements UserRepositoryInterface
{

    /**
     * User model instance
     *
     * @var \App\Domain\User\User
     * @return void
     */
    protected $user;

    /**
     * Create instance of UserRepository
     *
     * @param \App\Domain\User\UserRepository
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Find user by email
     *
     * @param email
     */
     public function findUserByEmail($email)
     {
        $user = $this->user->newQuery()->where('email', $email)->first();

        return $user;
     }
}
