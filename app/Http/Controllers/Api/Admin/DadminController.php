<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckPrice;
use App\Models\Customer;
use App\Models\Deliveryman;
use App\Models\Order;
use Illuminate\Http\Request;

class DadminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function quotes()
    {
        $newData = CheckPrice::where('status', 'placed')->get();
        $oldData = CheckPrice::where('status', '<>', 'placed')->get();

        $data = array(
            'newData' => $newData,
            'oldData' => $oldData,
        );

        return $this->successResponse('', $data);
    }
    public function newOrder()
    {
        $data = Order::whereNotIn('status', ['completed', 'rejected'])->get();
        return $this->successResponse('', $data);

    }
    public function oldOrder()
    {

        $data = Order::whereIn('status', ['completed', 'rejected'])->get();
        return $this->successResponse('', $data);
    }

    public function deliveryMen()
    {

        $data = Deliveryman::where('status', ST_ACTIVE)->get();
        return $this->successResponse('', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrder(Request $request, $id)
    {
        $findOrder = Order::find($id);

        if (!$findOrder) {
            return $this->errorResponse('Record not found');
        } else {

            if ($request->delivery_man_id) {
                $findOrder->delivery_man_id = $request->delivery_man_id;
            }
            $findOrder->status = $request->status;
            $findOrder->save();
            return $this->successResponse('Order updated');
        }

    }

    public function updateQuote(Request $request, $id)
    {
        $findOrder = CheckPrice::find($id);

        if (!$findOrder) {
            return $this->errorResponse('Record not found');
        } else {

            if ($request->total_fees) {
                $findOrder->total_fees = $request->total_fees;
            }
            $findOrder->status = $request->status;
            $findOrder->save();
            return $this->successResponse('Quote  updated');
        }

    }

    public function getDeliveryManItems($id)
    {

        $unCompletedOrders = Order::where('delivery_man_id', $id)->where('status', '<>', 'completed')->get();
        $completedOrders = Order::where('delivery_man_id', $id)->where('status', 'completed')->get();

        $data = array(
            'completedOrders' => $completedOrders,
            'unCompletedOrders' => $unCompletedOrders,
        );
        return $this->successResponse('', $data);
    }

    public function getCustomers()
    {

        $customers = Customer::all();

        return $this->successResponse('', $customers);
    }
}
