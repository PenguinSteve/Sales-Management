<?php
$this->render("layouts/header")
?>
<h1>Product View</h1>
<?php
print_r($product);
echo "<br>"; 
foreach ($product as $key => $value) {
    echo $key ." ". $value['id'];
}
?>
<?php
$this->render("layouts/footer")
?>