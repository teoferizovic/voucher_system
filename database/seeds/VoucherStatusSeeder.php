<?php

use Illuminate\Database\Seeder;
use App\VoucherStatus;

class VoucherStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VoucherStatus::updateOrCreate(
		    ['id' => 1],
		    ['name' => 'Create']
	    );

	    VoucherStatus::updateOrCreate(
		    ['id' => 2],
		    ['name' => 'Used']
	    );
    }
}
