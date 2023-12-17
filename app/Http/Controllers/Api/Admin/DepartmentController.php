<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{

    protected $folderPath;
    public function __construct()
    {
        $this->folderPath = ST_DPETH_FOLDER;
    }

    public function index()
    {
        $records = Department::all();

        return $this->successResponse('', $records);
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'name' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return $this->validationResponse($errors);
            }

            $newItem = new Department();
            $newItem->name = $request->name;
            $newItem->mask = generate_mask();
            if ($newItem->save()) {

                // $data = array(
                //     'name' => $newItem->first_name,
                //     'email' => $newItem->email,
                //     'password' => $request->password,
                //     'as' => 'an administrator',
                //     'url' => 'techinchurch.com/admin-login',
                // );
                // if (isset($newItem->email)) {
                //     try {
                //         $mail = Mail::to($newItem->email)->send(new UserAddedNotificationMail($data));
                //     } catch (\Throwable $th) {
                //     }
                // }
                return $this->successResponse('Department created successfully');
            }
            return $this->errorResponse('Failed to process your request');
        } catch (Exception $e) {

            return $this->errorResponse($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $newItem = Department::where('mask', $id)->first();
        if (!$newItem) {
            return $this->errorResponse('Record not found');
        }
        return $this->successResponse('', $newItem);

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
        $newItem = Department::where('mask', $id)->first();
        if (!$newItem) {
            return $this->errorResponse('Record not found');
        }
        try {
            $rules = [
                'name' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return $this->validationResponse($errors);
            }
            $newItem->name = $request->name;
            $newItem->status = (int) $request->status;
            if ($newItem->save()) {
                return $this->successResponse("Department created successfully");
            }
            return $this->errorResponse('Failed to process your request');
        } catch (Exception $e) {

            return $this->errorResponse($e);
        }
    }

    public function destroy($id)
    {
        $newItem = Department::where('mask', $id)->first();
        if (!$newItem) {
            return $this->errorResponse('Resource not found');
        }
        deleteOldImage($newItem->image_filename, $this->folderPath);
        $newItem->delete();
        return $this->successResponse(SUCCESS_DELETING_MESSAGE);

    }
}
