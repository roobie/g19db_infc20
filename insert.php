
<script type="text/javascript">
$(function() {
	$( "input:submit, a, button", ".demo" ).button();
	$( "a", ".demo" ).click(function() { return false; });
});
</script>

<button>A button element</button>

<input type="submit" value=""/>
