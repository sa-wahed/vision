<?php echo validation_errors('<p class="form_error">','</p>'); ?>
<?php echo form_open_multipart('welcome/register/'); ?>
<input type="text" name="firstname" placeholder="Enter your Firstname"/>
<input type="text" name="city" placeholder="Enter your City"/>
<input type="file" name="userimage">
<button type="submit">Create Account</button>
</form>