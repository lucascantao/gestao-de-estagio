<?php

namespace App\Repositories\Interface;

use App\Models\UserModel;
use App\Repositories\Interface\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepository extends BaseRepository {
 public function findUserById(int $id): ?UserModel;
    public function findByEmail(string $email): ?UserModel;
    // public function createUser(array $data): UserModel;
    // public function updateUser(UserModel $user, array $data): ?UserModel;
    // public function updatePassword(int $id, string $password): ?UserModel;
    // public function updatePasswordDirect(int $id, string $encryptedPassword): ?UserModel;
    // public function enableUser(int $userId): ?bool;
    // public function validateResetToken(string $email, string $token): bool;
    // public function listAllUsers(int $page, int $perPage, ?string $search, ?string $sort, ?string $direction): LengthAwarePaginator;
    // public function softDelete(int $id): void;
}
