<!DOCTYPE html>
<html>
<head>
  <title>Preorder Counter</title>
  <script src="js/script.js" type="application/javascript"></script>
</head>
<body>
<h1>Preorder Counter</h1>
<form method="post" action="calculate.php">
  <label for="maxN">Enter maxN:</label>
  <input type="number" id="maxN" name="maxN" min="1" required>
  <input type="submit" value="Calculate">
  <input type="button" value="Reset" onclick="resetForm()">
</form>

<?php
    if (isset($_GET['result'])) {
      echo "<h2>Preorder Counts for maxN = " . $_GET['maxN'] . "</h2>";
      echo "<pre>" . json_encode(json_decode($_GET['result']), JSON_PRETTY_PRINT) . "</pre>";
    }
?>
</body>
</html>
