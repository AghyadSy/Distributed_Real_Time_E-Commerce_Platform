<?php

namespace App\Modules\Identity\Presentation\Http\Middleware;

use App\Modules\Identity\Domain\Enums\UserRole;
use App\Shared\Http\Responses\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class EnsureUserHasRole
{
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {
        $user = $request->user();

        if (! $user) {
            return ApiResponse::error(
                message: 'Unauthenticated.',
                code: 401,
            );
        }

        $validRoles = array_map(
            static fn (UserRole $role): string => $role->value,
            UserRole::cases(),
        );

        foreach ($roles as $role) {
            if (! in_array($role, $validRoles, true)) {
                return ApiResponse::error(
                    message: 'Invalid role configuration.',
                    code: 500,
                );
            }
        }

        if (! in_array($user->role, $roles, true)) {
            return ApiResponse::error(
                message: 'You are not authorized to perform this action.',
                code: 403,
            );
        }

        return $next($request);
    }
}
