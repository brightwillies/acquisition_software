<?php

namespace App\Http\Controllers\Api\Admin;
// use App\Mail\System\UserAddedNotificationMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\Administrator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
   
    protected $folderPath;
    public function __construct()
    {
        $this->folderPath = ST_ADMIN_FOLDER;
    }

    public function index()
    {
        $records = Administrator::all();

        return $this->successResponse('', $records);
    }

   
    public function store(Request $request)
    {
        try {
            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:administrators,email',      
                'telephone_number' => 'required',
                // 'password' => 'required|min:6',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return $this->validationResponse($errors);
            }

            $newItem = new Administrator();
            $newItem->first_name = $request->first_name;
            $newItem->last_name = $request->last_name;
            $newItem->email = $request->email;
            $newItem->telephone_number = $request->telephone_number;
           
            // $newItem->added_by = $request->added_by;
            // $newItem->added_on = gmdate('Y-m-d');
            $newItem->password = Hash::make('12345678');
            $newItem->status = (int) $request->status;
            $webImage = $request->file('profile_image');
                     if ($webImage) {

                $uploadResult = uploadItemImage($webImage, $request->first_name . '-' . $request->last_name, $this->folderPath);
                if ($uploadResult) {
                    $newItem->image = $uploadResult->path;
                    $newItem->image_filename = $uploadResult->filename;
                }
            }
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
                return $this->successResponse('Administrator account created successfully');
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

        $newItem = Administrator::where('mask', $id)->first();
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
        $newItem = Administrator::where('mask', $id)->first();
        if (!$newItem) {
            return $this->errorResponse('Record not found');
        }
        try {
            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'telephone_number' => 'required',

            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return $this->validationResponse($errors);
            }

            $newItem->first_name = $request->first_name;
            $newItem->last_name = $request->last_name;
            $newItem->email = $request->email;
            $newItem->telephone_number = $request->telephone_number;
       
            $newItem->status = (int) $request->status;
            $webImage = $request->file('profile_image');

            if ($webImage) {

                $uploadResult = uploadItemImage($webImage, $request->first_name . '-' . $request->last_name, $this->folderPath);
                if ($uploadResult) {
                    $newItem->image = $uploadResult->path;
                    $newItem->image_filename = $uploadResult->filename;
                }
            }

            if ($newItem->save()) {
                return $this->successResponse($newItem->first_name ."'s account updated successfully");
            }
            return $this->errorResponse('Failed to process your request');
        } catch (Exception $e) {

            return $this->errorResponse($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $newItem = Administrator::where('mask', $id)->first();
        if (!$newItem) {
            return $this->errorResponse('Resource not found');
        }
        deleteOldImage($newItem->image_filename, $this->folderPath);
        $newItem->delete();
        return $this->successResponse(SUCCESS_DELETING_MESSAGE);

    }
}
