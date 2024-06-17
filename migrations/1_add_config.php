<?php

declare(strict_types=1);

class AddConfig extends Migration
{
    private const CONFIGS = [
        [
            'name' => 'CUSTOMBANNER_ENABLED',
            'value' => '0',
            'type' => 'boolean',
            'desc' => 'Should the custom banner be displayed?',
        ],
        [
            'name' => 'CUSTOMBANNER_TEXT_COLOR',
            'value' => '#ed8936',
            'type' => 'string',
            'desc' => 'The color of the text in the custom banner',
        ],
        [
            'name' => 'CUSTOMBANNER_BACKGROUND_COLOR',
            'value' => '#000',
            'type' => 'string',
            'desc' => 'The color of the background in the custom banner',
        ],
        [
            'name' => 'CUSTOMBANNER_MESSAGE',
            'value' => 'This is the default message. Please change it in the config.',
            'type' => 'string',
            'desc' => 'The message displayed in the custom banner',
        ],
    ];

    function description(): string
    {
        return 'Adds global custombanner settings to config';
    }

    function up(): void
    {
        $sql = DBManager::get()->prepare("INSERT INTO `config`
            (`field`, `value`, `type`, `range`, `section`, `mkdate`, `chdate`, `description`)
            VALUES
            (:name, :value, :type, 'global', " . CustomBanner::ID . ", UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), :desc)
            ON DUPLICATE KEY UPDATE `chdate`=VALUES(`chdate`)");

        foreach (self::CONFIGS as $config) {
            $sql->execute($config);
        }
    }

    function down(): void
    {
        foreach (self::CONFIGS as $config) {
            DBManager::get()->exec(
                sprintf("DELETE FROM `config` WHERE `field` = %s", $config['name'])
            );
        }
    }
}
