<?php

namespace App\Http\Controllers\backend;

use App\Company_account;
use App\Contract;
use App\ContractPremium;
use App\Financial_transaction;
use App\Product;
use App\ProductPayment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{

    public function index()
    {

        $this->data['clients'] = User::where('is_client', 1)->count();
        $this->data['investors'] = User::where('is_investor', 1)->count();
        $this->data['contracts'] = Contract::count();
        $this->data['currently'] = Contract::where('kind', null)->count();
        $this->data['pure'] = Contract::where('kind', 2)->count();
        $this->data['late_payment'] = Contract::where('kind', 4)->count();
        $this->data['products'] = Product::count();
        $this->data['total_products_sold'] = ProductPayment::sum('quantity');
        $this->data['financial_transaction'] = Financial_transaction::count();


        $this->data['all_deposit'] = Financial_transaction::where('type', 'deposit')->sum('price');
        $this->data['all_pull'] = Financial_transaction::where('type', 'pull')->sum('price');
        $this->data['total_payments'] = Financial_transaction::where('type', 'pull_buy')->sum('price');
        $this->data['total_expenses'] = Financial_transaction::where('type', 'pull_expenses')->sum('price');


        $this->data['investors_money'] = Company_account::sum('account_value');
        $this->data['contracts_money'] = Contract::sum('contract_value');
        $this->data['contracts_currently'] = Contract::where('kind', null)->sum('contract_value');
        $this->data['contracts_late_payments'] = Contract::where('kind', 4)->sum('contract_value');
        $this->data['total_profits'] = Contract::sum('total_profit');
        $this->data['contracts_profits'] = Contract::sum('contract_profit');
        $this->data['contracts_fees'] = Contract::sum('fees');
        $this->data['payments'] = ContractPremium::sum('payment');

        return view('vendor.voyager.index', $this->data);
    }
}
