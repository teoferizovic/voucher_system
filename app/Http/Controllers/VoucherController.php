<?php

namespace App\Http\Controllers;

use Auth;
use App\VoucherType;
use Illuminate\Http\Request;
use App\Services\VoucherService;

class VoucherController extends Controller
{
    private $voucherService;

    function __construct(VoucherService $voucherService) {
        $this->voucherService = $voucherService;
    }

    /**
     * Display a dashboard view.
     *
     * @return Response
     * 
     */
    public function index() {
    	$vouchers = $this->voucherService->getVouchersByUser(Auth::user()->id);
    	return view('dashboard', ['vouchers' => $vouchers]);
    }

    /**
     * Display a create voucher view.
     *
     * @return Response
     * 
     */
    public function create() {
    	return view('voucher.create', ['voucherTypes' => VoucherType::all()]);
    }

    /**
     * Function used to store new Voucher.
     *
     * @return Redirect
     * 
     */
    public function store(Request $request) {
        
        $input = $request->all();
        
        if ($this->voucherService->getNonUsedVouchersByUser($input['user_id'])->count() >= 5) {
        	return back()->with(['error' => 'Current user has too many not used vouchers']);
        }
        
        $this->voucherService->createVoucher($request->all());

        return redirect("dashboard")->with(['success' => 'Voucher added successfully!']);
        
    }
}
