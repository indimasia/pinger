<?php

namespace App\Console\Commands;

use Spatie\Dns\Dns;
use App\Models\Domain;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckDnsStatusEveryFiveMinutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dns:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check dns health every 5 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $domains = Domain::whereNotNull('webhook_url')->get();

        foreach ($domains as $domain) {
            $dns = new Dns();

            $dns->getRecords($domain->name);
            $a = dns_get_record($domain->name,DNS_TXT);
            $a = dns_check_record($domain->name,DNS_TXT);

            Log::info(json_encode($a,JSON_PRETTY_PRINT));
            Log::info(json_encode($dns->getRecords($domain->name),JSON_PRETTY_PRINT));
            Log::info(json_encode($dns,JSON_PRETTY_PRINT));
            // dd($dns);
        }
    }
}
