<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Music;
use App\Models\Like;
use App\Models\Comment;
use App\Repositories\Interfaces\MusicRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\LikeRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\MusicPostRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class MusicController extends Controller
{

    private $musicRepository;
    private $userRepository;
    private $commentRepository;
    private $likeRepository;

    public function __construct(
        MusicRepositoryInterface $musicRepository,
        UserRepositoryInterface $userRepository,
        CommentRepositoryInterface $commentRepository,
        LikeRepositoryInterface $likeRepository,
    ) {
        $this->musicRepository = $musicRepository;
        $this->userRepository = $userRepository;
        $this->commentRepository = $commentRepository;
        $this->likeRepository = $likeRepository;
    }

    public function top()
    {
        $new_data = $this->musicRepository->getallMusic()->orderBy('music.created_at', 'desc')->get();
        $ranking_data = $this->musicRepository->getallMusic()->orderBy('likes_count', 'desc')->get();
        return view('page.top', [
            'new_data' => $new_data,
            'ranking_data' => $ranking_data
        ]);
    }

    public function serch(Request $request)
    {
        $keyword = $request->input('serch');
        if (!empty($keyword)) {
            $music_data = $this->musicRepository->serchMusic($keyword)->get();
            $user_data = $this->userRepository->serchUser($keyword)->get();
            return view('page.serch', compact('music_data', 'user_data', 'keyword'));
        } else {
            return view('page.serch', compact('keyword'));
        }
    }

    public function like(Request $request)
    {

        $user_id = Auth::user()->id;
        $music_id = $request->music_id;
        $already_liked = $this->likeRepository->getLike($user_id, $music_id);

        if (!$already_liked) {
            $this->likeRepository->storeLike($music_id, $user_id);
        } else {
            $this->likeRepository->deleteLike($music_id, $user_id);
        }

        $music_likes_count = $this->likeRepository->countLike($music_id);

        $param = [
            'music_likes_count' => $music_likes_count,
        ];
        return response()->json($param);
    }

    public function music_detail($id, $user_id)
    {

        $music_data = $this->musicRepository->findByMusicId($id);
        $user_data  = $this->userRepository->findByUserId($user_id);

        /*if (!Comment::exists('comments.music_id', $id)) {

            return view('page.music_detail', [
                'music_data' => $music_data,
                'user_data' => $user_data,
            ]);
        } else {
*/
        $comments = $this->commentRepository->commentByMusicid($id)->get();

        return view('page.music_detail', [
            'music_data' => $music_data,
            'user_data' => $user_data,
            'comments' => $comments,
        ]);
    }

    public function post()
    {
        $categories = Categories::all();
        return view('page.music_post')->with([
            'categories' => $categories
        ]);
    }

    public function confirm(MusicpostRequest $request)
    {
        $music_data = $request->all();

        //画像データ
        $music_image = $request->file('image');
        if (isset($music_image)) {
            $image_name = $music_image->getClientOriginalName(); //画像の名前を取得
            $new_image_name = date('YmdHis') . $image_name; //画像の新しい名前

            $music_image->move(public_path() . '/img/tmp', $new_image_name); //画像ファイルの移動
            $image = $new_image_name; //画像のパス名

        } else {
            $image = 'no_image500.jpeg';
        }

        //音楽データ
        $music_audio = $request->file('music_path');
        if (isset($music_audio)) {
            $music_name = $music_audio->getClientOriginalName(); //曲の名前
            $new_music_name = date('YmdHis') . $music_name; //曲の新しい名前


            $music_audio->move(public_path() . '/audio/tmp', $new_music_name); //曲ファイルの移動
            $music_path = $new_music_name; //曲のパス名
        }

        return view(
            'page.music_confirm',
            [
                'image' => $image,
                'music_path' => $music_path,
                'music_data' => $music_data
            ]
        );
    }


    public function complete(Request $request)
    {
        $action = $request->input('action');
        $music_data = $request->except('action');
        $music_data['user_id'] = Auth::user()->id;

        try {
            File::copy(public_path() . '/img/tmp/' . $music_data['image'], storage_path() . '/app/public/img/' . $music_data['image']);
            File::delete(public_path() . '/img/tmp/' . $music_data['image']);
            File::copy(public_path() . '/audio/tmp/' . $music_data['music_path'], storage_path() . '/app/public/audio/' . $music_data['music_path']);
            File::delete(public_path() . '/audio/tmp/' . $music_data['music_path']);
            $this->musicRepository->storeMusic($music_data);
            $request->session()->regenerateToken();
        } catch (Exception $e) {
            Log::error(__METHOD__ . ' 楽曲の投稿に失敗しました。 error_message = ' . $e);
            return redirect()->route('post')->withErrors(['post_errors' => '投稿に失敗しました初めからやり直してください']);
        }


        if ($action == "back") {
            return redirect()->route('post')->withInput($music_data);
        } elseif ($action == "send") {
            return view('page.musiccomplete');
        }
    }
}
