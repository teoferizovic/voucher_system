<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_id', 'status_id', 'user_id', 'code', 'expired_date'
    ];

    /**
	 * Get the type that belongs to voucher.
	 */
	public function voucherType()
	{
	    return $this->belongsTo(VoucherType::class, 'type_id');
	}

	/**
	 * Get the status that belongs to voucher.
	 */
	public function voucherStatus()
	{
	    return $this->belongsTo(VoucherStatus::class, 'status_id');
	}

    /**
	 * Get the user that belongs to voucher.
	 */
	public function user()
	{
	    return $this->belongsTo(User::class, 'user_id');
	}
}
