<?php

class PreorderCounter {
  private $n;
  private $memo = [];

  public function __construct($n) {
    $this->n = $n;
  }

  // Check if a given permutation is a valid preorder
  private function isValidPreorder($perm) {
    $relation = array_fill(0, $this->n, array_fill(0, $this->n, false));

    // Create the relation matrix from the permutation
    foreach ($perm as $i => $element) {
      for ($j = $i + 1; $j < count($perm); $j++) {
        $relation[$perm[$i]][$perm[$j]] = true;
      }
    }

    // Check for transitivity
    for ($i = 0; $i < $this->n; $i++) {
      for ($j = 0; $j < $this->n; $j++) {
        for ($k = 0; $k < $this->n; $k++) {
          if ($relation[$i][$j] && $relation[$j][$k] && !$relation[$i][$k]) {
            return false;
          }
        }
      }
    }
    return true;
  }

  // Generate all permutations of the elements and count valid preorders
  private function generatePreorders() {
    if (isset($this->memo[$this->n])) {
      return $this->memo[$this->n];
    }

    $elements = range(0, $this->n - 1);
    $count = 0;

    $this->generatePermutations($elements, function($perm) use (&$count) {
      if ($this->isValidPreorder($perm)) {
        $count++;
      }
    });

    $this->memo[$this->n] = $count;
    return $count;
  }

  // Generate all permutations of a given array
  private function generatePermutations($elements, $callback, $perm = [], $used = []) {
    if (count($perm) == count($elements)) {
      $callback($perm);
      return;
    }
    for ($i = 0; $i < count($elements); $i++) {
      if (isset($used[$i]) && $used[$i]) continue;
      $used[$i] = true;
      $this->generatePermutations($elements, $callback, array_merge($perm, [$elements[$i]]), $used);
      $used[$i] = false;
    }
  }

  // Count preorders for sets from 0 to n elements
  public function countPreorders() {
    $preorderCounts = [];
    for ($i = 0; $i <= $this->n; $i++) {
      $counter = new PreorderCounter($i);
      $preorderCounts[] = $counter->generatePreorders();
    }
    return $preorderCounts;
  }
}

// Example usage:
$N = 3; // Change this value as needed
$counter = new PreorderCounter($N);
$result = $counter->countPreorders();
print_r($result);

?>
