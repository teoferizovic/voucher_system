<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Voucher;
use Carbon\Carbon;
use App\VoucherStatus;

class VoucherService {

	/**
     * Function to get all vouchers
     *
     * @param $id Int || null
     * 
     * @return Collection
     * 
     */
	public function getVouchers($id = null) {

		if($id) {
			return Voucher::with('voucherType','voucherStatus', 'user')->where('id', $id)->first();
		}
		
		return Voucher::with('voucherType','voucherStatus', 'user')->paginate(5);
	}

	/**
     * Function to get vouchers by user_id
     *
     * @param $userId Int
     * 
     * @return Collection
     * 
     */
	public function getVouchersByUser(int $userId) {

		return Voucher::with('voucherType','voucherStatus', 'user')
					  ->where('user_id', $userId)	
					  ->paginate(5);
	}

	/**
     * Function to get not used vouchers by user_id
     *
     * @param $userId Int
     * 
     * @return Collection
     * 
     */
	public function getNonUsedVouchersByUser(int $userId) {
		
		return Voucher::where('user_id', $userId)
					  ->where('status_id', VoucherStatus::CREATE)
					  ->get();
	}

	/**
     * Function to create new Voucher
     *
     * @param $data Array
     * 
     * @return Voucher
     * 
     */
	public function createVoucher(array $data) : Voucher {
		
		$voucher = Voucher::create([
            'type_id' => $data['type_id'],
            'user_id' => $data['user_id'],
            'status_id' => VoucherStatus::CREATE,
            'code' => sha1(time()),
            'expired_date' => Carbon::now()->addDays(10)
        ]);

		return $voucher; 
	}

	/**
     * Function to update Voucher
     *
     * @param $code String
     * 
     * @return Bool
     * 
     */
	public function updateVoucher(string $code) : bool {

		$voucher = Voucher::where('code', $code)
		 				   ->where('expired_date', '>', Carbon::now()->format('Y-m-d'))
		 				   ->where('status_id', VoucherStatus::CREATE)
		 				   ->first();

		if (!$voucher) {
		 	return false;
		}

		$voucher->status_id = VoucherStatus::USED;

		return $voucher->save();

	}

	/**
     * Function to delete Voucher
     *
     * @param $code String
     * 
     * @return Bool
     * 
     */
	public function deleteVoucher(string $code) : bool {

		$voucher = Voucher::where('code', $code)->first();

		if (!$voucher) {
		 	return false;
		 }

		return $voucher->delete();

	}    
	
}

