<h1>CJ Ad List</h1>

<table class="table">

<tr>
    <th></th>
	<th>cj_link_id</th>
	<th>name</th>
	
	<th>link_html</th>
	<th>link_javascript</th>
	<th>type</th>
	<th>description</th>
	<th>targeted_sex</th>
	<th>targeted_age_start</th>
	<th>targeted_age_end</th>
	<th>enabled</th>
	<th>ads_start_date</th>
	<th>ads_end_date</th>
	<th>advertiser_id</th>
	<th>advertiser_name</th>
	<th>category</th>
	<th>commission_click</th>
	<th>height</th>
	<th>width</th>
	<th>destination</th>
	<th>promotion_type</th>
</tr>

<?php 
	foreach($ad_list as $ad) {
		if ($ad->language=='en') {
		?>
		
<tr>
    <td><input type="checkbox" /></td>
	<td><?php echo $ad->id; ?></td>
	<td><?php echo $ad->name; ?></td>
	
	<td><?php echo $ad->link_html; ?></td>
	<td><?php echo $ad->link_javascript; ?></td>
	<td><?php echo $ad->link_type; ?></td>
	<td><?php echo $ad->description; ?></td>
	<td>*targeted_sex</td>
	<td>*targeted_age_start</td>
	<td>*targeted_age_end</td>
	<td>*enabled</td>
	<td><?php echo $ad->start_date; ?></td>
	<td><?php echo $ad->end_date; ?></td>
	<td><?php echo $ad->advertiser_id; ?></td>
	<td><?php echo $ad->advertiser_name; ?></td>
	<td><?php echo $ad->category; ?></td>
	<td><?php echo $ad->commission_click; ?></td>
	<td><?php echo $ad->height; ?></td>
	<td><?php echo $ad->width; ?></td>
	<td><?php echo $ad->destination; ?></td>
	<td><?php echo $ad->promotion_type; ?></td>
</tr>
		
		<?php 
		}	
	}
?>
</table>