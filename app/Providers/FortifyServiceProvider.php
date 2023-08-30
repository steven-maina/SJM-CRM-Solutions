<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });



      Fortify::loginView(function () {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-login-cover', ['pageConfigs' => $pageConfigs]);
      });
      Fortify::registerView(function () {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-register-cover', ['pageConfigs' => $pageConfigs]);
      });
      Fortify::requestPasswordResetLinkView(function () {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-forgot-password-cover', ['pageConfigs' => $pageConfigs]);
      });
      Fortify::resetPasswordView(function (Request $request) {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-reset-password-cover', ['pageConfigs' => $pageConfigs]);
      });
      Fortify::verifyEmailView(function () {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-verify-email-cover', ['pageConfigs' => $pageConfigs]);

      });

    }
}
