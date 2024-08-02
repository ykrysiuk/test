<?php

require_once 'PreorderCounter.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $maxN = intval($_POST["maxN"]);
  $counter = new PreorderCounter($maxN);
  $preorderCounts = $counter->countPreorders();

  $result = json_encode($preorderCounts);
  header("Location: index.php?maxN=$maxN&result=" . urlencode($result));
  exit();
}
?>
