<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use App\Services\AnalyticsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsletterSubscriberController extends Controller
{
    public function store(Request $request, AnalyticsService $analytics): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email:rfc', 'max:255'],
            'privacy_consent' => ['accepted'],
        ]);

        $subscriber = NewsletterSubscriber::firstOrCreate([
            'email' => $validated['email'],
        ], [
            'privacy_consent' => true,
            'privacy_consent_at' => now(),
            'privacy_consent_ip' => $request->ip(),
        ]);

        if (! $subscriber->privacy_consent) {
            $subscriber->forceFill([
                'privacy_consent' => true,
                'privacy_consent_at' => now(),
                'privacy_consent_ip' => $request->ip(),
            ])->save();
        }

        $analytics->increment('newsletter_submissions');

        if ($subscriber->wasRecentlyCreated) {
            $analytics->increment('newsletter_new_subscribers');
        }

        return redirect()
            ->back()
            ->with('newsletter_status', 'Dziękujemy za zapisanie się!');
    }
}
