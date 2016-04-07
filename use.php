<?php
/**
 * @uses
 * A simple example for the major scale
 */
include 'ScaleCalculator.php';
// Default to C Major
$keynote = 0;
if (isset($_POST['keynote']) && ! empty($_POST['keynote'])) {
    $keynote = (int) $_POST['keynote'];
}

$scale  = new ScaleCalculator();
$result = $scale->transpose($keynote);

// The html form
?>
<form method="post" action="">
	<label>Tonality</label>
	<select id="keynote" name="keynote">
	<?php for($i = 0; $i < $scale->max(); $i++):?>
	<option value="<?php echo $i;?>"<?php if ($i == $keynote):?> selected<?php endif;?>>
		<?php echo $scale->getFlat($i);?>
	</option>
	<?php endfor;?>
	</select>
	<input type="submit" name="submit" value="Go"/>
</form>
The Major Scale
<pre>
<?php echo $result;?>
</pre>