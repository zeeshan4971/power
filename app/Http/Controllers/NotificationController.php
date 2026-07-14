<?php

namespace App\Http\Controllers;

use App\Models\AppNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $after = (int) $request->integer('after', 0);

        $notifications = $request->user()->appNotifications()
            ->when($after > 0, fn ($query) => $query->where('id', '>', $after))
            ->latest('id')
            ->limit(20)
            ->get()
            ->map(fn (AppNotification $notification) => [
                'id' => $notification->id,
                'title' => $notification->title,
                'message' => $notification->message,
                'type' => $notification->type,
                'url' => $notification->action_url ?: route('dashboard'),
                'read' => $notification->read_at !== null,
                'created_at' => $notification->created_at?->diffForHumans(),
            ]);

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $request->user()->appNotifications()->whereNull('read_at')->count(),
            'latest_id' => (int) ($request->user()->appNotifications()->max('id') ?? 0),
        ]);
    }

    public function open(Request $request, AppNotification $notification): RedirectResponse
    {
        abort_unless($notification->user_id === $request->user()->id, 403);
        $notification->update(['read_at' => now()]);

        return redirect()->to($notification->action_url ?: route('dashboard'));
    }

    public function readAll(Request $request): RedirectResponse
    {
        $request->user()->appNotifications()->whereNull('read_at')->update(['read_at' => now()]);
        return back()->with('success', 'Notifications marked as read.');
    }
}
