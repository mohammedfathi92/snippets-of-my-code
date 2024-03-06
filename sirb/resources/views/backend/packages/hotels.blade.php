<?php
/**
 * Created by mohammed Zidan.
 * email: php.mohammedzidan@gmail.com
 * Project: shawate
 * Date: 7/20/18
 * Time: 9:33 PM
 */
?>
<h3 data-toggle="collapse" data-target="#citiesHotels" aria-expanded="false"
    aria-controls="citiesHotels">{{trans('packages.title_package_hotels')}} <span
            data-ng-show="hotelsLoading" class="btn-group-addon"><i
                class="fa fa-spinner fa-pulse fa-fw"></i></span></h3>
<fieldset class="collapse group-list  well" id="citiesHotels">
    <legend></legend>
    <table class="table">
        <thead>
        <tr>
            <th>{{trans("packages.label_city")}}</th>
            <th>{{trans("packages.label_hotel")}}</th>
            <th>{{trans("packages.label_room")}}</th>
            <th>{{trans("packages.label_rooms_count")}}</th>
            <th>{{trans("packages.label_days")}}</th>
            <th>{{trans("packages.label_order")}}</th>
            <th>
                <button class="btn btn-primary" type="button" data-ng-click="addHotel()"><i
                            class="fa fa-plus"></i> {{trans("main.btn_add")}}</button>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr data-ng-repeat="item in items ">
            <td>
                <select name="rooms[city][]" id="city-<%$index%>" data-ng-model="item.city"
                        data-ng-change="getCityHotels($index)"
                        class="form-control"
                        data-ng-disabled="!citiesList.length || !country ">
                    <option value=""></option>
                    <option data-ng-repeat="city in citiesList" value="<%city.id%>">
                        <%city.name%>
                    </option>
                </select>
            </td>
            <td>
                <select name="rooms[hotel][]" id="hotel-<%$index%>"
                        data-ng-model="item.hotel"
                        data-ng-change="getHotelRooms($index)"
                        class="form-control"
                        data-ng-disabled="!citiesList.length || !item.hotelsList.length">
                    <option value=""></option>
                    <option data-ng-repeat="hotel in item.hotelsList"
                            value="<%hotel.id%>"><%hotel.name%>
                    </option>
                </select>
            </td>
            <td>
                <select name="rooms[room][]" id="room-<%$index%>" data-ng-model="item.room"
                        class="form-control"
                        data-ng-disabled="!citiesList.length || !item.hotel || !item.roomsList.length">
                    <option value=""></option>
                    <option data-ng-repeat="room in item.roomsList" value="<%room.id%>">
                        <%room.name%>
                    </option>
                </select>
            </td>
            <td>
                <input type="number" name="rooms[rooms_count][]" id="rooms_count-<%$index%>"
                       data-ng-model="item.rooms_count"
                       data-ng-init="item.rooms_count|1"
                       data-ng-disabled="!citiesList.length || !item.hotel || !item.roomsList.length"
                       class="form-control"
                       min="1"
                       value="1"/>
            </td>
            <td>
                <input type="number" name="rooms[days][]" value="1" min="1"
                       class="form-control"
                       data-ng-model="item.days"
                       data-ng-disabled="!citiesList.length || !item.room">

            </td>
            <td>
                <input type="number" name="rooms[order][]" value="1" min="1"
                       class="form-control"
                       data-ng-model="item.order">
            </td>
            <td>

                <button type="button" class="btn btn-danger"
                        data-ng-click="removeHotel($index)"><i
                            class="fa fa-trash"></i></button>
            </td>
        </tr>
        </tbody>
    </table>
</fieldset>
