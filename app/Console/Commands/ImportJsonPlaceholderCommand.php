<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use Illuminate\Console\Command;

class ImportJsonPlaceholderCommand extends Command
{
    protected $signature = 'import:jsonplaceholder';

    protected $description = 'Get data from json placeholder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $import = new ImportDataClient();
        $responce = $import->client->request('GET', 'bulletins');

        dd(json_decode($responce->getBody()->getContents()));
    }
}
