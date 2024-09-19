<?php


namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

class RoleBaseAuthorization
{
    public $route;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $openRoutes = ['dashboard'];
        if (Auth::User()->role_id === 1) {
            return $next($request);
        }
        if(in_array(Route::current()->getName(), $openRoutes)){
            return $next($request);
        }
        
        $role = User::whereHas('role.rolePermissions.permission', function ($query) {
            //$query->where(['permissions.code_name' => Route::current()->getName()]);
            $query->whereRaw('FIND_IN_SET("' . Route::current()->getName() . '", route_name)');
        })->where('id', Auth::User()->id)->count();

        if (!$role) {

            $user = User::whereHas('userPermissions.permission', function ($query) {
                //$query->where(['permissions.code_name' => Route::current()->getName()]);
                $query->whereRaw('FIND_IN_SET("' . Route::current()->getName() . '", route_name)');
            })->where('id', Auth::User()->id)->count();
            if (!$user) {

                if ($request->ajax()) {
                    return response([
                        'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                        'message' => 'You are not authorized to perform this action.'
                    ], Response::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    $referer = $request->header('referer');
                    if (empty($referer) || $referer == url()->current()) {
                        return redirect(route('home'))->with(['role_error' => 'You are not authorized to access to this page.']);
                    } else {
                        return redirect()->back()->with(['role_error' => 'You are not authorized to access to this page.']);
                    }
                }
            }
        }
        return $next($request);
    }
}
