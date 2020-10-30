<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Permission;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TestController extends Controller
{
    public function index() {

    }

    public function testSendEmail() {
        $data = array(
            'name' => "TEST TEST TEST 7",
        );

        Mail::send('mails.test.email', $data, function ($message) {
            $message->from('yourEmail@domain.com', 'Learning Laravel');
            $message->to('yourEmail@domain.com')->subject('Learning Laravel test email');
        });
        return "Your email has been sent successfully";
    }

    public function testingInertia() {
        return Inertia::render('Test/Test');
    }

    public function testingPermissions()
    {
        $user = auth()->user();
        //$user = User::find(1);

        //dd(Gate::abilities());
        //dd($user->roles);
        //dd($user->email);
        //dd($user->hasAnyRole('developer') );
        //dd($user->hasAnyRole(['developer', 'manager']) );
        //dd($user->hasPermissionTo('create-tasks'));
        //dd($user->hasPermissionTo('delete-users') );
        //dd($user->hasPermissionToUserGiven('create-tasks', $user));

        // Policy and Gates AuthServiceProvider
        //dd($user->can('create-tasks1'));

        // allows manage-users
        // deny   create-tasks

        //  throw an AuthorizationException
        // 403 | THIS ACTION IS UNAUTHORIZED.
        //Gate::authorize('create-tasks');


        // Return a Response with True or False
        //$response = Gate::inspect('manage-users');
        $response_authorize = Gate::inspect('create-tasks');
        if ($response_authorize->allowed()) {
            // The action is authorized...
            dd('The action is authorized...');
        } else {
            echo $response_authorize->message();
        }

        if (Gate::check('manage-users')) {
            dd('Admin allowed2');
        } else {
            dd('You are not Admin3');
        }

        if (Gate::allows('create-tasks')) {
            // dd('Admin allowed2');
        } else {
            // dd('You are not Admin3');
        }


        foreach ($user->roles as $role) {
            dump($role);
            dump($role->pivot);
            //dump($role->pivot->role_id);
            dump($role->permissions);
            foreach ($role->permissions as $permission) {
                dump($permission);
                dump($permission->pivot);
                dump($permission->pivot->permission_id);
            }

        }
        // dd($user->hasRole('developer')); // will return true
        // dd($user->givePermissionsTo('manage-users'));

        if (!Auth::user()->hasPermissionTo('Edit Post')) {
            abort('401');
        } else {
            return $next($request);
        }
        /* BLADE
                @can('isAdmin')
                    <div class="btn btn-success btn-lg">
                        You have Admin Access
                    </div>
                @elsecan('isManager')
                    <div class="btn btn-primary btn-lg">
                        You have Manager Access
                    </div>
                @else
                    <div class="btn btn-info btn-lg">
                        You have User Access
                    </div>
                @endcan
        */

    }

    public function someAdminStuff(Request $request)
    {
        $request->user()->authorizeRoles(['employee', 'manager']);
        $request->user()->authorizeRoles(['manager']);
        return view('some.view');
    }

    public function getDataFromPivotTable() {
        $pivot_entries  = DB::table('professor_turma')
            ->where('pivot_column 1', 'pivot value 1')
            ->where('pivot_column_2', 'pivot value 2')
            ->get();
    }

}
