<?php

namespace App\Console\Commands;

use Exception;
use Spatie\Dns\Dns;
use App\Models\Domain;
use Acamposm\Ping\Ping;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Acamposm\Ping\PingCommandBuilder;
use Spatie\DiscordAlerts\Facades\DiscordAlert;

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
                // $command = (new PingCommandBuilder('http://localhost:8000/'));
                // $command = new PingCommandBuilder('http://score.siaksi.com');

                // $ping = (new Ping($command))->run();

                    // $ip = '127.0.0.1';
                    // $port = '22';
                    $url = $domain->name;
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $data = curl_exec($ch);
                    $health = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);

                    dd($health);
                    dd($data);
                // $records = $dns->getRecords($domain->name);
                // $res = ::
                // $records = $dns->getRecords('http://localhost:8000/admin/login');
                // $records = $dns->getRecords('http://score.siaksi.com/pinger');
                // $records = $dns->getRecords('http://score.siaksi.com/pinger');
                // dd($records);
                // Log::info(json_encode($records,JSON_PRETTY_PRINT));
                Log::info(json_encode($health,JSON_PRETTY_PRINT));
                // Log::info(json_encode($ping,JSON_PRETTY_PRINT));
            } catch (Exception $e) {
                dd($e);
                Log::info(json_encode($e,JSON_PRETTY_PRINT));
                // Log::info(json_encode($e->getMessage(),JSON_PRETTY_PRINT));
                // DiscordAlert::to($domain->webhook_url)->message("You have a new subscriber to the {$domain->name} newsletter!",[
                DiscordAlert::to('https://discord.com/api/webhooks/1294304304198582353/Fr887MlQARDOT260jZ3cGjWqzWV2_FiG6ht5BMZriXEleqQwf60QGb7-FSZktlifTMM5')
                ->message("Issue Accessing {$domain->name} !",
                [[
                    'title' => 'Alert!',
                    'description' => $e->getMessage(),
                    // 'description' => 'My description',
                    // 'description' => 'My description',
                    'color' => '#E77625',
                    'author' => [
                        'name' => 'Spatie',
                        'url' => 'https://spatie.be/'
                    ]    
                ]]);
                // dd($e);
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
