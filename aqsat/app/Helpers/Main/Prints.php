<?php

namespace App\Helpers\Main;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Contract;
use App\User;
use App\Company_account;
use App\ContractPremium;
use App\Financial_transaction;
use Carbon\Carbon;
use App\PrintAction;
use App\PrintTemplate;
 
class Prints {
   
  public static function setSanad($content = null, $module = null, $module_id = 0) {
if($module == 'contract_1'){
    $contract = Contract::findOrFail($module_id);
    $arrCode = [
      'dn_investor_name',
      'dn_client_name',
      'dn_kafil_name_1',
      'dn_kafil_name_2',
      'dn_contract_no',
      'dn_aqsat_no',
      'dn_contract_start_date_mi',
      'dn_contract_write_date',
      'dn_contract_start_date_hj',
      //'dn_contract_write_date_hj',
      'dn_commission',
      'dn_contract_fees',
      'dn_account_box',
      'dn_contract_price',
      'dn_one_qest_price',
      'dn_last_qest_price',
      'dn_first_pay',
      'dn_print_date_mi',
      'dn_sanad_no',

    ];
     $investor = User::findOrFail($contract->investor_id);
     $investorName = '';
     if($investor){
       $invesorName = $investor->name;
     }
     $client = User::findOrFail($contract->client_id);
     $clientName = '';
     if($client){
       $clientName = $client->name;
     }
     $kafil_1_name = '';
     if($contract->sponsor_id){
     $kafil_1 = User::findOrFail($contract->sponsor_id);
     if($kafil_1){
       $kafil_1_name = $kafil_1->name;
     }
     }
     $kafil_2_name = '';
   if($contract->sponsor_two_id){
     $kafil_2 = User::findOrFail($contract->sponsor_two_id);
     if($kafil_2){
       $kafil_2_name = $kafil_2->name;
     }
   }

     $account = Company_account::findOrFail($contract->account_id);
     $account_name = '';
     if($account){
       $account_name = $account->name;
     }

    $arrContent = [
      $invesorName,
      $clientName,
      $kafil_1_name,
      $kafil_2_name,
      $contract->contract_num,
      $contract->premiums_number,
      $contract->premiums_start_date,
      $contract->contract_date,
      $contract->premiums_start_date_hijry,
      $contract->contract_profit,
      $contract->fees,
      $account_name,
      $contract->contract_value,
      $contract->premiums_value,
      $contract->last_premium,
      $contract->first_payment,
      Carbon::now(),
      rand(10,100).$contract->id,
    ];

    }
if($module == 'qest'){
    $qest = ContractPremium::findOrFail($module_id);
      $arrCode = [
      'dn_contract_no',
      'dn_qest_no',
      'dn_investor_name',
      'dn_client_name',
      'dn_kafil_name_1',
      'dn_kafil_name_2',
      'dn_qest_date_mi',
      'dn_qest_date_hj',
      'dn_account_box',
      'dn_amount_pay',
      'dn_qest_remain',
      'dn_contract_remain',
      'dn_print_date_mi',
      'dn_sanad_no',
      
    ];
     $investor = User::findOrFail($qest->contract->investor_id);
     $investorName = '';
     if($investor){
       $invesorName = $investor->name;
     }
     $client = User::findOrFail($qest->contract->client_id);
     $clientName = '';
     if($client){
       $clientName = $client->name;
     }
     $kafil_1_name = '';
     if($qest->contract->sponsor_id){
     $kafil_1 = User::findOrFail($qest->contract->sponsor_id);
     if($kafil_1){
       $kafil_1_name = $kafil_1->name;
     }
     }
     $kafil_2_name = '';
   if($qest->contract->sponsor_two_id){
     $kafil_2 = User::findOrFail($qest->contract->sponsor_two_id);
     if($kafil_2){
       $kafil_2_name = $kafil_2->name;
     }
   }
      $account_name = '';
if($qest->account_id){
     $account = Company_account::findOrFail($qest->account_id);
  
     if($account){
       $account_name = $account->name;
     }
     }
     $contract = $qest->contract;
     $remain_qest = $qest->amount - $qest->payment;
     $aqsat_remain = $contract->contract_premium()->sum('amount') - $contract->contract_premium()->sum('payment');


    $arrContent = [
      $qest->contract->contract_num,
      $qest->order,
      $investorName,
      $clientName,
      $kafil_1_name,
      $kafil_2_name,
      $qest->date_type_mi,
      $qest->date_type_hij,
      $account_name,
      $qest->payment,
      $remain_qest,
      $aqsat_remain,
      Carbon::now(),
      rand(10,100).$qest->id,
    ];
  }

    //transfer
  if($module == 'transfer'){
    $transfer = Financial_transaction::findOrFail($module_id);
    $arrCode = [
      'dn_transfer_from_user',
      'dn_transfer_to_user',
      'dn_transfer_from_box',
      'dn_transfer_to_box',
      'dn_transfer_amount',
      'dn_print_date_mi',
      'dn_sanad_no',
      
    ];
    
     $from_user = User::findOrFail($transfer->user_id);
     $from_user_name = '';
     if($from_user){
       $from_user_name = $from_user->profile->name;
     }

     $to_user = User::findOrFail($transfer->to_user);
     $to_user_name = '';
     if($to_user){
       $to_user_name = $to_user->profile->name;
     }

     $from_account = User::findOrFail($transfer->account_id);
     $from_account_name = '';
     if($from_account){
       $from_account_name = $from_account->profile->name;
     }

     $to_account = User::findOrFail($transfer->to_account);
     $to_account_name = '';
     if($to_account){
       $to_account_name = $to_account->profile->name;
     }

    $arrContent = [
      $transfer->user_id,
      $transfer->to_user,
      $transfer->account_id,
      $transfer->to_account,
      $transfer->price,
      Carbon::now(),
      rand(10,100).$transfer->id,
    ];
  }


    $newContent = str_replace($arrCode, $arrContent, $content);
  return $newContent;

}
   public static function printSanad($request, $module, $module_id) {
   $savedContent = $request->input('content');
    $content = self::setSanad($savedContent, $module, $module_id);
   
   if ($request->input('method_type') == 'update') {
     $printTemp = PrintAction::where('module', $module)->where('module_id', $module_id)->first();
     $printTemp->content = $content;
     $printTemp->module = $module;
     $printTemp->module_id = $module_id;
     $printTemp->updated_by = Auth()->id();
     $printTemp->save();
}else{

   $printTemp = New PrintAction;
     $printTemp->content = $content;
     $printTemp->module = $module;
     $printTemp->module_id = $module_id;
     $printTemp->created_by = Auth()->id();
     $printTemp->updated_by = Auth()->id();
     $printTemp->save();
}
    return $printTemp->content;

  }

   public static function getSanad($module, $module_id) {
    $newContent = '';
     $PrintedSanad = PrintAction::where('module', $module)->where('module_id', $module_id)->first();
     if($PrintedSanad){
     $newContent = $PrintedSanad->content;
     }else{
      $tempSanad = PrintTemplate::where('type', $module)->first();
      if($tempSanad){
        $content = $tempSanad->content;
         $newContent = self::setSanad($content, $module, $module_id);
      }
     
     }
     return $newContent;
    }

  
}