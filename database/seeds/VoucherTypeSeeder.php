<?php

use Illuminate\Database\Seeder;
use App\VoucherType;

class VoucherTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	VoucherType::updateOrCreate(
		    ['id' => 1],
		    ['name' => 'Free Delivery']
	    );

	    VoucherType::updateOrCreate(
		    ['id' => 2],
		    ['name' => '15% Off']
	    );
    }
}
