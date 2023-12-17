<?php

namespace App\Http\Controllers\Api\Hod;

use App\Http\Controllers\Controller;
use App\Models\DepartmentHead;
use App\Models\PurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendingRequest(Request $request)
    {
    

        $userId = $request->added_by;
      
        $records = PurchaseRequest::where('hod_status', 'Received')->where('department_head_id', $userId)->get();
        return $this->successResponse('', $records);

    }

    public function otherRequest()
    {
        

        $userId = $request->added_by;
    
        $records = PurchaseRequest::where('hod_status', '<>', 'Received')->where('department_head_id', $userId)->get();
        return $this->successResponse('', $records);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'items' => 'nullable|string',
            'purpose' => 'nullable|string',
            'receiving_company_name' => 'nullable|string',
            'receiving_company_telephone' => 'nullable|string',
            'receiving_company_email' => 'nullable|string|email',
            'method_of_payment' => 'nullable|string',
            'why_cash_cheque' => $request->method_of_payment == 'Cash Cheque' ? 'required|string' : 'nullable|string',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return $this->validationResponse($errors);
        }
        $newItem = new PurchaseRequest();
        $newItem->purchaser_id = $request->purchaser_id;
        $newItem->department_id = $request->department_id;
        $newItem->items = $request->items;
        $newItem->purpose = $request->purpose;
        $newItem->requested_on = gmdate('Y-m-d');
        $newItem->receiving_company_name = $request->receiving_company_name;
        $newItem->receiving_company_telephone = $request->receiving_company_telephone;
        $newItem->receiving_company_email = $request->receiving_company_email;
        $newItem->method_of_payment = $request->method_of_payment;
        // Set why_cash_cheque only if the condition is met
        if ($request->method_of_payment == 'Cash Cheque') {
            $newItem->why_cash_cheque = $request->why_cash_cheque;
        }
        $newItem->save();

        return response()->json(['message' => 'Data saved successfully'], 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $record = PurchaseRequest::where('mask', $id)->first();
        return $this->successResponse('', $record);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $newItem = PurchaseRequest::where('mask', $id)->first();
        if (!$newItem) {
            return $this->errorResponse('Record not found');
        }

        $rules = [
            // 'hod_note' => 'required',
            'hod_status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return $this->validationResponse($errors);
        }

        $newItem->hod_status = $request->hod_status;
        if ($request->hod_note != 'null' && $request->hod_note == "") {
            $newItem->hod_note = $request->hod_note;
        }
        $newItem->save();

        return $this->successResponse('Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
