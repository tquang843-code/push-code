<footer style="background-color: #fac3f6 !important;">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h4>GIỚI THIỆU</h4>
				<ul>
					<li>LIÊN HỆ CTCP QUANGTHIEN GROUP</li>
					<li><i class="bi bi-mailbox2"></i> doquangthien5.com@gmail.com</li>
					<li><i class="bi bi-telephone-fill"></i> 0394988852</li>
					<li><i class="bi bi-map-fill"></i> 218 Đ. Lĩnh Nam, Vĩnh Hưng, Hoàng Mai, Hà Nội</li>
					<li>Chúng tôi luôn cung cấp những mẫu giày thể thao uy tín chất lượng nhất đến cho khách hàng.</li>
				</ul>
			</div>
			<div class="col-md-4">
				<h4>SẢN PHẨM MỚI NHẤT</h4>
				<ul>
					<li>LIÊN HỆ CTCP QUANGTHIEN GROUP</li>
					<li>Email: doquangthien5.com@gmail.com</li>
					<li>Phone: 0304988852</li>
					<li>Chúng tôi luôn cung cấp những mẫu giày thể thao uy tín chất lượng nhất đến cho khách hàng.</li>
				</ul>
			</div>
			<div class="col-md-4">
				<h4>TIN TỨC MỚI NHẤT</h4>
				<ul>
					<li>LIÊN HỆ CTCP QUANGTHIEN GROUP</li>
					<li>Email: doquangthien5.com@gmail.com</li>
					<li>Phone: 0304988852</li>
					<li>Chúng tôi luôn cung cấp những mẫu giày thể thao uy tín chất lượng nhất đến cho khách hàng.</li>
				</ul>
			</div>
		</div>
	</div>
	<div style="background-color: #e6b5e2; width: 100%; text-align: center; padding: 15px;">
		© 2024 QUANGTHIEN Group . Được thiết kế bời QUANGTHIEN. All rights reserved.
	</div>
</footer>

<?php
if(!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = [];
}
$count = 0;
// var_dump($_SESSION['cart']);
foreach($_SESSION['cart'] as $item) {
	$count += $item['num'];
}
?>
<script type="text/javascript">
	function addCart(productId, num) {
		$.post('api/ajax_request.php', {
			'action': 'cart',
			'id': productId,
			'num': num
		}, function(data) {
			location.reload()
		})
	}
</script>
<!-- Cart start -->
<span class="cart_icon">
	<span class="cart_count"><?=$count?></span>
	<a href="cart.php"><img src="https://gokisoft.com/img/cart.png"></a>
</span>
<!-- Cart stop -->
</body>
</html>