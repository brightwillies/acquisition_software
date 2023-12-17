<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\Purchaser;
use App\Models\Administrator;
use App\Models\DepartmentHead;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Auth::viaRequest('admin-jwt', function ($request) {
            $secret = config('app.key');
            $headers = apache_request_headers();
            $authorization = "";

            if (isset($headers["authorization"])) {
                $authorization = $headers["authorization"];
            }

            if (isset($headers["Authorization"])) {
                $authorization = $headers["Authorization"];
            }

            $exploded = explode(" ", $authorization);
            $token = isset($exploded[1]) ? $exploded[1] : "";

            if ($token && strlen($token) > 0) {
                try {
                      $user= JWT::decode($token, new Key(config("app.key"), 'HS256'));
                    // $user = JWT::decode($token, $secret, array("HS256"));
                    if (!$user) {
                        throw new \Exception;
                    }

                } catch (\Exception $e) {
                    return null;
                }

                $admin = Administrator::find($user->id);
                $request->merge(['added_by' => $admin->id]);
                return Administrator::find($user->id);
            }

            return null;
        });
        //


        Auth::viaRequest('purchaser-jwt', function ($request) {
            $secret = config('app.key');
            $headers = apache_request_headers();
            $authorization = "";

            if (isset($headers["authorization"])) {
                $authorization = $headers["authorization"];
            }

            if (isset($headers["Authorization"])) {
                $authorization = $headers["Authorization"];
            }

            $exploded = explode(" ", $authorization);
            $token = isset($exploded[1]) ? $exploded[1] : "";

            if ($token && strlen($token) > 0) {
                try {
                      $user= JWT::decode($token, new Key(config("app.key"), 'HS256'));
                    // $user = JWT::decode($token, $secret, array("HS256"));
                    if (!$user) {
                        throw new \Exception;
                    }

                } catch (\Exception $e) {
                    return null;
                }
                $admin = Purchaser::find($user->id);
                $request->merge(['added_by' => $admin->id]);
                return Purchaser::find($user->id);
            }

            return null;
        });

        Auth::viaRequest('hod-jwt', function ($request) {
            $secret = config('app.key');
            $headers = apache_request_headers();
            $authorization = "";

            if (isset($headers["authorization"])) {
                $authorization = $headers["authorization"];
            }

            if (isset($headers["Authorization"])) {
                $authorization = $headers["Authorization"];
            }

            $exploded = explode(" ", $authorization);
            $token = isset($exploded[1]) ? $exploded[1] : "";

            if ($token && strlen($token) > 0) {
                try {
                      $user= JWT::decode($token, new Key(config("app.key"), 'HS256'));
                    // $user = JWT::decode($token, $secret, array("HS256"));
                    if (!$user) {
                        throw new \Exception;
                    }

                } catch (\Exception $e) {
                    return null;
                }
                $admin = DepartmentHead::find($user->id);
                $request->merge(['added_by' => $admin->id]);
                return DepartmentHead::find($user->id);
            }

            return null;
        });
    }
}
