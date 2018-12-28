<?php
session_start();

// $product_id = ;
// $product_quantity = ;
$action = 'add';

$product_id = 12;
$product_quantity = 12;
$product_name = 'invitation shop';
$product_price = 123;

// $product_id = '';
// $product_name = '';
// $product_price = '';
// $product_quantity = '';

// $_SESSION['shoping_cart']
if (1)
{
	$order_table = '';
	$message = '';
	if (isset($_SESSION['shoping_cart']))
	{
		$is_available = 0;
		foreach ($_SESSION['shoping_cart'] as $keys => $values)
		{
			if ($_SESSION['shoping_cart'][$keys]['product_id'] == $product_id)
			{
				$is_available++;
				$_SESSION['shoping_cart'][$keys]['product_quantity'] = $_SESSION['shoping_cart'][$keys]['product_quantity'] + $product_quantity;
			}
		}
		if ($is_available < 1)
		{
			$item_array = array(
				'product_id'		 => $product_id,
				'product_name'		 => $product_name,
				'product_price'		 => $product_price,
				'product_quantity'   => $product_quantity
			);
			$_SESSION['shoping_cart'][] = $item_array;
		}
	}
	else
	{
		$item_array = array(
			'product_id'		 => $product_id,
			'product_name'		 => $product_name,
			'product_price'		 => $product_price,
			'product_quantity'   => $product_quantity
		);
		$_SESSION['shoping_cart'][] = $item_array;
	}
	$order_table .= '
		<table border="1" style="width:100%;">
			<tr>
				<th>Product Name</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Total</th>
				<th>Action</th>
			</tr>';
			if (!empty($_SESSION["shoping_cart"]))
			{
				$total = 0;
				foreach ($_SESSION["shoping_cart"] as $keys => $values) {
					$order_table .= '
							<tr>
								<td>'.$values["product_name"].'</td>
								<td>'.$values["product_quantity"].'</td>
								<td>'.$values["product_price"].'</td>
								<td>'.number_format($values["product_quantity"] * $values["product_price"], 2).'</td>
								<td><button class="button" name="delete" id="'.$values["product_id"].'"> Delete </button></td>
							</tr>
						';
						$total = $total + ($values["product_quantity"] * $values["product_price"]);
				}
				$order_table .= '
					<tr>
						<td colspan="3"> Total</td>
						<td>$ '.number_format($total, 2).'</td>
						<td></td>
					</tr>
				';
			}

			$order_table .='</table>';
			$output = array(
				'order_table' => $order_table,
				'cart_item'	  => count($_SESSION["shoping_cart"])		
			);
			echo $output;;
}



?>


