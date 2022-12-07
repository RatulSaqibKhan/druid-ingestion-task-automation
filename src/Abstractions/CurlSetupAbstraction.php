<?php

namespace Ratulsaqibkhan\DruidIngestionTaskAutomate\Abstractions;

class CurlSetupAbstraction
{
    /**
     * Protocol
     *
     * @var string $protocol
     */
    public string $protocol;
    
    /**
     * Druid User
     *
     * @var string $druidUser
     */
    public string $druidUser;
    
    /**
     * Druid Password
     *
     * @var string $druidPassword
     */
    public string $druidPassword;
    
    /**
     * Druid Overlord Host Ip
     *
     * @var string $druidHostIp
     */
    public string $druidHostIp;
    
    /**
     * Druid Overlord Port
     *
     * @var string $druidOverlordPort
     */
    public string $druidOverlordPort;
    
    /**
     * Task File
     *
     * @var string $taskFile
     */
    public string $taskFile;


     /**
     * Reurn Source Directory
     *
     * @return string
     *
     */
    public function getTaskDir(): string
    {
        return __DIR__."/../../tasks/";
    }

     /**
     * Reurn Source Directory
     *
     * @return string
     *
     */
    public function getResDir(): string
    {
        return __DIR__."/../../task_responses/";
    }

     /**
     * Print Message
     *
     * @param string
     * @return void
     *
     */
    public function printMessage(string $msg): void
    {
        echo $msg;
    }

    /**
     * Get Input From User from Console
     */
    private function getInput()
    {
        return rtrim(fgets(STDIN));
    }

    /**
     * Set Protocol
     *
     * @param string $protocol
     * @return void
     */
    public function setProtocol(string $protocol): void
    {
        $this->protocol = $protocol;
    }

    /**
     * Set Druid User
     *
     * @param string $druidUser
     * @return void
     */
    public function setDruidUser(string $druidUser): void
    {
        $this->druidUser = $druidUser;
    }

    /**
     * Set Druid Password
     *
     * @param string $druidPassword
     * @return void
     */
    public function setDruidPassword(string $druidPassword): void
    {
        $this->druidPassword = $druidPassword;
    }

    /**
     * Set Druid Host IP
     *
     * @param string $druidHostIp
     * @return void
     */
    public function setDruidHostIp(string $druidHostIp): void
    {
        $this->druidHostIp = $druidHostIp;
    }

    /**
     * Set Druid Overlord Port
     *
     * @param string $druidOverlordPort
     * @return void
     */
    public function setDruidOverlordPort(string $druidOverlordPort): void
    {
        $this->druidOverlordPort = $druidOverlordPort;
    }

    /**
     * Set Task File
     *
     * @return void
     */
    public function setTaskFile(): void
    {
        $this->taskFile = $this->getTaskDir().$this->getInput();
    }

    public function getUrl(): string
    {
        return $this->protocol."://".$this->druidUser.":".$this->druidPassword."@".$this->druidHostIp.":".$this->druidOverlordPort."/druid/indexer/v1/task";
    }
}
