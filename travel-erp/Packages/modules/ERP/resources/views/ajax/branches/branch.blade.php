@if($replacedDiv == 'accounts')
@if(!$accounts==false)
  	 <div class="col-md-4" >
     	{!! PackagesForm::select('type','ERP::attributes.main.type',[
       		'main' =>trans('ERP::attributes.account.main_account'),
        	'sub'    => trans('ERP::attributes.account.sub_account'),
        	],true,null,['id'=>'account_type','onChange'=>'acc_disable()']) !!}
 	</div>
	<div class="col-md-4">
	    {!! PackagesForm::select('parent_id','ERP::attributes.account.parent_id',$accounts,true,null,['id'=>'parent_id', 'disabled']) !!}

	</div>	
@endif
@endif