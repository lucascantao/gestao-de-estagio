<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\TwoFactorAuthenticationProvider;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class TwoFactorController
{

    private $enable2FAAction;
    private $disable2FAAction;
    private $provider;

    public function __construct(
        protected UserService $userService
    ) {
        $this->enable2FAAction = app(EnableTwoFactorAuthentication::class);
        $this->disable2FAAction = app(DisableTwoFactorAuthentication::class);
        $this->provider = app(TwoFactorAuthenticationProvider::class);
    }

    public function activate(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            ($this->enable2FAAction)($user);

            if (!$user->hasEnabledTwoFactorAuthentication()) {
                throw new BadRequestException('Erro ao ativar Autenticação 2FA');
            }
            
            $qrCodeSvg = $user->twoFactorQrCodeSvg();
            $recoveryCodes = $user->recoveryCodes();

            return response()->json(
                [
                    'message' => 'success', 
                    'recoveryCodes' => $recoveryCodes,
                    'svg' => $qrCodeSvg
                ], 
                200
            );
        } catch (BadRequestException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function confirm(Request $request): JsonResponse {
        try {
            $user = $request->user();
            $valid = $this->provider->verify(
                $user, $request->code
            );
            if($valid) {
                $user->forceFill([
                    'two_factor_confirmed_at' => now()
                ])->save();
                return response()->json(['message' => 'success'], 200);
            }
            return response()->json(['message' => 'Código de autenticação inválido'], 401);
        } catch (BadRequestException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function recoveryCode(Request $request): JsonResponse {
        try {
            $user = $request->user();
            $codes = $user->recoveryCodes();
            dd($codes);

            // $valid = $this->provider->verify(
            //     $user, $request->code
            // );
            // if($valid) {
            //     $user->forceFill([
            //         'two_factor_confirmed_at' => now()
            //     ])->save();
            //     return response()->json(['message' => 'success'], 200);
            // }
            return response()->json(['message' => 'Código de autenticação inválido'], 401);
        } catch (BadRequestException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function delete(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            ($this->disable2FAAction)($user);

            if($user->hasEnabledTwoFactorAuthentication()) {
                throw new BadRequestException('Erro ao desativar Autenticação 2FA');
            }

            return response()->json(['message' => 'success'], 200);
        } catch (BadRequestException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
