<?php

namespace App\Http\Controllers;

use App\Models\WebVitalMetric;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebVitalsController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $payload = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE || ! is_array($payload)) {
            return response()->json(['message' => 'Invalid payload.'], 422);
        }

        $metrics = $payload['metrics'] ?? [];

        if (! is_array($metrics) || $metrics === []) {
            return response()->json(['message' => 'No metrics to persist.'], 202);
        }

        $sessionToken = isset($payload['session_token']) ? (string) $payload['session_token'] : null;
        $path = isset($payload['path']) ? (string) $payload['path'] : null;

        foreach ($metrics as $metric) {
            if (! is_array($metric)) {
                continue;
            }

            $name = isset($metric['name']) ? (string) $metric['name'] : null;
            $rawValue = $metric['value'] ?? null;

            if (! in_array($name, ['LCP', 'CLS', 'INP'], true) || ! is_numeric($rawValue)) {
                continue;
            }

            $value = (float) $rawValue;

            WebVitalMetric::query()->create([
                'metric' => $name,
                'value' => $value,
                'rating' => isset($metric['rating']) ? (string) $metric['rating'] : null,
                'path' => $path,
                'session_token' => $sessionToken,
                'user_agent' => (string) $request->userAgent(),
            ]);
        }

        return response()->json(['status' => 'ok']);
    }
}
