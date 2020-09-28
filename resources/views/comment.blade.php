<!DOCTYPE html>
<html>
<body>

<h1>Show File-select Fields</h1>

<h3>Show a file-select field which allows only one file to be chosen:</h3>
<form action="/action_page.php">
  <label for="myfile">Select a file:</label>
  <input type="file" id="myfile" name="myfile"><br><br>
  <input type="submit">
</form>

<h3>Show a file-select field which allows multiple files:</h3>
<form action="/action_page.php">
  <label for="myfile">Select files:</label>
  <input type="file" id="myfile" name="myfile" multiple><br><br>
  <input type="submit">
</form>

</body>
</html>
