<div class="courses-container">
<form action="studentcourses.php" method="post">
	<select multiple="multiple" name="classes[]" id="my-classes">
	<option value="class1" <?php if(in_array("class1", $classes))echo"selected";?> >Class 1</option>
		<option value="class2" <?php if(in_array("class2", $classes))echo"selected";?> >Class 2</option>
		<option value="class3" <?php if(in_array("class3", $classes))echo"selected";?> >Class 3</option>
		<option value="class4" <?php if(in_array("class4", $classes))echo"selected";?> >Class 4</option>
		<option value="class5" <?php if(in_array("class5", $classes))echo"selected";?> >Class 5</option>
		<option value="class6" <?php if(in_array("class6", $classes))echo"selected";?> >Class 6</option>
		
	</select>
	<input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
	</br>
	<input type="submit" class="btn btn-primary" name="submit" id="" value="Save" />
	
</form>
</div>
<script src="../js/jquery.multi-select.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/myscript.js" type="text/javascript" charset="utf-8"></script>

