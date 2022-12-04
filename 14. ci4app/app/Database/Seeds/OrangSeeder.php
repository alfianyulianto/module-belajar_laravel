<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;    // untuk menggunakan helper date dan time dari CI

class OrangSeeder extends Seeder
{
  public function run()
  {
    // // data yang diisikan hana field nama dan alamat saja
    // // karena field id sudah auto incremenet
    // // sedangkan field created_at dan updated_at boleh null atau kosong
    // $data = [
    //   [
    //     'nama' => 'Alfian Yulianto',
    //     'alamat' => 'Jl. ABC No. 23',
    //     'created_at' => Time::now(),   // untuk membuat waktu dan tanggal pada CI
    //     'updated_at' => Time::now()
    //   ],
    //   [
    //     'nama' => 'Budi Doremi',
    //     'alamat' => 'Jl. Marjan No. 10',
    //     'created_at' => Time::now(),   // untuk membuat waktu dan tanggal pada CI
    //     'updated_at' => Time::now()
    //   ],
    //   [
    //     'nama' => 'Anita Lusiana',
    //     'alamat' => 'Jl. ABC No. 19',
    //     'created_at' => Time::now(),   // untuk membuat waktu dan tanggal pada CI
    //     'updated_at' => Time::now()
    //   ],
    // ];

    // // // Simple Query
    // // $this->db->query(
    // //   "INSERT INTO orang (nama, alamat, created_at, updated_at) VALUE(:nama:, :alamat:, :created_at:, :updated_at:)",
    // //   $data
    // // );

    // // Query Builder
    // // insert() : hanya untuk menginsert satu data
    // // insertBatch() : untuk menginsert banyak data
    // // $this->db->table('orang')->insert($data);
    // $this->db->table('orang')->insertBatch($data);

    $faker = \Faker\Factory::create('id_ID');   // memanggio faker untuk negara indonsia
    for ($i = 0; $i < 1000; $i++) {
      $data = [
        'nama' => $faker->name(),   // untuk mengenerate data nama
        'alamat' => $faker->address(),    // untuk mengenerate data alamat
        'created_at' => Time::createFromTimestamp($faker->unixTime()),    // untuk mengenerate time
        'updated_at' => Time::now()
      ];
      $this->db->table('orang')->insert($data);
    }
  }
}
