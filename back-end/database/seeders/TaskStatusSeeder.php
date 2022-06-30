<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Pending', 'is_active' => true],
            ['name' => 'In Progress', 'is_active' => true],
            ['name' => 'Completed', 'is_active' => false],
            ['name' => 'Cancelled', 'is_active' => false]
        ];

        TaskStatus::upsert($data, ['name']);

    }
}