<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

	/**
	 * Expiration var 
	 *  
	 * @var string
	 */
	protected $apiSessionExpiresIn = 1440;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Login form for creating a new resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function login(Request $request)
	{
		$credentials = $request->validate([
			'email' => ['required', 'email'],
			'password' => ['required'],
		]);
 
		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();
			return redirect()->intended('dashboard')->withCookie(
				cookie(
					'access_token',
					$this->createToken($request),
					$this->apiSessionExpiresIn
				)
			);
		}
 
		return back()->withErrors([
			'email' => 'Incorrect email or password.',
		]);
	}

	/**
	 * Create form for creating a new resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request)
	{
		$messages = [
			'email.required' => 'Email required',
			'email.unique'    => 'Email not unique in this request',
			'email.max'    => 'Email has maximum symbols',
			'password.required' => 'Password required',
			'password.max' => 'Password has maximum symbol',
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users|max:255',
			'password' => 'required|max:255',
        ], $messages);
		if ($validator->fails()) {
			$errors = $validator->messages()->get('*');
			return Redirect::back()->withErrors($errors);
		}
		$user = new User();
		$user->email = $request->get('email');
		$user->password = Hash::make($request->get('password'));
		$user->save();
		auth()->login($user);

		return Redirect::to($request->get('dashboard'))->withCookie(
			cookie(
				'access_token',
				$this->createToken($request),
				$this->apiSessionExpiresIn
			)
		);
	}

	public function createToken(Request $request)
	{
		$tokenable = json_decode($request->user()->createToken('auth')->accessToken, true);
		return DB::table('personal_access_tokens')->where('id', $tokenable["id"])->first()->token;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function showAuth(User $user)
	{
		return view('auth');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function showRegistration(User $user)
	{
		return view('registration');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user)
	{
		//
	}
}
