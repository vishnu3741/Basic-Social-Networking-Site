<style>
  input[type="text"]{     
	width: 70%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;}
input[type="submit"]{     
	width: 70%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
	cursor: pointer; }
  </style>
<center>
		<form action="./add_to_feed.php" method="post" enctype="multipart/form-data">
            Post:<input type="text" name="message" required><br><br>
            Tags:<input type="text" name="tags"><p>(use comma as seperator)</p>
            Upload Image:<input type="file" name="upload"><br>
            <input type="submit" value="submit"><br>
		</form>
		</center>
