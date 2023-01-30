<?php

namespace App\Http\Controllers\Api;

use App\Voucher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\VoucherService;
use App\Http\Resources\VoucherResource;
use App\Http\Requests\VoucherCreateRequest;

class VoucherController extends Controller
{
    
    private $voucherService;

    function __construct(VoucherService $voucherService) {
        $this->voucherService = $voucherService;
    }

    public function index($id = null) {
        
        if ($id) {
        	
        	$voucher = $this->voucherService->getVouchers($id);

        	if (!$voucher) {
       			
       			return response()->json([
	            	'message' => 'Data not found!'
	        	], 404);

        	}

        	return new VoucherResource($voucher);
        	
        }

        return VoucherResource::collection($this->voucherService->getVouchers());
        
    }

    public function create(VoucherCreateRequest $request) {
        
        if ($this->voucherService->getNonUsedVouchersByUser($request->user_id)->count() >= 5) {

            return response()->json([
                    'message' => 'Current user has too many not used vouchers'
            ], 400);

        }
        
        $voucher = $this->voucherService->createVoucher($request->all());

    	return new VoucherResource($voucher);
    }

    public function update(string $code) {
    	
    	$updated = $this->voucherService->updateVoucher($code);

    	if (!$updated) {
    		
    		return response()->json([
	            	'message' => 'Data not found!'
	        ], 404);

    	}

    	return response()->json([
	    	'message' => 'Successfully updated data!'
	    ], 200);
       
    }

    public function delete(string $code) {
        
        $deleted = $this->voucherService->deleteVoucher($code);

        if (!$deleted) {
    		
    		return response()->json([
	            	'message' => 'Data not found!'
	        ], 404);

    	}

    	return response()->json([
	    	'message' => 'Successfully deleted data!'
	    ], 200);

    }
}
