<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\File;

class CaptureTranslations
{
    public function handle($request, Closure $next)
    {
        // تحديد الملفات التي سيتم حفظ الترجمة بها بناءً على اللغة
        $locales = ['en', 'ar']; // استبدل 'en' و 'ar' باللغات المتاحة في مشروعك

        foreach ($locales as $locale) {
            app()->setLocale($locale);

            // استبدال دالة translate وتخزين العبارات
            app()->bind('translate', function ($expression) use ($locale) {
                $this->storeTranslation($expression, $locale);
                return trans($expression);
            });
        }

        return $next($request);
    }

    protected function storeTranslation($expression, $locale)
    {
        $path = resource_path("lang/{$locale}/messages.php");

        if (!File::exists($path)) {
            File::put($path, "<?php\n\nreturn [];\n");
        }

        $translations = File::getRequire($path);

        if (!array_key_exists($expression, $translations)) {
            $translations[$expression] = $expression;
            File::put($path, '<?php return ' . var_export($translations, true) . ';');
        }
    }
}
