<?php
namespace Twinkle\Model\Mysql;
 
use Twinkle\Base\Mysql as Mysql;


class EasterRecordModel extends Mysql 
{
    public $tableName = 'eload_easter_game_record';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function insertData($data)
    {
        $this->masterDb->insert($this->tableName, $data);
    }
    
    
    public function getAnniversaryExchanged($userId,$activityId)
    {
    
        $easterData = $this->slaveDb->execQuery(
            $this->select('*')
            ->from($this->tableName)
            ->where("user_id = ? AND activity_id = ? ", [$userId,$activityId])
        )->fetchInto(self::FETCH_ASSOC);
    
        return $easterData;
    }
    
    public function obtainBlowoutCandlesPrize($sessionId,$activityId)
    {
        $easterData = $this->slaveDb->execQuery(
            $this->select('*')
            ->from($this->tableName)
            ->where("session_id = ? AND activity_id = ? AND user_id = 0", [$sessionId,$activityId])
        )->fetchAll(self::FETCH_ASSOC);
        
        return $easterData;
    }
    
    public function clearBlowoutCandlesPrize($sessionId,$activityId)
    {
        $sql = "DELETE FROM " . $this->tableName . "  WHERE session_id = ? AND activity_id = ? AND user_id = 0";
        $object = $this->masterDb->executeQuery($sql, [$sessionId,$activityId]);
        return $object->rowCount();
    }
    
    public function updateUserIdBySessionId($userId,$id)
    {
        $sql = "UPDATE ".$this->tableName." SET user_id = ? WHERE id = ?";
        $object = $this->masterDb->executeQuery($sql, [intval($userId),$id]);
        return $object->rowCount();
    }

}