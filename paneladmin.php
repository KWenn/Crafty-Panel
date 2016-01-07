<?php
	
	
	echo ' <h1>Panel Administration</h1>
<div style="margin:30px 10px 10px 0px;">
<table class="wp-list-table widefat fixed striped posts">
<thead>
<tr>
<th id="Radio" class="manage-column column-author" scope="col">Select</th>
<th id="ID" class="manage-column column-author" scope="col">ID</th>
<th id="Name" class="manage-column column-categories" scope="col">Name</th>
<th id="Publisher" class="manage-column column-tags" scope="col">Publisher</th>
<th id="Role" class="manage-column column-comments num sortable desc" scope="col">Role</th>
<th id="Priority" class="manage-column column-date sortable asc" scope="col">Priority</th>
<th id="Content Summary" class="manage-column column-date sortable asc" scope="col">Content Summary</th>
</tr>
</thead>
';	
	
	
	function populate(){
		global $wpdb;
		$items = $wpdb->get_results("SELECT * FROM wp_pro_CraftyPanel");
		foreach($items as $item){
			item($item->id, $item->name, $item->publisher, $item->permission, $item->content);
	}}
	
	function item($id, $name, $publisher, $role, $content){
		echo '
<tbody id="the-list">
<tr>
<td><input type="radio" name="radio"/></td>
<td>' . $id . '</td>
<td>' . $name . '</td>
<td>' . $publisher . '</td>
<td>' . $role . '</td>
<td>' . 'add later' . '</td>
<td>' . $content . '</td>
</tr>
</tbody>
';
	}	 
populate();
echo '<div id="buttons" style="float:left;">';
echo '<input id="submit" class="button button-primary" type="submit" value="New" name="submit" />';
echo '<input id="submit" class="button button-primary" type="submit" value="Edit" name="submit" />';
echo '<input id="submit" class="button button-primary" type="submit" value="Delete" name="submit" />';
echo '</div>';


//Edit add Form



?>

