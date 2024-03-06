<?php

namespace Packages\Modules\Larashop\Http\Controllers;

use Packages\Foundation\DataTables\PackagesBuilder;
use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\Larashop\Contracts\ShippingContract;
use Packages\Modules\Larashop\DataTables\MyOrdersDataTable;
use Packages\Modules\Larashop\DataTables\MyPrivatePagesDataTable;
use Packages\Modules\Larashop\DataTables\OrdersDataTable;
use Packages\Modules\Larashop\Http\Requests\ProductRequest;
use Packages\Modules\Larashop\Models\Order;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Media;

class OrdersController extends BaseController
{

    protected $shipping;

    public function __construct()
    {
        $this->resource_url = config('ecommerce.models.order.resource_url');
        $this->title = 'Larashop::module.order.title';
        $this->title_singular = 'Larashop::module.order.title_singular';
        parent::__construct();
    }

    protected function canAccess($order)
    {
        $canAccess = false;

        if (user()->hasPermissionTo('Larashop::my_orders.access') && $order->user->id == user()->id) {
            $canAccess = true;
        } elseif (user()->hasPermissionTo('Larashop::orders.access')) {
            $canAccess = true;
        }

        if (!$canAccess) {
            abort(403);
        }
    }

    /**
     * @param Request $request
     * @param OrdersDataTable $dataTable
     * @return mixed
     */
    public function index(Request $request, OrdersDataTable $dataTable)
    {
        if (!user()->hasPermissionTo('Larashop::orders.access')) {
            abort(403);
        }

        return $dataTable->render('Larashop::orders.index');
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return $this
     */
    public function edit(Request $request, Order $order)
    {
        if (!user()->hasPermissionTo('Larashop::order.update')) {
            abort(403);
        }

        $order_statuses = trans(config('ecommerce.models.order.statuses'));
        $shippment_statuses = trans(config('ecommerce.models.order.shippment_statuses'));
        $payment_statuses = trans(config('ecommerce.models.order.payment_statuses'));

        $this->setViewSharedData(['title_singular' => trans('Larashop::module.order.update')]);

        return view('Larashop::orders.edit')->with(compact('order', 'order_statuses', 'shippment_statuses', 'payment_statuses'));
    }


    /**
     * @param Request $request
     * @param Order $order
     * @return $this
     */
    public function update(Request $request, Order $order)
    {
        if (!user()->hasPermissionTo('Larashop::order.update')) {
            abort(403);
        }

        $this->validate($request, ['status' => 'required']);

        try {
            $data = $request->all();

            $shipping = $order->shipping ?? [];

            if ($request->has('shipping')) {
                $shipping = array_replace_recursive($shipping, $data['shipping']);
            }

            $billing = $order->billing ?? [];

            if ($request->has('billing')) {
                $billing = array_replace_recursive($billing, $data['billing']);
            }

            $order->update([
                'status' => $data['status'],
                'shipping' => $shipping,
                'billing' => $billing,
            ]);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Order::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param Request $request
     * @param MyOrdersDataTable $dataTable
     * @return mixed
     */
    public function myOrders(Request $request, MyOrdersDataTable $dataTable)
    {
        if (!user()->hasPermissionTo('Larashop::my_orders.access')) {
            abort(403);
        }

        return $dataTable->render('Larashop::orders.index');
    }

    /**
     * @param Request $request
     * @param MyOrdersDataTable $dataTable
     * @return mixed
     */
    public function myPrivatePages(Request $request, MyPrivatePagesDataTable $dataTable)
    {
        if (!user()->hasPermissionTo('Larashop::my_orders.access')) {
            abort(403);
        }

        return $dataTable->render('Larashop::orders.private_pages');
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function myDownloads(Request $request)
    {
        PackagesBuilder::DataTableScripts();

        if (!user()->hasPermissionTo('Larashop::my_orders.access')) {
            abort(403);
        }

        $orders = Order::myOrders()->get();

        return view('Larashop::orders.downloads')->with(compact('orders'));
    }


    /**
     * @param Request $request
     * @param Order $order
     * @return $this
     */
    public function show(Request $request, Order $order)
    {
        $this->canAccess($order);

        return view('Larashop::orders.show')->with(compact('order'));
    }


    public function downloadFile(Request $request, Order $order, $hashed_id)
    {
        $this->canAccess($order);

        $id = hashids_decode($hashed_id);

        $media = Media::findOrfail($id);

        return response()->download(storage_path($media->getUrl()));
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return $this
     */
    public function track(Request $request, Order $order)
    {
        if (user()->hasPermissionTo('Larashop::orders.access') || user()->hasPermissionTo('Larashop::my_orders.access')) {
            try {
                $tracking = \Shipping::track($order);
                return view('Larashop::orders.track')->with(compact('order', 'tracking'));
            } catch
            (\Exception $exception) {
                log_exception($exception, 'OrderController', 'Track');
            }
        }

        abort(403);
    }

}