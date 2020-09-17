<?php
/**
 * Creates a list of all addresses given in the array/query object specified by 'addresses'.
 * Uses a bullet point <ul> when 'list' ist set to 'true' and simple <br> when it's set to false.
 */

if(!isset($list)){
	$list=false;
}
?>
<?= $list ? '<ul>' : ''?>
	<?php foreach($addresses as $address): ?>
	<?php
		$streetOld = h($address->street->name_old_clean);
		$streetNew = h($address->street->name_new);
		$street;
		if($streetOld === $streetNew){
			$street = $streetOld;
		} else {
			$street = $streetOld.' ('.$streetNew.')';
		}

		$housNo = h($address->houseno);
		if(!empty($address->houseno_specification)){
			$housNo.=' '.h($address->houseno_specification);
		}

		$spec = h($address->address_specification_verbatim);

		$lat = $address->geo_lat;
		$long = $address->geo_long;
	?>
	<?php if($list): ?>
	<li>
		<?php
			echo $this->Html->link($street, ['controller' => 'Streets', 'action' => 'view', $address->street->id]);
			echo ' '.$housNo;

			if(!empty($spec)){
				echo ', '.$spec;
			}

            // UNCOMMENT this Code if the geographical coordinates of an address (if existing) themselves
            // shall be shown at this point
			// if(!empty($long) && !empty($lat )){
			// 	echo '<br>'.__('Geokoordinaten').': '.$lat.', '.$long.' '.__('(lat/long)');
			// }
		?>
	</li>
	<?php else: ?>
		<?php
			echo $this->Html->link($street, ['controller' => 'Streets', 'action' => 'view', $address->street->id]);
			echo ' '.$housNo.'<br>';
		?>
	<?php endif; ?>
	<?php endforeach; ?>
<?= $list ? '</ul>' : ''?>
