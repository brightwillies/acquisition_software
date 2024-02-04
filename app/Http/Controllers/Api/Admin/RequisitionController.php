<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
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

    public function count()
    {

        $pending = PurchaseRequest::where('hod_status', 'Approved')->where('revised_status', '<>', 'Approved')->count();
        $approved = PurchaseRequest::where('hod_status', 'Approved')->where('revised_status', 'Approved')->count();

        $data = array(
            'pending' => $pending,
            'approved' => $approved,
            'total'=> $approved + $pending
        );

        return $this->successResponse('', $data);

    }
    public function pendingRequest()
    {
        $records = PurchaseRequest::where('hod_status', 'Approved')->where('revised_status', '<>', 'Approved')->get();
        return $this->successResponse('', $records);

    }

    public function otherRequest()
    {
        $records = PurchaseRequest::where('hod_status', 'Approved')->where('revised_status', 'Approved')->get();

        return $this->successResponse('', $records);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

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
            'type_of_financial_document' => 'required',
            'type_of_transaction' => 'required',
            'type_of_expediture' => 'required',
            'revised_status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return $this->validationResponse($errors);
        }

        if ($request->supervisor_note != 'null' && $request->supervisor_note == "") {
            $newItem->supervisor_note = $request->supervisor_note;
        }
        $newItem->revised_status = $request->revised_status;
        // $newItem->requested_on = gmdate('Y-m-d');
        $newItem->type_of_financial_document = $request->type_of_financial_document;
        $newItem->type_of_transaction = $request->type_of_transaction;
        $newItem->type_of_expediture = $request->type_of_expediture;

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
