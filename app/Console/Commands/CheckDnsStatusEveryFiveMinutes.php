<?php

namespace App\Console\Commands;

use Spatie\Dns\Dns;
use App\Models\Domain;
use Exception;
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
        $domains = Domain::all();
        // $domains = Domain::whereNotNull('webhook_url')->get();

        foreach ($domains as $domain) {
            $dns = new Dns;

            // dd($domain);
            // $records = $dns->getRecords($domain->name);]
            try {
                
                // $records = $dns->getRecords($domain->name);
                $records = $dns->getRecords('http://localhost:8000/admin/login');
                dd($records);
                Log::info(json_encode($records,JSON_PRETTY_PRINT));
            } catch (Exception $e) {
                dd($e);
            }
            // $a = dns_get_record($domain->name,DNS_TXT);
            // $a = dns_check_record($domain->name,DNS_TXT);

            // $curl = curl_init($domain->name);

            // Set cURL options
            // $curlOptions = [
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => '',
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 30,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => 'GET',
            //     CURLOPT_HTTPHEADER => [
            //         'Content-Type: application/json',
            //         // 'AccessKey: '.$apiKey,
            //         'accept: application/json', // Include accept header
            //     ],
            // ];
            // curl_setopt_array($curl, $curlOptions);
    
            // // Execute the cURL request and handle errors
            // $response = curl_exec($curl);

            // dd('oi');
            // dd($response);
            // dd($a);

            // Log::info(json_encode($response,JSON_PRETTY_PRINT));
            // Log::info(json_encode($a,JSON_PRETTY_PRINT));
            // Log::info(json_encode($a,JSON_PRETTY_PRINT));
            // Log::info(json_encode($dns->getRecords($domain->name),JSON_PRETTY_PRINT));
            // Log::info(json_encode($dns,JSON_PRETTY_PRINT));
            // dd($dns);
        }
    }
}
