<div class="container">
	<input type="text" name="hehe" id="hehe">
	<button onclick="hehe()">hehe</button>
</div>
<script src="<?=base_url('node_modules/crypto-js/crypto-js.js')?>"></script>
<script>
	function hehe() {
		var hash = document.getElementById('hehe').value;
		var hash2 = CryptoJS.bcrypt(hash);
		alert(hash2);
	}
</script>
