<!DOCTYPE html>
<html>
<body>

    <br>

    <form action="order_tag_backend.php" method="POST">
    	<label>Customer Name</label>
	    <input type="text" name="cus_name">

	    <br>

	    <label>Contact Number</label>
	    <input type="number" name="cus_number">

	    <br>

	    <label>Chasis</label>
	    <input type="text" name="chasis">

	    <br>

	    <label>Host</label>
	    <input type="text" name="host">

	    <br>

	    <label>PPG</label>
	    <input type="PPG" name="ppg">

	    <br>

	    <label>Host Location</label>
	    <input type="text" name="cus_location">

	    <br>

	    <label>Geotag</label>
	    <select name="geotag">
		  <option value="Yes">Yes</option>
		  <option value="No">No</option>
		</select>

		<br>

		<label>Tag Type & Number</label>
		<input type="text" name="tag">

		<br><br>

		<input type="submit" value="Order Tag" name="submit">
    </form>
    


    <br><br><br>
    <a href="carverr.html">Go back</a>

</body>
</html>