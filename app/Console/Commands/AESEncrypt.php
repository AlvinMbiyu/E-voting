<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class AESEncrypt extends Command
{
    protected $signature = 'aes:encrypt {data}';
    protected $description = 'Encrypt data using AES';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $data = $this->argument('data');
        $process = new Process(['python', 'cryptography/aes_encrypt.py', $data]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();
    }
}
