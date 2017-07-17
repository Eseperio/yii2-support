<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ticket_priority`.
 */
class m170524_145656_create_ticket_priority_table extends Migration
{
    /**
     * @var string
     */
    private static $_tableName = '{{%ticket_priority}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::$_tableName, [
            'id'    => $this->primaryKey(),
            'name'  => $this->string(255)->notNull(),
            'color' => $this->string(45)
        ], $tableOptions);

        $this->batchInsert(
            self::$_tableName, ['name', 'color'], [
                ['Low', '#15a000'],
                ['Normal', '#e1d200'],
                ['Critical', '#e10000']
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable(self::$_tableName);
    }
}
