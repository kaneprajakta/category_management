
<h2><?php echo $title; ?></h2>


<?php echo form_open('Category/create'); ?>
<?php //print_r($p_cat);?>	
	<table>
		<tr>
			<td><label for="cat_name">Enter Category Name</label></td>
			<td><input type="text" name="cat_name" id="cat_name" size="50" /></td>
		</tr>
		<tr>
			<td><label for="cat_name">Parent</label></td>
			<td><select id="sel_p_id" name="sel_p_id">
                <option value="">--Select Parent Category--</option>
                <?php 

                 foreach($p_cat as $key=>$cat){ ?>
                   <option value="<?php echo $key; ?>"><?php echo $cat; ?></option>  
                <?php } ?>
                </select></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="Create new category" /></td>
		</tr>
	</table>	
</form>