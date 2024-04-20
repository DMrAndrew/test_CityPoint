<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Flysystem\UnreadableFileException;
use SplFileInfo;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws UnreadableFileException
     * @throws Exception
     */
    public function run()
    {
        $file = base_path('../data.sql');

        if (!file_exists($file)) {
            throw new FileNotFoundException();
        }

        if (!is_readable($file)) {
            throw UnreadableFileException::forFileInfo(new SplFileInfo($file));
        }

        $sql = file_get_contents($file);
        if (is_bool($sql) && !$sql) {
            throw new Exception('Unable get dump content');
        }

        DB::unprepared($sql);

        // \App\Models\User::factory(10)->create();
    }
}
