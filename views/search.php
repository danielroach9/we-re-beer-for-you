<?php
require_once("../model/DB.class.php");
$db = new DB();

$qry;
$cat;
$stl;
if(isset($_GET['q'])){
	if(isset($_GET['cat']) && isset($_GET['stl'])){
		$qry = $_GET['q'];
		$cat = $_GET['cat'];
		$stl = $_GET['stl'];
	}
	else{
		$qry = $_GET['q'];
	}
}
$categories = $db->getCategories();
$styles = $db->getStylesByCategory(0); //hardcoded parameter to start
?>

<?php include ("inc/header.php"); ?>
	<title>Search</title>
	<?php include "inc/nav.php"; ?>
</head>
<body>
	<form>
		<input type="text" id="searchQuery" name="q" placeholder="Search for a Beer" value="<?php if(isset($_GET['q'])){ echo "{$qry}"; } ?>">
		<a href="#" id="searchFilters">Apply Filters</a>
		<div id="filters">
			<div class="row">
                <div class="input-field col s6">
                  <select name="cat" id="selectedCategory">
                  	<option value="" disabled selected>Choose a Beer Category!</option>
                  <?php
                    foreach ($categories as $value) {
                      echo '<option value='.$value[id].'>'.$value[cat_name].'</option>';
                    }
                    ?>
                    </select>
                    <label for="preferred_category">Prefered Category</label>
                </div>
                <div class="input-field col s6">
                  <select name="stl" id="stylesDropdown">
                  	<option value="" disabled selected>Choose a Beer Style!</option>
                  <?php
                    foreach ($styles as $value) {
                      echo '<option value='.$value[id].'>'.$value[style_name].'</option>';
                    }
                    ?>
                    </select>
                    <label for="preferred_style">Prefered Style</label>
                </div>
            </div>
		</div>
		<button id="searchBtn">Search</button>
	</form>

	<div id=results>
		<?php

      //foreach ($brewery_beers as $value) {
      //   echo "
      //     <div class='col s4'>
      //     <div class='card small beer-card'>
      //     <div class='card-content center-align'>
      //     <a href='beer.php?id=$value[id]'><span class='card-title'>$value[name]</span></a>
      //     <p>Category: $value[cat_name]</p>
      //     <p>Style:  $value[style_name]</p>
      //     </div>
      //   </div>
      //   </div>";
      // }
      ?>
	</div>
<?php include ("inc/footer.php"); ?>