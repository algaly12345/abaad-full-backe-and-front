<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MigrateStorageToR2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:migrate-to-r2 {--dry-run : List what would be uploaded without uploading anything}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload existing user-media files from storage/app/public to the R2-backed "public" disk, preserving relative paths';

    /**
     * مجلدات أصول ثابتة (ثيمات/مكتبات) لا يجب رفعها للتخزين السحابي أبداً —
     * لو انسخت بالغلط داخل storage/app/public (كما حصل فعلياً هنا)، هذا يمنع رفعها.
     */
    private const EXCLUDED_TOP_LEVEL_DIRS = ['assets', 'build', 'css', 'js', 'scss', 'themes', 'vendor'];

    /**
     * ملفات جذرية عامة (مو ملفات مستخدمين) قد تكون انسخت بالغلط ضمن نفس نسخة public/ العالقة.
     */
    private const EXCLUDED_ROOT_FILES = ['favicon.ico', 'index.php', 'robots.txt', 'api-docs.html', '.htaccess', 'web.config'];

    /**
     * امتدادات لا ترفع أبداً حتى لو ما كانت ضمن مجلد مستثنى، كطبقة حماية إضافية
     * ضد رفع مفاتيح/أسرار بالغلط (مثل Apple-AuthKey.p8).
     */
    private const BLOCKED_EXTENSIONS = ['p8', 'pem', 'key', 'env', 'htaccess'];

    public function handle(): int
    {
        $localRoot = storage_path('app/public');

        if (!File::isDirectory($localRoot)) {
            $this->error("Local directory not found: {$localRoot}");
            return Command::FAILURE;
        }

        $dryRun = (bool) $this->option('dry-run');
        $files = File::allFiles($localRoot);

        $uploaded = 0;
        $skipped = 0;
        $excluded = 0;
        $failed = 0;

        $this->info(sprintf('Found %d local file(s) under %s', count($files), $localRoot));

        foreach ($files as $file) {
            $relativePath = str_replace('\\', '/', $file->getRelativePathname());
            $topLevelDir = strtolower(explode('/', $relativePath)[0]);
            $extension = strtolower($file->getExtension());
            $isRootFile = !str_contains($relativePath, '/');

            if (
                in_array($topLevelDir, self::EXCLUDED_TOP_LEVEL_DIRS, true)
                || in_array($extension, self::BLOCKED_EXTENSIONS, true)
                || ($isRootFile && in_array(strtolower($relativePath), self::EXCLUDED_ROOT_FILES, true))
            ) {
                $excluded++;
                continue;
            }

            try {
                if (Storage::disk('public')->exists($relativePath)) {
                    $skipped++;
                    continue;
                }

                if ($dryRun) {
                    $this->line("Would upload: {$relativePath}");
                    $uploaded++;
                    continue;
                }

                Storage::disk('public')->put($relativePath, File::get($file->getPathname()));
                $this->line("Uploaded: {$relativePath}");
                $uploaded++;
            } catch (\Throwable $e) {
                $failed++;
                $this->error("Failed: {$relativePath} — {$e->getMessage()}");
            }
        }

        $this->newLine();
        $this->info(sprintf(
            '%s%d uploaded, %d skipped (already on R2), %d excluded (static assets/blocked extensions), %d failed.',
            $dryRun ? '[dry-run] ' : '',
            $uploaded,
            $skipped,
            $excluded,
            $failed
        ));

        return $failed > 0 ? Command::FAILURE : Command::SUCCESS;
    }
}
