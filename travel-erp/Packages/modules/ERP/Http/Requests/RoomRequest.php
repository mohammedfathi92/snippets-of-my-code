<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\Room;

class RoomRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Room::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $this->setModel(Room::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {

            $rules = array_merge($rules, [
                'name.*' => 'required',
                'hotel_id' => 'required',
                // 'price'=> 'required|numeric',
               
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [

            ]);
        }

        if ($this->isUpdate()) {
            $room = $this->route('room');

            $rules = array_merge($rules, [
                'reg_code'=> 'required|max:191|unique:erp_rooms,reg_code,'.$room->id,

            ]);
        }

        return $rules;
    }
}
