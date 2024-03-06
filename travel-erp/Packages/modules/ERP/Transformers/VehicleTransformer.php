<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Vehicle;

class VehicleTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.vehicle.resource_url');

        parent::__construct();
    }

    /**
     * @param Vehicle $vehicle
     * @return array
     * @throws \Throwable
     */
    public function transform(Vehicle $vehicle)
    {
        $show_url = url($this->resource_url . '/' . $vehicle->hashed_id);
        return [
            'id' => $vehicle->id,
            'name' => $vehicle->name,
            'category_id' => $vehicle->category?$vehicle->category->name:'',
            'country_id' => $vehicle->country?$vehicle->country->name:'',
            'driver_id' => $vehicle->driver?$vehicle->driver->translated_name:'',
            'vehicle_number' => $vehicle->vehicle_number,
            'vehicle_model' => $vehicle->vehicle_model,
            'model_year' => $vehicle->model_year,
            'notes' => $vehicle->id ,
            'created_by' => $vehicle->created_by_name,
            'updated_by' => $vehicle->updated_by_name,
            'status' => formatStatusAsLabels($vehicle->status > 0?'active': 'inactive'),
            'created_at' => format_date($vehicle->created_at),
            'updated_at' => format_date($vehicle->updated_at),
            'action' => $this->actions($vehicle)
        ];
    }
}