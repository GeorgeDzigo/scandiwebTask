<!doctype html>
<html lang="en">

<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Junior PHP Test Task</title>
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
      <link rel="stylesheet" href="css/style.css">

</head>

<body>

      <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once '../classes/ProductBase.class.php';
            $type = ucfirst($_POST["type"]);
            if($type != "Hwl" && $type != "Weight" && $type != "Size") header('Location: ./add-product.php');
            $product = new $type();
            $product->setProp($_POST[strtolower($type)]);
            $product->__set("sku", $_POST["sku"]);
            $product->__set("name", $_POST["name"]);
            $product->__set("price", $_POST["price"]);
            $product->__set("type", $_POST["type"]);
            $product->create();
            }
      ?>
      <header>
            <h3 style="display: inline;">Product Add</h3>
            <div class="funcs">
                  <a class="a" onclick="submitData()">Save</a>
                  <a class="a" href="./index.php">Cancel</a>
            </div>
      </header>

      <center>
            <hr style="width: 87%;" class="hr">
      </center>

      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="product_form">
            <div class="inputs">
                  <div class="form-group row stable-inputs">
                        <label for="sku" class="col-sm-2 col-form-label">SKU</label>
                        <div class="col-sm-10">
                              <input type="text" class="form-control default-input" id="sku" placeholder="SKU" name="sku" value="<?= isset($_POST['sku']) ? $_POST['sku'] : '' ?>">
                        </div>
                  </div>

                  <div class="form-group row stable-inputs">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                              <input type="text" class="form-control default-input" id="name" placeholder="Name" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>">
                        </div>
                  </div>

                  <div class="form-group row stable-inputs">
                        <label for="price" class="col-sm-2 col-form-label">Price ($)</label>
                        <div class="col-sm-10">
                              <input type="decimal" min="0.00" class="form-control default-input" id="price" placeholder="Price" name="price" value="<?= isset($_POST['price']) ? $_POST['price'] : '' ?>">
                        </div>
                  </div>


                  <div class="input-group mb-3" style="top: 20px;">
                        <label class="col-sm-2 col-form-label">Type Switcher</label>

                        <select class="sizes-option" id="productType" onchange="show()" name="type">
                              <option value="Type_Switcher">Type Switcher</option>
                              <option value="size" 
                              <?= isset($_POST['type']) && $_POST['type'] == "size" ? "SELECTED" : '' ?>
                              >DVD</option>
                              <option value="weight"
                              <?= isset($_POST['type']) && $_POST['type'] == "weight" ? "SELECTED" : '' ?>
                              >Book</option>
                              <option value="hwl"
                              <?= isset($_POST['type']) && $_POST['type'] == "hwl" ? "SELECTED" : ''?>
                              >Furniture</option>
                        </select>
                  </div>
                  <!-- MB -->
                  <div class="form-group row size-type size">
                        <label for="size-mb" class="col-sm-2 col-form-label">Size (MB)</label>
                        <div class="col-sm-10">
                              <input type="decimal" class="form-control int" id="size" placeholder="Size" name="size" value="<?= isset($_POST['size']) ? $_POST['size'] : '' ?>" >
                        </div>
                  </div>

                  <!-- KG -->
                  <div class="form-group row size-type weight">
                        <label for="weight-kg" class="col-sm-2 col-form-label">Weight (KG)</label>
                        <div class="col-sm-10">
                              <input type="decimal" class="form-control int" id="weight" placeholder="Weight" name="weight" value="<?= isset($_POST['weight']) ? $_POST['weight'] : '' ?>">
                        </div>
                  </div>
                  <!-- CM -->
                  <div class="size-type hwl">
                        <div class="form-group row">
                              <label for="height-cm" class="col-sm-2 col-form-label">Height (CM)</label>
                              <div class="col-sm-10">
                                    <input type="decimal" class="form-control int" id="height" placeholder="Height" name="hwl[height]" value="<?= isset($_POST['hwl']) ? $_POST['hwl']['height'] : '' ?>">
                              </div>
                        </div>
                        <div class="form-group row">
                              <label for="width-cm" class="col-sm-2 col-form-label">Width (CM)</label>
                              <div class="col-sm-10">
                                    <input type="decimal" class="form-control int" id="width" placeholder="Width" name="hwl[width]" value="<?= isset($_POST['hwl']) ? $_POST['hwl']['width'] : '' ?>">
                              </div>
                        </div>
                        <div class="form-group row">
                              <label for="length-cm" class="col-sm-2 col-form-label">Length (CM)</label>
                              <div class="col-sm-10">
                                    <input type="decimal" class="form-control int" id="length" placeholder="Length" name="hwl[length]" value="<?= isset($_POST['hwl']) ? $_POST['hwl']['length'] : '' ?>">
                              </div>
                        </div>
                  </div>

                  <p id="errors">
                        <?php
                              if(isset($errors))
                                    foreach($errors as $error) 
                                          echo "<li>" . $error . "</li>";

                        ?>
                  </p>
                  <p id="size-type-errors"></p>

            </div>
      </form>

      <!-- Scripts -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
      <!-- My Scripts -->
      <script src="./js/index.js"></script>
</body>

</html>