<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $locations = Location::query()
            ->latest()
            ->get();

        return view('pages.contact', [
            'locations' => $locations,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'content' => ['required', 'string', 'max:5000'],
            'privacy_consent' => ['accepted'],
        ]);

        Message::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'content' => $validated['content'],
            'privacy_consent' => true,
            'privacy_consent_at' => now(),
            'privacy_consent_ip' => $request->ip(),
        ]);

        return redirect()
            ->route('pages.contact')
            ->with('contact_status', 'Dziękujemy za wiadomość. Odezwiemy się najszybciej jak to możliwe!');
    }
}
