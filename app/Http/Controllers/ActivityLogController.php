<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{

    /**
     * Display activity logs.
     */
    public function index(Request $request)
    {

        $logs = Activity::with('causer')
            ->when(
                $request->event,
                function ($query) use ($request) {
                    $query->where(
                        'event',
                        $request->event
                    );
                }
            )
            ->when(
                $request->user_id,
                function ($query) use ($request) {
                    $query->where(
                        'causer_id',
                        $request->user_id
                    );
                }
            )
            ->latest()
            ->paginate(20);


        return view(
            'activity_logs.index',
            compact('logs')
        );
    }
}
