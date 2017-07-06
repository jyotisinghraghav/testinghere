<link href='https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css' type='text/css' rel='stylesheet'> 
<link href='Files/form.css' type='text/css' rel='stylesheet'> 
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' type='text/css' rel='stylesheet'> 
<link href='https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css' type='text/css' rel='stylesheet'> 
<script type='text/javascript' src='http://code.jquery.com/jquery-1.12.4.js'></script>
<script type='text/javascript' src='https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js'></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<?php
require_once('header_include.php');
$data = array();
$cnt =0;
$get_entry_list_parameters = array(
				 'session' => $session_id,
				 'module_name' => 'Accounts',
				 'query' => " accounts.deleted='0'",
				 'order_by' => "",
				 'offset' => '0',
				 'select_fields' => array(
					  'id',
					  'name',
					  'billing_address_city',
					  'phone_office',
					  'email1',
				 ),
				 'link_name_to_fields_array' => array(
				 ),
				 'deleted' => '0',
				 'Favorites' => false,
			);
$get_entry_list_result = doRESTCALL('get_entry_list', $crm_config,$get_entry_list_parameters);
if(!empty($get_entry_list_result->entry_list)){
	foreach($get_entry_list_result->entry_list as $key=>$get_list_arr){
		  foreach($get_entry_list_parameters['select_fields'] as $key1=>$value1 ){
					if($get_list_arr->name_value_list->$value1->value == ''){
							$get_list_arr->name_value_list->$value1->value = ' - ';
					 }
				  }
				  $data[$cnt]['name'] = $get_list_arr->name_value_list->name->value;
				  $data[$cnt]['billing_address_city'] = $get_list_arr->name_value_list->billing_address_city->value;
				  $data[$cnt]['phone_office'] = $get_list_arr->name_value_list->phone_office->value;
				  $data[$cnt]['email1'] = $get_list_arr->name_value_list->email1->value;
				 // $data[$cnt]['assigned_user_name'] = $get_list_arr->name_value_list->assigned_user_name->value;
				  $cnt++;
		  }
	}
?>
<div id="companyLogo_search" align="center">
    <img src="custom/themes/default/images/company_logo.png?v=IFZ53K96s7cOLJw-3yxK6g&logo_md5=64ab9932a065569e30e8067070ffd224" width="483" height="109"
        alt="Company logo" border="0"/>
</div> 
<h1 align='center'>Search for account....</h1>
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
		<?php
		 foreach($data as $key=>$value){
			 echo '<tr>';
			 echo '<td>'.$data[$key]['name'].'</td>';
			 echo '<td>'.$data[$key]['billing_address_city'].'</td>';
			 echo '<td>'.$data[$key]['phone_office'].'</td>';
			 echo '<td>'.$data[$key]['email1'].'</td>';
			  echo '</tr>';
		 }
		 ?>
         </tbody>
    </table>
