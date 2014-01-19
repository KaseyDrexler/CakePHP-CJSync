<?php

$this->Html->addCrumb('CJSync', array('plugin'=>'CJSync', 'controller'=>'Ads', 'action'=>'index'));
echo $this->Html->css('CJSync.cjsync');
?>

<table cellpadding="0" cellspacint="0">
<tr>
  <td valign="top">
	<div class="cj_sm_panel">
	<h3>Sync CJ Ads</h3>
	<p><?php echo $this->Html->link('View All Current CJ Ads', array('plugin'=>'CJSync', 'controller'=>'Ads', 'action'=>'ViewCjAds')); ?></p>
	<p><?php echo $this->Html->link('Sync Now', array('plugin'=>'CJSync', 'controller'=>'Ads', 'action'=>'syncCjAds')); ?></p>
	
	</div>
  </td>
  <td style="width:20px;"></td>
  <td valign="top">
  	<div class="cj_sm_panel">
	<h3>Ad Pools</h3>
	<?php
	foreach($ad_pools as $pool) {
		echo $this->Html->link($pool['AdPool']['name'], array('plugin'=>'CJSync', 'controller'=>'Ads', 'action'=>'pool', $pool['AdPool']['id'])).'<br />';
	}
	?>
  	</div>
  </td>
</tr>
</table>

<h1>Ad Pool</h1>

<p><b>Number of Ads:</b> <?php echo sizeof($ads); ?></p>

<?php
if (sizeof($ads)>0) {
?>
	<?php echo $this->Form->create('Ad', array('url'=>array('plugin'=>'CJSync', 'controller'=>'Ads', 'action'=>'index'))); ?>
	<div style="text-align:right;">
		
		<b>With Checked:</b> <?php echo $this->Form->button('Delete'); ?> 
		<div class="cj_panel">
			<?php echo $this->Form->select('pool_to_add_to', $pools_list, array('label'=>false, 'div'=>false)); ?>
			<?php echo $this->Form->button('Add To Pool', array('name'=>'add_to_pool', 'value'=>'add_to_pool')); ?>
		</div>
		<div class="cj_panel">
			<?php echo $this->Form->input('ad_pool_name', array('placeholder'=>'Pool Name', 'label'=>false, 'div'=>false)); ?>
			<?php echo $this->Form->button('Create Ad Pool', array('name'=>'ad_pool', 'value'=>'ad_pool')); ?>
		</div>
		
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
		
		<p align="right"><input type="checkbox" name="data[Ad][ids][]" value="<?php echo $ad['Ad']['id']; ?>" /></p>

		

	</div>
	
	
	
	<?php 
		$count++;
	}

?>
<?php echo $this->Form->end(); ?>

<?php
}
?>