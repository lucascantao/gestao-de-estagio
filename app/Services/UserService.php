<?php

namespace App\Services;

use App\Http\DTO\Request\User\ResetPasswordRequestDTO;
use App\Http\DTO\Request\User\UpdatePasswordRequestDTO;
use App\Http\DTO\Request\User\UserLoginRequestDTO;
use App\Http\DTO\Request\User\UserRegisterRequestDTO;
use App\Http\DTO\Request\User\VerifyTokenRequestDTO;
use App\Http\DTO\Response\User\UserAuthResponseDTO;
use App\Repositories\Interface\UserRepository;
use App\utils\traits\ExceptionTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserService {

    use ExceptionTrait;

    public function __construct(
        protected UserRepository $userRepository
    ) {}

    public function login(UserLoginRequestDTO $dto): UserAuthResponseDTO {
        $user = $this->userRepository->findByEmail($dto->getEmail());

        if (!$user || !Hash::check($dto->getPassword(), $user->password)) {
            throw new BadRequestException('Credenciais inválidas');
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return UserAuthResponseDTO::fromAuthSuccess('Login realizado com sucesso', $user, $token);
    }

    public function register(UserRegisterRequestDTO $dto): UserAuthResponseDTO {
        // se for cadastro de Supervisor, anular o id e deixar em espera
        if ($dto->getRoleId() == 1) {
            $dto->setRoleId(null);
        }
        $user = $this->userRepository->store($dto->toInsertArray());
        $userModel = $this->userRepository->findUserById($user->getAttribute('id'));
        $token = $user->createToken($user->getAttribute('name') . '_auth_token')->plainTextToken;
        return UserAuthResponseDTO::fromAuthSuccess('Usuário registrado com sucesso', $userModel, $token);
    }

//    public function logout(int $userId): array
//    {
//        $user = $this->userRepository->findById($userId);

//        if (!$user) {
//            throw new BadRequestException('Usuário não encontrado');
//        }

//        try {
//            $user->tokens()->delete();
//            return ['message' => 'Logout realizado com sucesso'];
//        } catch (\Exception $e) {
//            throw new BadRequestException('Erro ao deslogar usuário: ' . $e->getMessage());
//        }
//    }

//     public function forgotPassword(string $email): void
//     {
//         $user = $this->userRepository->findByEmail($email);
//         if (!$user) {
//             throw new BadRequestException('Email não encontrado');
//         }

//         $token = strtoupper(Str::random(6));

//         $data = [
//             'assunto' => 'Recuperação de senha',
//             'nome' => $user->name,
//             'email' => $user->email,
//             'token' => $token,
//         ];

//         Cache::put("password_reset_{$email}", $token, now()->addMinutes(5));

//         try {
//             Log::info('Tentando enviar email de recuperação', ['email' => $email]);

//             Mail::send(new PasswordReminderMailable($data));

//             Log::info('Email enviado com sucesso', ['email' => $email]);
//         } catch (\Exception $e) {
//             Log::error('Erro ao enviar email', [
//                 'email' => $email,
//                 'error' => $e->getMessage(),
//                 'trace' => $e->getTraceAsString()
//             ]);
//             throw new BadRequestException('Erro ao enviar email de recuperação: ' . $e->getMessage());
//         }
//     }

//     public function verifyToken(VerifyTokenRequestDTO $dto): array
//     {
//         $isValid = $this->userRepository->validateResetToken(
//             $dto->getEmail(),
//             $dto->getToken()
//         );

//         if (!$isValid) {
//             throw new BadRequestException('Token inválido ou expirado');
//         }

//         return [
//             'message' => 'Token válido',
//             'valid' => true
//         ];
//     }

//     public function resetPassword(ResetPasswordRequestDTO $dto): void
//     {
//         $user = $this->userRepository->findByEmail($dto->getEmail());
//         if (!$user) {
//             throw new BadRequestException('Usuário não encontrado');
//         }

//         if (!$this->userRepository->validateResetToken($dto->getEmail(), $dto->getToken())) {
//             throw new BadRequestException('Token inválido ou expirado');
//         }

//         $this->userRepository->updatePassword($user->id, $dto->getPassword());
//         Cache::forget("password_reset_{$dto->getEmail()}");
//     }


//     public function updatePassword(UpdatePasswordRequestDTO $dto): void
//     {
//         $user = $this->userRepository->findById($dto->getUserId());
//         if (!$user || !Hash::check($dto->getCurrentPassword(), $user->password)) {
//             throw new BadRequestException('Senha atual inválida');
//         }

//         $this->userRepository->updatePassword($user->id, $dto->getPassword());
//     }
}
