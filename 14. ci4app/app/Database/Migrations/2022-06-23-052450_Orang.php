<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orang extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id' => [
        'type'           => 'INT',
        'constraint'     => 11,
        'unsigned'       => true,   // digunakan untuk meberi nilai positif jika true
        'auto_increment' => true,
      ],
      'nama' => [
        'type'       => 'VARCHAR',
        'constraint' => '255',
      ],
      'alamat' => [
        'type' => 'TEXT',
        'constraint' => '255',
      ],
      'created_at' => [
        'type' => 'DATETIME',
        'null' => true
      ],
      'updated_at' => [
        'type' => 'DATETIME',
        'null' => true
      ]
    ]);
    $this->forge->addKey('id', true);   // digunakan  untuk memberitahu field yang primary key
    $this->forge->createTable('orang');   // dugunakan untuk menamai tabel
  }

  public function down()
  {
    $this->forge->dropTable('orang');
  }
}
