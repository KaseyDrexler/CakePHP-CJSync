<?php
$this->Html->addCrumb('CJSync', array('plugin'=>'CJSync', 'controller'=>'Ads', 'action'=>'index'));
$this->Html->addCrumb($pool['AdPool']['name'], array('plugin'=>'CJSync', 'controller'=>'Ads', 'action'=>'index'));
echo $this->Html->css('CJSync.cjsync');
echo $this->Html->script('CJSync.cjsync');
?>

<h1><?php echo $pool['AdPool']['name']; ?></h1>

<table cellpadding="0" cellspacing="0">
<tr>
  <td valign="top">
	
	<textarea cols="40" rows="10">
	
	<div id="random_layer_name">
	<!-- if you need multiple ad pool layers change the div id. Change random_layer_name in the id and in the updateAdPanel javascript code //-->
	
	<script language="javascript">
	updateAdPanel('random_layer_name', <?php echo $pool['AdPool']['id']; ?>);
	setInterval(function () {
		updateAdPanel('random_layer_name', <?php echo $pool['AdPool']['id']; ?>);
		},
		10000); 
	
			
		
	
	</script>
	
	</div>
	
	
	</textarea>
	
	<p><b>Example:</b></p>
	<div id="random_layer_name" style="border:1px solid red;padding:10px;">
	
	<script language="javascript">
	updateAdPanel('random_layer_name', <?php echo $pool['AdPool']['id']; ?>);
	setInterval(function () {
		updateAdPanel('random_layer_name', <?php echo $pool['AdPool']['id']; ?>);
		},
		10000); 
	
			
		
	
	</script>
	
	</div>
  </td>
  
  <td style="width:20px;"></td>
  
  <td valign="top">
  
  	<?php echo $this->Form->create('Ad', array('url'=>array('plugin'=>'CJSync', 'controller'=>'Ads', 'action'=>'pool', $pool['AdPool']['id']))); ?>
  	<?php echo $this->Form->button('Delete Pool', array('value'=>'delete', 'name'=>'delete_pool')); ?>
	<?php echo $this->Form->end(); ?>
  </td>
</tr>
</table>


<p><b>Number of Ads:</b> <?php echo sizeof($ads); ?></p>

<?php
if (sizeof($ads)>0) {
?>
	<?php echo $this->Form->create('Ad', array('url'=>array('plugin'=>'CJSync', 'controller'=>'Ads', 'action'=>'pool', $pool['AdPool']['id']))); ?>
	<div style="text-align:right;">
		
		<b>With Checked:</b> <?php echo $this->Form->button('Remove From Pool'); ?> 
		
		
	</div>
	<?php 
	$count = 0;
	foreach($ads as $ad) {
	//echo $count;
	?>
	
	<div class="cj_ad_panel">
	
		<iframe src="/Ads/viewAd/<?php echo $ad['Ad']['id']; ?>" width="200" height="200" style="zoom:0.25;"></iframe>
		<p><b>Type:</b> <?php echo $ad['Ad']['type']; ?><br />
		<?php echo ($ad['Ad']['enabled']==1) ? '<font color="#009900">Enabled</font><br />' : '<font color="#990000">Disabled</font><br />'; ?>
		<?php echo ($ad['Ad']['ads_start_date']) ? $ad['Ad']['ads_start_date'].' - '.$ad['Ad']['ads_end_date'].'<br />' : ''; ?>
		<b>Advertiser:<b> <?php echo $ad['Ad']['advertiser_name']; ?><br />
		<b>Category:</b> <?php echo $ad['Ad']['category']; ?><br />
		<b>Link ID:</b> <?php echo $ad['Ad']['cj_link_id']; ?><br />
		<?php echo ($ad['Ad']['commission_click']) ? '<b>Commission Click:</b> '.$ad['Ad']['commission_click'].'<br />' : ''; ?>
		<?php echo ($ad['Ad']['promotion_type']) ? '<b>Promotion Type:</b> '.$ad['Ad']['promotion_type'].'<br />' : ''; ?>
		<b>Dimensions:</b> <?php echo $ad['Ad']['width'] . ' x ' . $ad['Ad']['height']; ?></p>
		
		<p align="right"><input type="checkbox" name="data[Ad][ids][]" value="<?php echo $ad['AdsToPool']['id']; ?>" /></p>

		

	</div>
	
	
	
	<?php 
		$count++;
	}

?>
<?php echo $this->Form->end(); ?>

<?php
}
?>