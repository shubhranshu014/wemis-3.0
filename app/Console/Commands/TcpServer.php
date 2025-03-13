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
    protected $signature = 'tcpserver:start';
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
            $this->error("Error: $errstr ($errno)");
            return;
        }

        // Log that the server has started
        $this->info("Server started. Waiting for GPS data on $host:$port...");

        // Keep track of all client connections
        $clients = [];
        $clients[] = $server;  // Add the server socket to the clients list

        // Set the server socket to non-blocking mode
        stream_set_blocking($server, 0);

        // Keep the server running to listen for incoming connections
        while (true) {
            // Monitor all client sockets and the server socket for incoming data
            $readSockets = $clients;
            $writeSockets = $exceptSockets = null;

            // Use stream_select to check which sockets have data available to read
            $numChanged = stream_select($readSockets, $writeSockets, $exceptSockets, null);

            if ($numChanged === false) {
                $this->error("Error in stream_select()");
                break;
            }

            // Loop through the sockets that are ready to read
            foreach ($readSockets as $socket) {
                if ($socket === $server) {
                    // New client connection
                    $client = stream_socket_accept($server);
                    if ($client) {
                        $this->info("New client connected.");
                        // Add the new client to the list
                        $clients[] = $client;

                        // Set the client socket to non-blocking mode
                        stream_set_blocking($client, 0);
                    }
                } else {
                    // Existing client sending data
                    $data = fgets($socket);

                    if ($data === false) {
                        // If no data or connection is closed
                        if (feof($socket)) {
                            $this->info("Client disconnected.");
                        }

                        // Remove client from the list and close connection
                        $clients = array_filter($clients, fn($client) => $client !== $socket);
                        fclose($socket);
                    } else {
                        // Data is available, display it
                        $this->info("Received GPS data: $data");
                        $gpsdata = new GpsData;  
                        $gpsdata->data = $data;
                        $gpsdata->save();
                        // You can process the GPS data here (e.g., parsing NMEA format)
                    }
                }
            }

            // Sleep briefly to avoid 100% CPU usage (can adjust or remove)
            usleep(100000); // Sleep for 0.1 seconds to avoid maxing out the CPU
        }

        // Close the server when done (this won't be reached unless the script is terminated)
        fclose($server);
    }

}
