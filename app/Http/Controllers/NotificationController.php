<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        return auth()->user()->notifications()->with(['orders.orderItemsGetImages.colorImage'])->latest()->get();
    }

    public function update(Notification $notification, Request $request)
    {
        $selectedNotification = $request->user()->notifications()->where('id', $notification->id);

        $selectedNotification->update([
            'is_seen' => $request->is_seen,
            'is_read' => $request->is_read
        ]);

        return response()->json($selectedNotification->first(), 200);
    }

}
