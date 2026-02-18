<?php

namespace App\Http\Controllers;

use App\Http\DTO\Request\User\ResetPasswordRequestDTO;
use App\Http\DTO\Request\User\UpdatePasswordRequestDTO;
use App\Http\DTO\Request\User\UserLoginRequestDTO;
use App\Http\DTO\Request\User\UserRegisterRequestDTO;
use App\Http\DTO\Request\User\VerifyTokenRequestDTO;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\VerifyTokenRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserController
{

    public function __construct(protected UserService $userService) {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $dto = new UserLoginRequestDTO($request->email, $request->password, $request->session());
            $result = $this->userService->login($dto);
            return response()->json($result->toArray());
        } catch (BadRequestException $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function register(RegisterRequest $request): JsonResponse {
        return response()->json(
            $this->userService->register(
                UserRegisterRequestDTO::fromArray($request->toArray()),
                $request->session()
            ),
            201
        );
    }

   public function logout(Request $request): JsonResponse
   {
       try {
           $this->userService->logout($request);
           return response()->json(['message' => 'Logout realizado com sucesso'], 200);
       } catch (BadRequestException $e) {
           return response()->json(['message' => $e->getMessage()], 500);
       }
   }

//     public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
//     {
//         try {
//             $this->userService->forgotPassword($request->email);
//             return response()->json(['message' => 'Email de recuperação enviado com sucesso'], 200);
//         } catch (BadRequestException $e) {
//             return response()->json(['message' => $e->getMessage()], 400);
//         }
//     }

//     public function verifyToken(VerifyTokenRequest $request): JsonResponse
//     {
//         try {
//             $dto = VerifyTokenRequestDTO::fromArray($request->validated());
//             $result = $this->userService->verifyToken($dto);

//             return response()->json($result, 200);
//         } catch (BadRequestException $e) {
//             return response()->json([
//                 'message' => $e->getMessage(),
//                 'valid' => false
//             ], 400);
//         }
//     }

//     public function resetPassword(ResetPasswordRequest $request): JsonResponse
//     {
//         try {
//             $dto = ResetPasswordRequestDTO::fromArray($request->validated());
//             $this->userService->resetPassword($dto);
//             return response()->json(['message' => 'Senha alterada com sucesso'], 200);
//         } catch (BadRequestException $e) {
//             return response()->json(['message' => $e->getMessage()], 400);
//         }
//     }

//     public function updatePassword(UpdatePasswordRequest $request): JsonResponse
//     {
//         try {
//             $dto = UpdatePasswordRequestDTO::fromArray($request->validated());
//             $dto->setUserId($request->user()->id);
//             $this->userService->updatePassword($dto);
//             return response()->json(['message' => 'Senha atualizada com sucesso']);
//         } catch (BadRequestException $e) {
//             return response()->json(['message' => $e->getMessage()], 400);
//         }
//     }

        // public function getUserDetails(?int $userId): JsonResponse {
        public function getUserDetails(): JsonResponse {
            return response()->json(
                // $this->userService->getUserDetails($userId)
                $this->userService->getUserDetails()
            );
        }
}
