<?php

namespace App\Helpers\Main;
 
use Illuminate\Support\Facades\DB;
use App\Contract;
use App\User;
use App\ContractPremium;
use App\Company_account;
 
class Aqsat {
   
    public static function latedContracts() {
      $contracts = Contract::where('kind', 4)->orWhere('kind', null)->with('contract_premium');
      if($contracts){
       foreach ($contracts->get() as $contract) {
        $premiums = $contract->contract_premium;
        $count = $premiums->where('date_type_mi', '<', \Carbon\Carbon::now()->subDay(setting('admin.mark_as_delay')?:1))
        ->where('status', '!=', 2)
        ->count();

        if($count > 0){
          $contract->kind = 4;
          $contract->save();
           }else{
          $contract->kind = null;
          $contract->save();
           }
          $latedPremiums = $premiums->where('date_type_mi', '<', \Carbon\Carbon::now()->subDay(setting('admin.mark_as_delay_premium')?:1))
        ->where('status', '!=', 2);


        $currentPremium = $premiums->where('date_type_mi', '>', \Carbon\Carbon::now()->subDay(setting('admin.mark_as_delay_premium')?:1))
        ->where('status', '!=', 2);

        if($latedPremiums){
          foreach ($latedPremiums as $prem) {
           $prem->status = 3;
           $prem->save();
          }
         
        }

        if($currentPremium){
            foreach ($currentPremium as $prem) {
              if($prem->payment > 0){

                $prem->status = 1;
               $prem->save();


              }else{

              $prem->status = 0;
               $prem->save();


              }
           
          }

        }

       }
        
        return true;
    }
  }

    public static function markAsLated(){


     $remarkRow = DB::table('remark_contracts')->where('slug', 'main');
     if($remarkRow){
     $remarkDate = $remarkRow->first()->updated_at;

     if($remarkDate < \Carbon\Carbon::now()->subDay(1)){
       self::latedContracts();

       $remarkRow->update(['status' => true, 'updated_at' => \Carbon\Carbon::now()]);

     }

     return true;

    }

    return false;

    }



    public static function isLated($contract_id) {   //for contracts => is contract lated
      
         $count = ContractPremium::where('contract_id',$contract_id)
         ->where('date_type_mi', '<', \Carbon\Carbon::now()->subDay(setting('admin.mark_as_delay')?:0))
         ->where('status', '!=', 2)
         ->count();

        if($count > 0){
          $contract->kind = 4;
          $contract->save();
        return true;
        }else{
          return false;
        }   
    }

    public static function latedPremiums($contract_id) {  //for spacific contract
        $premiums = ContractPremium::where('contract_id',$contract_id)
        ->where('date_type_mi', '<', \Carbon\Carbon::now()->subDay(setting('admin.mark_as_delay')?:0))
        ->where('status', '!=', 2)
        ->get();
        
        return $premiums;
    }


    public static function isPaid($contract_id) {  //for contracts => is contract paid (all premiums paid)
         $count_paid = ContractPremium::where('contract_id',$contract_id)
         ->where('status', 2)
         ->count();

         $count_all = ContractPremium::where('contract_id',$contract_id)
         ->count();

        if($count_paid >= $count_all){
          $contract->kind = 2;
          $contract->save();
        return true;
        }else{
          return false;
        } 
        
    }

public static function delete($module, $module_id, $status = false, $options = null){
  switch ($module) {
    case 'contract':
        $contract = Contract::find($module_id);
        $investor = $contract->investor;
        $accounts = [];

        //1 => Retrieval principal Money { products Price} 

        $contract_products_amount = 0.0;
         $contract_products = DB::table('contract_product')->where('contract_id', $contract->id)->get();
         foreach ($contract_products as $pro) {
           $contract_products_amount += ($pro->first_payment * $pro->quantity);
         }
          if(isset($options['products_account'])){
           $investor_account = Company_account::find($options['products_account']);
              
          if($investor_account){
            $investor_account->account_value += $contract_products_amount;
            $investor_account->save();
          }else{

          return redirect()->back()->with(['message' => __('messages.contracts.error_not_fount_account', ['account' => 'حساب استرجاع قيمة رأس المال']), 'alert_danger' => 'info']);


          }

           }

          // Retrieval first payment
            $first_payment_amount = $contract->first_payment;
          if(isset($options['first_pay_account']) && $options['first_pay_account'] > 0){
           

          $first_payment_account = Company_account::find($options['first_pay_account']);

        if($first_payment_account){
          if($first_payment_account->account_value >= $first_payment_amount){
           $first_payment_account->account_value -= $first_payment_amount;
           $first_payment_account->save();
           $accounts[] = ['id' => isset($options['first_pay_account'])?:0, 'amount' => $first_payment_amount, 'type' => 'plus'];
          }else{
             self::returnData(['accounts' => $accounts, 'contract' => $contract->id, 'products_account' => $options['products_accounts'], 'message' => 'messages.contracts.error_delete_first_payment']);
          }
        }else{
           self::returnData(['accounts' => $accounts, 'contract' => $contract->id, 'products_account' => $options['products_accounts'], 'message' => 'messages.contracts.error_delete_first_payment']);
        }

          }elseif(isset($options['first_pay_account']) &&  $options['first_pay_account'] < 1){


            $minus = self::minusFromAll($contract->investor_id, $first_payment_amount);
            $accounts[] = $minus['accounts'];


            if($minus['status'] == false){
            self::returnData(['accounts' => $accounts, 'contract' => $contract->id, 'products_account' => $options['products_accounts'], 'message' => 'messages.contracts.error_delete_first_payment']);

            }

          }

           // Retrieval contract commission
           $contract_commission_payment = $contract->contract_profit_payment;

          if(isset($options['commission_account']) && $options['commission_account'] > 0){

          $contract_commission_account = Company_account::find($options['commission_account']);

        if($contract_commission_account){
          if($contract_commission_account->account_value >= $contract_commission_payment){
           $contract_commission_account->account_value -= $contract_commission_payment;
           $contract_commission_account->save();
            $accounts[] = ['id' => isset($options['commission_account'])?:0, 'amount' => $contract_commission_payment, 'type' => 'plus'];
          }else{

          self::returnData(['accounts' => $accounts, 'contract' => $contract->id, 'products_account' => $options['products_accounts'], 'message' => 'messages.contracts.error_delete_commission_payment']);
          }
        }else{
        self::returnData(['accounts' => $accounts, 'contract' => $contract->id, 'products_account' => $options['products_accounts'], 'message' => 'messages.contracts.error_not_fount_account']);
        }

          }elseif(isset($options['commission_account']) && $options['commission_account'] < 1){
            $contract_commission_account = Company_account::find($contract->commission_account);

            $minus = self::minusFromAll($contract_commission_account->user_id, $contract_commission_payment);
            $accounts[] = $minus['accounts'];

            if($minus['status'] == false){
          self::returnData(['accounts' => $accounts, 'contract' => $contract->id, 'products_account' => $options['products_accounts'], 'message' => 'messages.contracts.error_delete_commission_payment']);
   

            }

          }

          // Retrieval contract fees
           $contract_fees_payment = $contract->contract_fees_payment;

          if(isset($options['fees_account']) && $options['fees_account'] > 0){

          $contract_fees_account = Company_account::find($options['fees_account']);

        if($contract_fees_account){
          if($contract_fees_account->account_value >= $contract_fees_payment){
           $contract_fees_account->account_value -= $contract_fees_payment;
           $contract_fees_account->save();
           $accounts[] = ['id' => isset($options['fees_account'])?:0, 'amount' => $contract_fees_payment, 'type' => 'plus'];
          }else{
self::returnData(['accounts' => $accounts, 'contract' => $contract->id, 'products_account' => $options['products_accounts'], 'message' => 'messages.contracts.error_delete_fees_payment']);          }
        }else{
          self::returnData(['accounts' => $accounts, 'contract' => $contract->id, 'products_account' => $options['products_accounts'], 'message' => 'messages.contracts.error_delete_fees_payment']);
             }

          }elseif(isset($options['fees_account']) && $options['fees_account'] < 1){

            $minus = self::minusFromAll(1, $contract_fees_payment);
            $accounts[] = $minus['accounts'];

            if($minus['status'] == false){
          self::returnData(['accounts' => $accounts, 'contract' => $contract->id, 'products_account' => $options['products_accounts'], 'message' => 'messages.contracts.error_delete_fees_payment']);
   
            }

          }



        // Retrieval contract premium payments
          if($contract->quittance){
            $contract_paid_value = $contract->contract_value - $contract->discount;
           $contract_premiums_payment = ($contract->contract_premium->sum('payment') + $contract_paid_value) - $contract->contract_profit_payment;
         }else{
           $contract_premiums_payment = $contract->contract_premium->sum('payment') - $contract->contract_profit_payment;

         }

          if(isset($options['premium_account']) && $options['premium_account'] > 0){

          $contract_premiums_account = Company_account::find($options['premium_account']);

        if($contract_premiums_account){
          if($contract_premiums_account->account_value >= $contract_premiums_payment){
           $contract_premiums_account->account_value -= $contract_premiums_payment;
           $accounts[] = ['id' => isset($options['premium_account'])?:0, 'amount' => $contract_premiums_payment, 'type' => 'plus'];
           $contract_premiums_account->save();
          }else{
          self::returnData(['accounts' => $accounts, 'contract' => $contract->id, 'products_account' => $options['products_accounts'], 'message' => 'messages.contracts.error_delete_premium_payment']);
          }
        }else{
          self::returnData(['accounts' => $accounts, 'contract' => $contract->id, 'products_account' => $options['products_accounts'], 'message' => 'messages.contracts.error_delete_premium_payment']);
        }

          }elseif(isset($options['premium_account']) && $options['premium_account'] < 1){

            $minus = self::minusFromAll($contract->investor_id, $contract_premiums_payment);
            $accounts[] = $minus['accounts'];

            if($minus['status'] == false){
         self::returnData(['accounts' => $accounts, 'contract' => $contract->id, 'products_account' => $options['products_accounts'], 'message' => 'messages.contracts.error_delete_premium_payment']);

            }

          }
          if($premiums_all = $contract->contract_premium){
          foreach ($premiums_all = $contract->contract_premium as $prem) {
          $prem->forceDelete(); 
          }
          }
 
      $contract->forceDelete(); 

        break;
    case 'investor':
        return redirect()->back();
        break;
        default:
        return redirect()->back();

           }
}


 public static function returnData($data = null) {  //for contracts => is contract paid (all premiums paid)

 if(isset($data['accounts'])){
  foreach ($data['accounts'] as $account) {
 $company_account = Company_account::find($account);
  $company_account->account_value += $data['amount'];
$company_account->save();
    
  }


 }

   $contract = Contract::find($data['contract']);
        $investor = $contract->investor;
        //1 => Retrieval principal Money { products Price} 
        $contract_products_amount = 0.0;
         $contract_products = DB::table('contract_product')->where('contract_id', $contract->id)->get();
         foreach ($contract_products as $pro) {
           $contract_products_amount += ($pro->first_payment * $pro->quantity);
         }
        
       
           $investor_account = Company_account::find($data['products_account']);
            $investor_account->account_value -= $contract_products_amount;
            $investor_account->save();
        


            return redirect()->back()->with(['message' => __($data['message']), 'alert_danger' => 'info']);



 }

   public static function minusFromAll($user_id = 0, $amount) {  //for contracts => is contract paid (all premiums paid)
        $accounts = [];
         $user = User::find($user_id);
         if($user){
          $accounts = $user->company_account;
          if($accounts->count()){
            $sum_accounts_value = $user->company_account->sum('account_value');
            if($sum_accounts_value >= $amount){
              foreach ($accounts as $account) {
              if($amount >= $account->account_value){
                $accounts[] = ['id' => $account->id, 'amount' => $account->account_value, 'type' => 'plus'];
                 $amount -= $account->account_value;
                 $account->account_value = 0.00;
                  $account->save();
              }else{
                $accounts[] = ['id' => $account->id, 'amount' => $amount, 'type' => 'plus'];
                 $account->account_value -= $amount;
                  $account->save();
                  $amount = 0.00;

              }
             
         }

         return $accounts; 
    }
    return false;

    }
  }
 }
}
