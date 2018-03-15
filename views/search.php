<?php
require_once("../model/DB.class.php");
$db = new DB();

$qry;
$cat;
$stl;
$searchResults;
if(isset($_GET['q'])){
	if(isset($_GET['cat']) && isset($_GET['stl'])){
		$qry = $_GET['q'];
		$cat = $_GET['cat'];
		$stl = $_GET['stl'];
		$searchResults = $db->getBeerInfoByFullSearch($qry,$cat,$stl);
	}
	else{
		$qry = $_GET['q'];
		$searchResults = $db->getBeerInfoByName($qry);
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
	<form id="searchForm">
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
		<div class="row">
		<?php
			if(!empty($searchResults)){
		      foreach ($searchResults as $result) {
		        echo "
		          <div class='col s3'>
		          <div class='card small beer-card'>
		          <div class='card-content center-align'>
		          <a href='beer.php?id=$result[id]'><span class='card-title'>$result[name]</span></a>
		          <p>Category: $result[cat_name]</p>
		          <p>Style:  $result[style_name]</p>
		          </div>
		        </div>
		        </div>";
		      }
		    }else{
		    	echo "<div class='col s12'>
		    		  	<p>No search results found.</p>
		    		  </div>";
		    }
      	?>
      	</div>
	</div>
<?php include ("inc/footer.php"); ?>