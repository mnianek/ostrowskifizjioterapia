<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsletterSubscriberController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email:rfc', 'max:255'],
        ]);

        NewsletterSubscriber::firstOrCreate([
            'email' => $validated['email'],
        ]);

        return redirect()
            ->back()
            ->with('newsletter_status', 'Dziękujemy za zapisanie się!');
    }
}
