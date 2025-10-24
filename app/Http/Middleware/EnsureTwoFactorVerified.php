<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        if (! $user->is_2fa_verified) {
            return response()->json(['message' => 'Two-factor authentication not verified.'], 403);
        }

        // Optional: check TTL (e.g., 15 minutes)
        $ttlMinutes = config('auth.2fa_ttl', 15); // default 15
        if ($user->otp_verified_at) {
            $diff = Carbon::now()->diffInMinutes($user->otp_verified_at);
            if ($diff > $ttlMinutes) {
                // expire 2FA state
                $user->is_2fa_verified = false;
                $user->otp_code = null;
                $user->otp_verified_at = null;
                $user->save();

                return response()->json(['message' => 'Two-factor auth expired. Please verify again.'], 403);
            }
        } else {
            // no verified_at set (defensive)
            return response()->json(['message' => 'Two-factor authentication not verified.'], 403);
        }

        return $next($request);

    }
}
