<?php
/**
 * Created by Ahmed Zidan.
 * email: php.ahmedzidan@gmail.com
 * Project: loreal
 * Date: 11/9/18
 * Time: 8:09 PM
 */
?>

<div class="container-fluid animated fadeIn incidentreportpanel none du-5 redsection report-panel">
    {!! Form::open(['route'=>'frontend.reports.incident.store','class'=>'ajax-form']) !!}
    <div class="row">
        <div class="close"></div>
        <div class="col-lg-3 heightvh incidentleftbg animated fadeIn">
            <div class="underlogo red animated fadeInUp">
                <img class="innerlogo" src="{{asset("assets/frontend/img/logo.png")}}">
            </div>
            <div class="flexpadd">
                <span class="no red animated fadeInUp delay-1-2s">1</span>
                <span class="animated fadeInUp delay-1-4s">Incident</span>
                <span class="reporttxt animated fadeInUp delay-1-5s">Report</span>
            </div>
        </div>
        <div class=" col-lg-9 panelpadding ">
            <img class="back animated fadeInRight delay-1-7s" src="{{asset("assets/frontend/img/back.png")}}">
            <h1 class="animated fadeInUp delay-1-3s">Incident Report</h1>
            <div class="container-fluid mainpanel">
                <div class="row animated fadeInUp delay-1-4s">
                    <div class="col-lg-6 lab">

                        <span class="labeltxt">Type of Loreal Site</span>
                    </div>

                    <div class="col-lg-12">
                        <select name="type_loreal_site">
                            <option value="Factory">Factory</option>
                            <option value="L'OREAL distribution centre"> L'OREAL distribution centre</option>
                            <option value="Subcontracted distribution centre">Subcontracted distribution centre</option>
                            <option value="Administrative site">Administrative site</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="row animated fadeInUp delay-1-5s">
                    <div class="col-lg-12 lab">

                        <span class="labeltxt">Name of Loreal Site</span>
                    </div>

                    <div class="col-lg-12">
                        <p> L’Oréal Cosmetics Industries</p>
                    </div>
                    <div class="col-lg-12 lab">
                        <span class="labeltxt">Name of the Person reporting the incident</span>
                        <span id="incident_reporter-id-data" class="m-2 ajax-resp-data" style="display: none"></span>
                    </div>
                    <div class="col-lg-12">
                        <input type="text" autocomplete="off" placeholder="" value="" name="reporter_id"
                               id="incident_reporter_name">
                    </div>

                    <div class="col-lg-12 lab">
                        <span class="labeltxt">Date of the incident</span>
                    </div>
                    <div class="col-lg-12">
                        <div id="incident_date_container">
                            <input type="text" id="incident_date" autocomplete="off" class="datepicker" placeholder=""
                                   value="" name="incident_date" style="width: 100%;">
                        </div>
                    </div>

                    <div class="col-lg-12 lab">

                        <span class="labeltxt">between</span>
                    </div>
                    <div class="col-lg-12">
                        <select name="time_between">
                            <option value="1:00am to 2:00am">1:00am to 2:00am</option>
                            <option value="2:00am to 3:00am">2:00am to 3:00am</option>
                            <option value="3:00am to 4:00am">3:00am to 4:00am</option>
                            <option value="4:00am to 5:00am">4:00am to 5:00am</option>
                            <option value="5:00am to 6:00am">5:00am to 6:00am</option>
                            <option value="6:00am to 7:00am">6:00am to 7:00am</option>
                            <option value="7:00am to 8:00am">7:00am to 8:00am</option>
                            <option value="8:00am to 9:00am">8:00am to 9:00am</option>
                            <option value="9:00am to 10:00am">9:00am to 10:00am</option>
                            <option value="10:00am to 11:00am">10:00am to 11:00am</option>
                            <option value="11:00am to 12:00pm">11:00am to 12:00pm</option>
                            <option value="12:00pm to 1:00pm">12:00am to 1:00pm</option>
                            <option value="1:00pm to 2:00pm">1:00pm to 2:00pm</option>
                            <option value="2:00pm to 3:00pm">2:00pm to 3:00pm</option>
                            <option value="3:00pm to 4:00pm">3:00pm to 4:00pm</option>
                            <option value="4:00pm to 5:00pm">4:00pm to 5:00pm</option>
                            <option value="5:00pm to 6:00pm">5:00pm to 6:00pm</option>
                            <option value="6:00pm to 7:00pm">6:00pm to 7:00pm</option>
                            <option value="7:00pm to 8:00pm">7:00pm to 8:00pm</option>
                            <option value="8:00pm to 9:00pm">8:00pm to 9:00pm</option>
                            <option value="9:00pm to 10:00pm">9:00pm to 10:00pm</option>
                            <option value="10:00pm to 11:00pm">10:00pm to 11:00pm</option>
                            <option value="11:00pm to 12:00am">11:00pm to 12:00am</option>
                            <option value="12:00am to 1:00am">12:00am to 1:00am</option>
                        </select>

                    </div>


                    <div class="col-lg-12 lab">

                        <span class="labeltxt">Nature of the Incident</span>
                    </div>
                    <div class="col-lg-12">
                        <select name="incident_nature">
                            <option value="Accident of person">Accident of person</option>
                            <option value="Accidental spillage">Accidental spillage
                            </option>
                            <option value="Aerosol incident">Aerosol incident
                            </option>
                            <option value="Explosion">Explosion
                            </option>
                            <option value="Fire">Fire
                            </option>
                            <option value="Incident transport FG">Incident transport FG
                            </option>
                            <option value="Material damage">Material damage
                            </option>
                            <option value="Natural catastrophe">Natural catastrophe
                            </option>
                            <option value="Near miss">Near miss
                            </option>
                            <option value="Near fire">Near fire
                            </option>
                            <option value="Road accident">Road accident
                            </option>
                            <option value="Sanitary">Sanitary
                            </option>
                            <option value="Theft">Theft</option>
                            <option value="Threat / attack">Threat / attack
                            </option>
                            <option value="Other">Other
                            </option>


                        </select>

                    </div>

                    <div class="col-lg-12 lab">

                        <span class="labeltxt">Place of the Incident</span>
                    </div>
                    <div class="col-lg-12">
                        <select name="incident_place">
                            <option value="On site (list)">On site (list)</option>
                            <option value="Break room">Break room</option>
                            <option value="Changing -room">Changing -room</option>
                            <option value="Laboratory">Laboratory</option>
                            <option value="Lavatory">Lavatory</option>
                            <option value="Major project/Work site">Major project/Work site</option>
                            <option value=">Manufacturing zone">Manufacturing zone</option>
                            <option value="Office">Office</option>
                            <option value="Outside">Outside</option>
                            <option value="Packaging zone">Packaging zone</option>
                            <option value="Parking/Road">Parking/Road</option>
                            <option value="Pilote / Demi-Grand">Pilote / Demi-Grand</option>
                            <option value="Preparation orders">Preparation orders</option>
                            <option value="Receipt / Expedition">Receipt / Expedition</option>
                            <option value="Restaurant/Cafeteria">Restaurant/Cafeteria</option>
                            <option value="Storage RM/FG/AP …">Storage RM/FG/AP …</option>
                            <option value="Technical zone">Technical zone</option>
                            <option value="Terrace / Roof">Terrace / Roof</option>
                            <option value="Waste collection zone">Waste collection zone</option>
                            <option value="Workshop">Workshop</option>
                            <option value="STEP">STEP</option>
                            <option value="Other">Other</option>

                        </select>

                    </div>
                    <div class="col-lg-12 lab">

                        <span class="labeltxt">Type of the incident</span>
                    </div>

                    <div class="col-lg-12">
                        <select name="incident_type">
                            <option value="">To select from the list</option>
                            <option value="Lost time accident">Lost time accident</option>
                            <option value="No lost time accident">No lost time accident</option>
                            <option value="No lost time accident + light duty">No lost time accident + light duty
                            </option>
                            <option value="Death">Death</option>


                        </select>

                    </div>
                    <div class="col-lg-12 lab">

                        <span class="labeltxt">Injured Person</span>
                    </div>

                    <div class="col-lg-12">
                        <select name="injured_person_type">
                            <option value="">To select from the list</option>
                            <option value="L'OREAL personel">L'OREAL personel</option>
                            <option value="Temporary personel">Temporary personel
                            </option>
                            <option value="Trainee / Apprentice">Trainee / Apprentice
                            </option>
                            <option value="Casual worker of holidays">Casual worker of holidays
                            </option>
                            <option value="Outside company">Outside company
                            </option>
                            <option value="Visitor">Visitor
                            </option>
                            <option value="Other">Other
                            </option>
                        </select>

                    </div>


                    <div class="col-lg-12 lab">

                        <span class="labeltxt">Numbers of Days Lost</span>
                    </div>
                    <div class="col-lg-12">
                        <input type="number" placeholder="" value="" name="lost_days" min="0">

                    </div>

                    <div class="col-lg-12 lab">

                        <span class="labeltxt">Numbers of Days in light Duty</span>
                    </div>
                    <div class="col-lg-12">
                        <input type="number" placeholder="" value="" name="duty_days" min="0">

                    </div>

                </div>

            </div>


            <br>
            <br>
            <br>


            <h1 class="animated fadeInUp">Circumstances</h1>
            <div class="container-fluid mainpanel">


                <div class="row">
                    <div class="col-lg-12 lab">

                        <p>
                            the 7th rack forkleft while trying to enter packaging area its mast hit the air curtains
                            devise and broke it
                        </p>
                    </div>

                    <div class="col-lg-12">
                        <textarea placeholder="" name="circumstances"></textarea>
                    </div>
                </div>


            </div>

            <br><br><br>
            <h1 class="animated fadeInUp">Consequences</h1>
            <div class="container-fluid mainpanel">


                <div class="row">
                    <div class="col-lg-12 lab">

                        <p>
                            bpart of the air curtains devise broke
                        </p>
                    </div>

                    <div class="col-lg-12">
                        <textarea placeholder="" name="consequences"></textarea>
                    </div>

                    <div class="col-lg-12 lab">

                        Nature of Lesions
                    </div>
                    <div class="col-lg-12">
                        <select name="lesions_nature">
                            <option value="">To select from the list
                            </option>
                            <option value="Bruise">Bruise
                            </option>
                            <option value="Burn / Irritation">Burn / Irritation
                            </option>
                            <option value="Chemical burn">Chemical burn
                            </option>
                            <option value="Dorsolumbar trauma">Dorsolumbar trauma
                            </option>
                            <option value="Electric shock">Electric shock
                            </option>
                            <option value="Fracture">Fracture
                            </option>
                            <option value="Internal bleeding">Internal bleeding
                            </option>
                            <option value="Poisoning">Poisoning
                            </option>
                            <option value="Sprain">Sprain
                            </option>
                            <option value="Torn muscle">Torn muscle
                            </option>
                            <option value="Wound / Cut">Wound / Cut
                            </option>
                            <option value="Other">Other
                            </option>


                        </select>

                    </div>


                    <div class="col-lg-12 lab">

                        Location of Lesions
                    </div>
                    <div class="col-lg-12">
                        <select name="lesions_location">
                            <option value="Arm">Arm

                            </option>
                            <option value="Eye">Eye

                            </option>
                            <option value="Foot">Foot

                            </option>
                            <option value="Hand">Hand

                            </option>
                            <option value="Head">Head

                            </option>
                            <option value="Leg">Leg

                            </option>
                            <option value="Neck">Neck

                            </option>
                            <option value="Respiratory system">Respiratory system

                            </option>
                            <option value="Trunk">Trunk

                            </option>
                            <option value="Other">Other</option>

                        </select>

                    </div>


                </div>


            </div>


            <br><br><br>
            <h1 class="animated fadeInUp">Possible Causes</h1>
            <div class="container-fluid mainpanel">


                <div class="row">


                    <div class="col-lg-12 lab">

                        Root Causes analysis
                    </div>
                    <div class="col-lg-12">
                        <select name="causes_analysis">
                            <option value="">To select from the list</option>
                            <option value="Foreseen">Foreseen</option>
                            <option value="Not foreseen">Not foreseen</option>
                            <option value="Made">Made</option>


                        </select>

                    </div>


                    <div class="col-lg-12 lab">

                        <p>
                            1-the 7th rack forkleft mast is too high to pass throw the door between WH and packaging
                            area
                        </p>
                    </div>
                    <div class="col-lg-12">
                        <textarea name="description_causes"></textarea>
                    </div>


                </div>


            </div>
            <br><br><br>
            <h1 class="animated fadeInUp">Plan of Immidiate Actions / Long Times</h1>
            <div class="container-fluid mainpanel">


                <div class="row">


                    <div class="col-lg-12 lab">

                        <p>
                            notify all forkleft drivers that its not allowed for the 7th rack forkleft to enter
                            packaging area
                        </p>
                    </div>
                    <div class="col-lg-12">
                        <textarea name="actions_plans"></textarea>

                    </div>


                </div>


            </div>
            <button type="submit" class="btn btn-primary3 btn-rounded red">Send</button>

        </div>


    </div>
    {!! Form::close() !!}
</div>
@push("scripts")
    <script type="text/javascript">
        $("#incident_reporter_name").keyup(function () {
            let val = $(this).val();
            axios.post("{{route("frontend.ajax.validateEmpId")}}", {id: val}).then(
                resp => {
                    response = resp.data;
                    if (response.success) {
                        $("#incident_reporter-id-data").html(response.data.empname).removeClass().addClass("text-success").show();
                    } else {
                        $("#incident_reporter-id-data").html(response.message).removeClass().addClass("text-danger").show();

                    }
                }
            );
        });
        $("#incident_date").datepicker({
            format: "dd/mm/yyyy",
            todayBtn: "linked",
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
            scrollTop: 0,
            container: "#incident_date_container"
        });
    </script>
@endpush
