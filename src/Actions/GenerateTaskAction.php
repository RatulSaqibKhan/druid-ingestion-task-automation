<?php

namespace Ratulsaqibkhan\DruidIngestionTaskAutomate\Actions;

use DateTime;
use Ratulsaqibkhan\DruidIngestionTaskAutomate\Abstractions\CurlSetupAbstraction;

class GenerateTaskAction extends CurlSetupAbstraction
{
    public function __construct(string $protocol, string $user, string $password, string $host, string $port)
    {
        $this->setProtocol($protocol);
        $this->setDruidUser($user);
        $this->setDruidPassword($password);
        $this->setDruidHostIp($host);
        $this->setDruidOverlordPort($port);
        $this->printMessage("Write task file name, e.g. task.json: ");
        $this->setTaskFile();
    }

    public function handle(): void
    {
        $event = [
            'uuid' => $this->getUUID(),
            'timestamp' => $this->getCurrentTimestamp(),
            'file' => $this->taskFile,
            'result' => null,
            'error' => null
        ];
        $ch = curl_init();
        $url = $this->getUrl();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $data = file_get_contents(realpath($this->taskFile));
        
        $event['request_data'] = $data;

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $event['result'] = $result;
        echo $result;
        if (curl_errno($ch)) {
            $event['error'] = 'Error:' . curl_error($ch);
            echo $event['error'];
        }
        curl_close($ch);
        echo "Finished!";
        $this->writeLog($event);
    }

    private function writeLog(array $event): void
    {
        $fw = fopen($this->getResDir()."logs", "w");
        fwrite($fw, \json_encode($event));
    }

    private function getUUID(): string
    {
        return guidv4();
    }

    private function getCurrentTimestamp(): string
    {
        return (new DateTime())->format('Y-m-d H:i:s');
    }
}
