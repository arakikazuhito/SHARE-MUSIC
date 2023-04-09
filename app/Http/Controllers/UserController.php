<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Exception;
use Mockery\Expectation;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
    ) {
        $this->userRepository = $userRepository;
    }

    //ログインページ
    public function login()
    {
        return view('page.login');
    }

    //ログイン処理
    public function logincomplete(LoginRequest $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerateToken();
            return redirect()->route('top');
        } else {
            return back()->withErrors([
                'login_error' => 'ログインに失敗しました',
            ]);
        }
    }

    //パスワードリセットページ
    public function passwordreset()
    {
        return view('page.passwordreset');
    }

    //新規登録ページ
    public function signup()
    {
        return view('page.signup');
    }

    //新規登録完了ページ
    public function register(UserPostRequest $request)
    {
        $user = $request->all();
        try {
            $this->userRepository->storeuser($user);
            Log::info(__METHOD__ . '...アカウントを作成しました。');
            $request->session()->regenerateToken();
            return view('page.register');
        } catch (Exception $e) {
            Log::error(__METHOD__ . '...ユーザーアカウント作成に失敗しました。...error_message = ' . $e);
            return back()
                ->withErrors(['signup_error' => 'アカウント作成に失敗しました。']);
        }
    }

    //ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('top');
    }

    public function other_user($id)
    {
        $user_data = $this->userRepository->findByUserId($id);
        $music_data = $this->userRepository->findByUserId_music($id);

        return view(
            'page.other_user',
            [
                'user_data' => $user_data,
                'music_data' => $music_data
            ]
        );
    }

    //マイページ
    public function user_detail()
    {
        $id = Auth::id();
        $user_data = $this->userRepository->findByUserId($id);
        $music_data = $this->userRepository->findByUserId_music($id);

        return view(
            'page.user_detail',
            [
                'user_data' => $user_data,
                'music_data' => $music_data
            ]
        );
    }

    //ユーザ編集画面
    public function edit()
    {
        $id = Auth::id();
        $user_data = $this->userRepository->findByUserId($id);

        return view('page.user_edit', [
            'user_data' => $user_data
        ]);
    }

    //ユーザ更新処理
    public function edit_complete(UserEditRequest $request)
    {
        $id = Auth::id();
        $user_data  = $this->userRepository->findByUserId($id);
        $user   = $request->all();
        $user_image = $request->file('image');

        if (!empty($user_image)) {
            $user['update_image'] = $user_image->getClientOriginalName();
            try {
                $this->userRepository->editUser($user, $id);
                $user_image->move(storage_path() . '/app/public/img/user_img', $user['update_image']);
            } catch (Expectation $e) {
                Log::error(__METHOD__ . '...ユーザーアカウント編集に失敗しました。...error_message = ' . $e);
                return back()
                    ->withErrors(['user_edit_error' => 'アカウント編集に失敗しました。']);
            }
            return view('page.edit_complete');
        } else {
            $user['update_image'] = $user_data['image'];
            try {
                $this->userRepository->editUser($user, $id);
            } catch (Expectation $e) {
                Log::error(__METHOD__ . '...ユーザーアカウント編集に失敗しました。...error_message = ' . $e);
                return back()
                    ->withErrors(['user_edit_error' => 'アカウント編集に失敗しました。']);
            }
            return view('page.edit_complete');
        }
    }
}
