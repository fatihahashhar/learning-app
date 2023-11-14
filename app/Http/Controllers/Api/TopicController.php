<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    // handle put request
    public function updateTopicStatus(Request $request, Topic $topic)
    {
        // receive user key from the request and retrieves the user model.
        $userKey = $request->input('userKey');
        $user = User::where('id', $userKey)->firstOrFail();

        // determine current completion status for the specified topic and user
        $isCompleted = $user
            ->topics()
            ->wherePivot('topic_id', $topic->id)
            ->value('is_completed');

        // toggle the completion status
        if ($isCompleted === 0) {
            $isCompleted = 1;
        } else {
            $isCompleted = 0;
        }

        // update is_completed value in the pivot table
        $user->topics()->updateExistingPivot($topic->id, [
            'is_completed' => $isCompleted,
        ]);

        // Returns a JSON response indicating the success of the update and the updated completion status.
        return response()->json(['message' => 'Topic completion status updated successfully', 'isCompleted' => $isCompleted]);
    }
}
