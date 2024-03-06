<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Account;

class AccountTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.account.resource_url');

        parent::__construct();
    }

    /**
     * @param Account $account
     * @return array
     * @throws \Throwable
     */
    public function transform(Account $account)
    {
        $created_user = $account->created_user?$account->created_user->translated_name.'[ <small>'.$account->created_user->user_code.'[ </small>':'---';

        $updated_user = $account->updated_user?$account->updated_user->translated_name.'[ <small>'.$account->updated_user->user_code.'[ </small>':'---';

        $show_url = url($this->resource_url . '/' . $account->hashed_id);

        return [
            'id' => $account->id,
            'name' => $account->name,
            'name_en' => $account->name_en,
            'account_code' => $account->account_code,
            'balance' => $account->balance,
            'opening_balance' => $account->balance,
            'user_id' => $account->owner?$account->owner->translated_name.'[ <small>'.$account->owner->user_code.'</small> ]':'---',
            'category' => $account->category?$account->category->name:'---',
            'notes' => $account->notes,
            'created_user' => $created_user,
            'updated_user' => $updated_user,
            'status'     => formatStatusAsLabels($account->status > 0?'active': 'inactive'),
            'created_at' => format_date($account->created_at),
            'updated_at' => format_date($account->updated_at),
            'action' => $this->actions($account)
        ];
    }
}