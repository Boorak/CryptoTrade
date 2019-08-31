<?php

namespace App\Console\Commands;

use App\Transaction;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class BitfinexCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bitfinex:crawler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl data form bitfinex api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $symbol = $this->anticipate('What is your symbol?', ['BTCUSD']);
        $time = null;
        while (true) {
            $client = new Client(['base_uri' => 'https://api.bitfinex.com/v2/trades/']);

            if ($time === null) {
                $time = \App\Transaction::orderBy('timestamp', 'desc')->first()->timestamp;
            }

//            echo $time . "\n";
            $url = "t{$symbol}/hist" . "/?limit=999&start=$time&sort=1";
            echo $url."\n";
            $response = $client->request('GET', $url);
            $responsesAsArray = \GuzzleHttp\json_decode($response->getBody());
            $bar = $this->output->createProgressBar(count($responsesAsArray));
            foreach ($responsesAsArray as $response) {
                try {
                    $time = $response[1];
                    Transaction::create([
                        'amount' => $response[2],
                        'price' => $response[3],
                        'type' => "sell",
                        'timestamp' => $response[1],
                        'trade_id' => $response[0],
                        't1' => $response[1]/6000,
                        't5' => $response[1]/(6000*5),
                        't15' => $response[1]/(6000*15),

                    ]);
                    usleep(100);
//                echo $response->tid."\n";
                } catch (\Exception $e) {
                    echo "DP:$response[0]\n";
                }
                $bar->advance();
            }

            $bar->finish();
            echo "\n";
            echo "\n";
            $this->info('Done.');
            echo "\n";
        }
    }
}
