<?php

namespace App\Http\Controllers\Api\Purchaser;

use App\Http\Controllers\Controller;
use App\Models\AcquisitionFile;
use App\Models\DepartmentHead;
use App\Models\PurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



     public function count(Request $request)
     {

         $pending = PurchaseRequest::where('hod_status', 'Approved')->where('revised_status', '<>', 'Approved')->where('purchaser_id', $request->added_by)->count();
         $approved = PurchaseRequest::where('hod_status', 'Approved')->where('revised_status', 'Approved')->where('purchaser_id', $request->added_by)->count();

         $data = array(
             'pending' => $pending,
             'approved' => $approved,
             'total'=> $approved + $pending
         );

         return $this->successResponse('', $data);

     }
    public function pendingRequest()
    {
        $records = PurchaseRequest::where('hod_status', 'Received')->where('revised_status', '<>', 'Approved')->get();
        return $this->successResponse('', $records);

    }

    public function completedRequest()
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
    public function store(Request $request)
    {

        $rules = [
            'title' => 'required|string',
            'items' => 'required|string',
            'purpose' => 'required|string',
            'department_id' => 'required|integer',
            'receiving_company_name' => 'required|string',
            'receiving_company_telephone' => 'required|string',
            'receiving_company_email' => 'required|string|email',
            'method_of_payment' => 'required|string',
            'why_cash_cheque' => $request->method_of_payment == 'Cash Cheque' ? 'required|string' : 'nullable|string',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return $this->validationResponse($errors);
        }

        $findDepartmentHead = DepartmentHead::where('department_id', $request->department_id)->where('status', 1)->first();

        $newItem = new PurchaseRequest();
        $newItem->title = $request->title;
        $newItem->purchaser_id = $request->added_by;
        $newItem->department_head_id = $findDepartmentHead->id ?? 0;
        $newItem->department_id = $request->department_id;
        $newItem->items = $request->items;
        $newItem->department_id = $request->department_id;
        $newItem->purpose = $request->purpose;
        $newItem->requested_on = gmdate('Y-m-d');
        $newItem->place_of_use = $request->place_of_use;
        $newItem->receiving_company_name = $request->receiving_company_name;
        $newItem->receiving_company_telephone = $request->receiving_company_telephone;
        $newItem->receiving_company_email = $request->receiving_company_email;
        $newItem->method_of_payment = $request->method_of_payment;
        // Set why_cash_cheque only if the condition is met
        if ($request->method_of_payment == 'Cash Cheque') {
            $newItem->why_cash_cheque = $request->why_cash_cheque;
        }
        $newItem->mask = generate_mask();
        $newItem->save();
        $newItem->mask = Str::slug($request->title) . $newItem->id;
        $newItem->save();

        if ($uploadFiles = $request->file('files')) {

            foreach ($uploadFiles as $key => $value) {

                $uploadResult = uploadItemImage($value, \generate_mask() . '-' . ($key + 1), ST_ACQUISITION_FOLDER);

                $newFile = new AcquisitionFile();
                $newFile->mask = generate_int_mask();
                $newFile->acquisition_id = $newItem->id;
                $newFile->file_filename = $uploadResult->filename;
                $newFile->file = $uploadResult->path;
                $newFile->file_title = $uploadResult->file_title;

                // $newFile->file_title = $uploadResult->file_title;
                $newFile->save();
            }

        }
        return $this->successResponse('Acquisition recorded successfully');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        // $newItem->why_cash_cheque = $request->why_cash_cheque;
        // $newItem->purchaser_note = $request->purchaser_note;
        // $newItem->place_of_use = $request->place_of_use;
        // $newItem->reason_for_purchase = $request->reason_for_purchase;
        // $newItem->permitted_on = $request->permitted_on;
        // $newItem->hod_status = $request->hod_status;
        // $newItem->hod_note = $request->hod_note;
        // $newItem->type = $request->type;
        // $newItem->type_of_expenditure = $request->type_of_expenditure;
        // $newItem->revised_status = $request->revised_status;
        // $newItem->revised_by = $request->revised_by;
        // $newItem->revised_on = $request->revised_on;
        // $newItem->supervisor_note = $request->supervisor_note;
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
        //
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
