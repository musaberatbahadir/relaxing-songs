<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\Error;
use App\UserSongFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ApiResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'song_id' => 'required|numeric|exists:songs,id',
        ]);

        if ($validator->fails()) {
            return ApiResponse::error(new Error('fav400'));
        }

        $checkRecord = UserSongFavorite::where('user_id', $request->user()->id)
            ->where('song_id', $request->input('song_id'))
            ->first();

        if ($checkRecord) {
            return ApiResponse::error(new Error('fav406'));
        } else {
            $favRecord = new UserSongFavorite();
            $favRecord->user_id = $request->user()->id;
            $favRecord->song_id = $request->input('song_id');

            $favRecord->save();
            return ApiResponse::success($favRecord);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return ApiResponse
     */
    public function show(Request $request)
    {
        return ApiResponse::success(
            $request->user()->favorites
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $songId
     * @return ApiResponse
     */
    public function destroy($songId)
    {
        $checkRecord = UserSongFavorite::where('song_id', $songId)
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($checkRecord) {
            return ApiResponse::success(200);
        } else {
            return ApiResponse::error(new Error('fav404'));
        }
    }
}
