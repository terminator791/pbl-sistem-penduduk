<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'NIK_penduduk' => ['required', 'string'],
            'password' => ['required', 'string'],
            'level' => ['required', 'string', 'in:admin,RT,RW,pemilik_kos'], // Added level validation
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function authenticate(): void
    // {
    //     $this->ensureIsNotRateLimited();
    //     $credentials = $this->only('NIK_penduduk', 'password');
    //     $credentials['status_akun'] = 1;
    //     $level = $this->input('level'); // Get the level from the request

    //     $users = User::where('NIK_penduduk', $credentials['NIK_penduduk'])->where('level', $level)->get();

    //     if ($users->isEmpty()) {
    //         throw ValidationException::withMessages([
    //             'NIK_penduduk' => 'Akun tidak terdaftar',
    //         ]);
    //     }

    //     $authenticated = false;

    //     foreach ($users as $user) {
    //         if ($user->status_akun == 0) {
    //             throw ValidationException::withMessages([
    //                 'NIK_penduduk' => trans('Akun anda sedang dinonaktifkan, coba hubungi Admin!'),
    //             ]);
    //         }
    //         if (Hash::check($credentials['password'], $user->password) && $user->level == $level) {
    //             Auth::login($user, $this->boolean('remember'));
    //             $authenticated = true;
    //             break;
    //         }
    //     }

    //     if (!$authenticated) {
    //         RateLimiter::hit($this->throttleKey());

    //         throw ValidationException::withMessages([
    //             'NIK_penduduk' => 'Password yang anda masukkan salah atau NIK tidak cocok',
    //         ]);
    //     }

    //     RateLimiter::clear($this->throttleKey());
    // }
    public function authenticate(): void
{
    $this->ensureIsNotRateLimited();

    $credentials = $this->only('NIK_penduduk', 'password');
    $level = $this->input('level'); // Get the level from the request

    // Fetch users with the given NIK and level
    $users = User::where('NIK_penduduk', $credentials['NIK_penduduk'])
                 ->where('level', $level)
                 ->get();

    if ($users->isEmpty()) {
        throw ValidationException::withMessages([
            'NIK_penduduk' => 'Akun tidak terdaftar',
        ]);
    }

    $activeUsers = $users->filter(function ($user) {
        return $user->status_akun == 1;
    });

    if ($activeUsers->isEmpty()) {
        throw ValidationException::withMessages([
            'NIK_penduduk' => trans('Akun anda sedang dinonaktifkan, coba hubungi Admin!'),
        ]);
    }

    foreach ($activeUsers as $user) {
        if (Hash::check($credentials['password'], $user->password)) {
            Auth::login($user, $this->boolean('remember'));
            RateLimiter::clear($this->throttleKey());
            return;
        }
    }

    RateLimiter::hit($this->throttleKey());

    throw ValidationException::withMessages([
        'NIK_penduduk' => 'Password yang anda masukkan salah atau NIK tidak cocok',
    ]);
}

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'NIK_penduduk' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('NIK_penduduk')) . '|' . $this->ip());
    }
}
