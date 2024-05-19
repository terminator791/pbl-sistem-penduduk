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
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
{
    $this->ensureIsNotRateLimited();
    $credentials = $this->only('NIK_penduduk', 'password');
    $credentials['status_akun'] = 1;

    $users = User::where('NIK_penduduk', $credentials['NIK_penduduk'])->get();
    
    if ($users->isEmpty()){
        throw ValidationException::withMessages([
            'NIK_penduduk' => 'Akun tidak terdaftar',
        ]);
    }
    

    $authenticated = false;

    foreach ($users as $user) {
        if ($user->status_akun == 0) {
            throw ValidationException::withMessages([
                'NIK_penduduk' => trans('Akun anda sedang dinonaktifkan, coba hubungi Admin!'),
            ]);
        }
        if (Hash::check($credentials['password'], $user->password)) {
            Auth::login($user, $this->boolean('remember'));
            $authenticated = true;
            break;
        }

    }

    if (!$authenticated) {
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            // 'NIK_penduduk' => trans('auth.failed'),
            'NIK_penduduk' => 'Password yang anda masukkan salah',
            
        ]);
    }

    RateLimiter::clear($this->throttleKey());
}


    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
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
        return Str::transliterate(Str::lower($this->string('NIK_penduduk')).'|'.$this->ip());
    }
}
