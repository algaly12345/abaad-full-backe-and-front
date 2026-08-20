<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

header('Content-Type: text/plain; charset=utf-8');

function test(string $label, callable $fn): void
{
    echo "=== {$label} ===\n";
    try {
        $result = $fn();
        echo "SUCCESS\n";
        echo print_r($result, true) . "\n\n";
    } catch (\Throwable $e) {
        echo "FAILED: " . get_class($e) . "\n";
        echo "Message: " . $e->getMessage() . "\n";
        echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n\n";
    }
}

test('Cache driver', fn () => config('cache.default'));

test('SubscriptionPricingSetting::current()', fn () =>
    \App\Models\SubscriptionPricingSetting::current()->toArray()
);

test('SubscriptionDurationDiscount::percentFor(3)', fn () =>
    \App\Models\SubscriptionDurationDiscount::percentFor(3)
);

test('ServiceProviderService::calculatePrice()', fn () =>
    app(\App\Services\ServiceProviderService::class)->calculatePrice(3, 2, 3)
);