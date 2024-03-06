?php


function latePremiums()
{

    $contracts = \App\Contract::all();

    foreach ($contracts as $contract) {
       foreach($contract->contract_premium as $premium){
           if($premium->date_type_mi < \Carbon\Carbon::now()->subDay(2)){
               if($premium->payment < $premium->amount){
                   $premium->status = 3;
                   $contract->kind = 4;
                   $premium->save();
                   $contract->save();
               }else{
                   $premium->status = 2;
                   $contract->kind = null;
                   $premium->save();
                   $contract->save();
               }

           }
       }
    }
}
//
//function contractFinished(){
//    $contracts = \App\Contract::all();
//
//    foreach($contracts as $contract){
//        $amount = $contract->contract_premium->sum('amount');
//        $payment = $contract->contract_premium->sum('payment');
//
//        if ($amount == $payment) {
//            $contract->kind = 2;
//            $contract->save();
//        }
//    }
//}


