<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\inventory_rotation as InventoryRotation;

class inventory_rotation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inventory:rotation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        InventoryRotation::inventory_rotation_register();
    }
}
