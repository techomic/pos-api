<?php

namespace Vikuraa\Modules\AppConfig;

use Vikuraa\Core\Model;
use Vikuraa\Exceptions\NoDataException;

class AppConfigModel extends Model
{
    /**
     * Check if a key exists in the app config.
     * 
     * @param string $key
     * @return bool
     */
    public function exists(string $key): bool
    {
        $sql = "SELECT * FROM app_config WHERE key = :key";

        $data = $this->db->query($sql, ['key' => $key]);

        return is_array($data) && count($data) > 0;
    }

    /**
     * Get all app configs.
     * 
     * @return AppConfigs
     * @throws NoDataException if no app configs are found
     */
    public function all(): AppConfigs
    {
        $sql = "SELECT * FROM app_config";

        $data = $this->db->query($sql);

        if (!is_array($data)) {
            throw new NoDataException('No app configs found');
        }

        if (count($data) === 0) {
            throw new NoDataException('No app configs found');
        }

        $appConfigs = new AppConfigs();

        foreach ($data as $row) {
            $appConfigs->add(AppConfig::fromDbArray($row));
        }

        return $appConfigs;
    }

    /**
     * Get an app config by key.
     * 
     * @param string $key
     * @return AppConfig
     * @throws NoDataException if no app config is found
     */
    public function get($key): AppConfig
    {
        $sql = "SELECT * FROM app_config WHERE key = :key";

        $data = $this->db->query($sql, ['key' => $key]);

        if (!is_array($data)) {
            throw new NoDataException('No app config found');
        }

        if (count($data) === 0) {
            throw new NoDataException('No app config found');
        }

        return AppConfig::fromDbArray($data[0]);
    }

    /**
     * Save an app config.
     * 
     * @param string $key
     * @param string $value
     * @return bool
     * @throws DatabaseException if the app config could not be saved
     */
    public function save(string $key, string $value): bool
    {
        $sql = "INSERT INTO app_config (key, value) VALUES (:key, :value)";

        $insertId = $this->db->execute($sql, ['key' => $key, 'value' => $value]);

        return $insertId;
    }
}