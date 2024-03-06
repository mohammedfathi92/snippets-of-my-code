<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class LorealSettingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('loreal_settings')->insert([
            [
                'code' => 'loreal_main_work_areas',
                'notes' => 'Use unique Alphabit as a keys',
                'label' => 'Loreal Main Work Areas',
                'value' => '{"a":"Area A","b":"Workers Wardrobe"}',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'loreal_sub_work_areas',
                'notes' => 'Please write keys of sub areas as prefix with key of main area of each of them and then right its unique order ex. sub areas [L, M, N] have main area B with key (b) so their keys with [b1, b2, b3] respectively',
                'label' => 'Loreal Sub Work Areas',
                'value' => '{"a1":"Sub Area N for main A", "a2":"Sub Area M for main A","b3":"Sub T Area for main B"}',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'loreal_potential_risks',
                'notes' => 'key is a unique Number',
                'label' => 'Potential risks',
                'value' => '{"1":"Broken / missing parts ", "2":"Broken / missing parts","3":"Broken / missing parts ", "4":"Broken / missing parts"}',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'loreal_site_types',
                'notes' => 'key is a unique Number',
                'label' => 'Type of Loreal Site',
                'value' => '{"1":"Factory", "2":"LOREAL distribution centre","3":"Subcontracted distribution centre", "4":"Administrative site", "5":"Other"}',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'loreal_incident_nature',
                
                'notes' => 'key is a unique Number',
                'label' => 'Natures of the Incident',
                'value' => '{"1":"Accident of person","2":"Accidental spillage","3":"Aerosol incident","4":"Explosion","5":"Fire","6":"Incident transport FG","7":"Material damage","8":"Natural catastrophe","9":"Near miss","10":"Near fire","11":"Road accident","12":"Sanitary","13":"Theft","14":"Threat \/ attack","15":"Other"}',
                
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'loreal_incident_places',
                
                'notes' => 'key is a unique Number',
                'label' => 'Places of the Incident',
                'value' => '{"1":"Break room","2":"Changing clothes-room","3":"Laboratory","4":"Lavatory","5":"Major project\/Work site","6":"Manufacturing zone","7":"Office","8":"Outside","9":"Packaging zone","10":"Parking\/Road","11":"Pilote \/ Demi-Grand","12":"Preparation orders","13":"Receipt \/ Expedition","14":"Restaurant\/Cafeteria","15":"Storage RM\/FG\/AP \u2026","16":"Technical zone","17":"Terrace \/  Roof","18":"Waste collection zone","19":"Workshop","20":"STEP","21":"Other"}',
                
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'loreal_incident_types',
                
                'notes' => 'key is a unique Number',
                'label' => 'Types of the incident',
                'value' => '{"1":"Lost time accident","2":"No lost time accident","3":"No lost time accident + light duty","4":"Death"}',
                
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'loreal_injured_persons_types',
                
                'notes' => 'key is a unique Number',
                'label' => 'Types of Injured Persons',
                'value' => '{"1":"L\'OREAL personel","2":"Temporary personel","3":"Trainee / Apprentice","4":"Casual worker of holidays","5":"Outside company","6":"Visitor","7":"Other"}',
                
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'loreal_injured_persons_position',
                
                'notes' => 'key is a unique Number',
                'label' => 'Position of Injured Persons',
                'value' => '{"1":""}',
                
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'loreal_incident_time_between',
                
                'notes' => 'key is a unique Number',
                'label' => 'Incident Time Between',
                'value' => '{"1":"1:00am to 2:00am","2":"2:00am to 3:00am","3":"3:00am to 4:00am","4":"4:00am to 5:00am","5":"5:00am to 6:00am","6":"6:00am to 7:00am","7":"7:00am to 8:00am"}',
                
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'loreal_lesions_nature',
                
                'notes' => 'key is a unique Number',
                'label' => 'Nature of Lesions',
                'value' => '{"1":"Bruise","2":"Burn \/ Irritation","3":"Chemical burn","4":"Dorsolumbar trauma","5":"Electric shock","6":"Fracture","7":"Internal bleeding","8":"Poisoning","9":"Sprain","10":"Torn muscle","11":"Wound \/ Cut","12":"Other"}',
                
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'loreal_lesions_location',
                
                'notes' => 'key is a unique Number',
                'label' => 'Location of Lesions',
                'value' => '{"1":"Arm","2":"Eye","3":"Foot","4":"Hand","5":"Head","6":"Leg","7":"Neck","8":"Respiratory system","9":"Trunk","10":"Other"}',
                
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'loreal_causes_analysis',
                
                'notes' => 'key is a unique Number',
                'label' => 'Root Causes analysis',
                'value' => '{"1":"Foreseen","2":"Not foreseen","3":"Made"}',
                
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
        
    }
}
