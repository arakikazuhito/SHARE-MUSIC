<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\Comment_replayRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $commentRepository;
    private $comment_replayRepository;

    public function __construct(
        CommentRepositoryInterface $commentRepository,
        Comment_replayRepositoryInterface $comment_replayRepository,
    ) {
        $this->commentRepository = $commentRepository;
        $this->comment_replayRepository = $comment_replayRepository;
    }

    ///コメントアクション
    public function comment(Request $request)
    {
        $comment_request = $request->all();

        $user_id = Auth::user()->id;

        $this->commentRepository->commentaction($comment_request, $user_id);

        $comment_data = $this->commentRepository->getBymusicid($comment_request)
            ->orderBy('created_at', 'desc')
            ->first();

        $comment = [
            'comment_data' => $comment_data
        ];
        return response()->json($comment);
    }

    //コメント返信アクション
    public function commentreplay(Request $request)
    {
        $comment_request = $request->all();
        $user_id = Auth::user()->id;

        $this->comment_replayRepository->comment_replayaction($comment_request, $user_id);

        $comment_data = $this->comment_replayRepository->getBymusicid($comment_request)
            ->orderBy('created_at', 'desc')
            ->first();

        $comment = [
            'comment_data' => $comment_data
        ];
        return response()->json($comment);
    }
}
