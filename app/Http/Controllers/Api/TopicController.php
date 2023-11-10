<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function updateTopicStatus(Request $request, Topic $topic)
    {
        $userKey = $request->input('userKey');

        $user = User::where('id', $userKey)->firstOrFail();

        $isCompleted = $user
            ->topics()
            ->wherePivot('topic_id', $topic->id)
            ->value('is_completed');

        if ($isCompleted === 0) {
            $isCompleted = 1;
        } else {
            $isCompleted = 0;
        }

        $user->topics()->updateExistingPivot($topic->id, [
            'is_completed' => $isCompleted,
        ]);

        return response()->json(['message' => 'Topic completion status updated successfully', 'isCompleted' => $isCompleted]);
    }
}
