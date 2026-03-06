<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class EventController extends Controller
{
 public function index(): View
    {
        // Get 5 events per page
        $events = Event::latest('event_date')->paginate(5);
        return view('events.index', compact('events'));
    }

    public function show($slug): View
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('events.show', compact('event'));
    }
}
