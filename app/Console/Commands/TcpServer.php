<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GpsData;
class TcpServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the TCP Server to receive GPS data';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        // TCP server setup
        $host = '0.0.0.0'; // Listen on all interfaces
        $port = 5000; // Port number

        // Create a TCP/IP socket server
        $server = stream_socket_server("tcp://$host:$port", $errno, $errstr);

        if (!$server) {
            // If the server creation failed, show an error message
            echo "Error: $errstr ($errno)\n";  // Using echo instead of $this->error
            return;
        }

        echo "Server started. Waiting for GPS data on $host:$port...\n";  // Using echo instead of $this->info

        // Keep the server running to listen for incoming connections
        while (true) {
            // Accept incoming client connection
            $client = stream_socket_accept($server);

            if ($client) {
                echo "Client connected.\n";  // Using echo instead of $this->info

                // Set the stream to non-blocking mode to read immediately when data arrives
                stream_set_blocking($client, 0);

                // Read the GPS data sent by the client in real-time
                while (true) {
                    $data = fgets($client);

                    if ($data === false) {
                        // If no data is available, check if the connection is still open
                        // Connection might be closed by the client
                        if (feof($client)) {
                            echo "Client disconnected.\n";  // Using echo instead of $this->info
                            break;
                        }
                        usleep(100000); // Sleep for 0.1 seconds to avoid maxing out CPU
                        continue;
                    }

                    // Data is available, display it
                    echo "Received GPS data: $data\n";  // Using echo instead of $this->info
                    $gpsdata = new GpsData;  
                    $gpsdata->data = $data;
                    $gpsdata->save();
                                      // You can process the GPS data here (e.g., parsing NMEA format)
                }

                // Close the client connection after receiving data
                fclose($client);
            } else {
                // Sleep for a short time if no client is connected
                usleep(100000); // Sleep for 0.1 seconds
            }
        }

        // Close the server when done (this won't be reached unless the script is terminated)
        fclose($server);

    }
}
