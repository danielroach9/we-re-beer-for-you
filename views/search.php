<?php
if(isset($_SESSION['loggedIn'])){
	if($_SESSION['loggedIn'] == true){
		
	}
}else{
	header("Location: http://serenity.ist.rit.edu/~ajp8707/we-re-beer-for-you/index.php?bad=true");
}

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
<style>

</style>

</head>
<body>
	<section>
		<div class="row">
			<div class="card hoverable col s12">
				<form id="searchForm">
					<div class="card-content">
						<div class="row form-group">
							<span style="font-size: 20pt">Search for a beer </span>
							<input class="validate" type="text" id="searchQuery" name="q" placeholder="Search for a beer" value="<?php if(isset($_GET['q'])){ echo "{$qry}"; } ?>">
						</div>
						<span style="font-size: 16pt; padding-left:1.5em;" id="searchFilters">Apply Filters</span>
						<div class="row card-action" id="filters">
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
							<button style="margin-left:1em;margin-top:1em;"class="btn brown waves-effect waves-light" id="searchBtn">Search</button>

						</div>
				</form>
			</div>
		</div>
				<div id=results>
					<div class="row">
						<?php
						if ((isset($_GET['q']) || isset($_GET['cat']) || isset($_GET['stl']))) {
							if(!empty($searchResults)){
								$size = count($searchResults);
								echo "<span style='text-align:center;font-size:22pt;color:white; margin:0 auto;'>Found $size search results.</span>
								</div>
								<div class='row'>
								";

								foreach ($searchResults as $result) {
									echo "
									<div class='col s3'>
									<div class='card hoverable small beer-card'>
									<div class='card-content center-align'>
									<a href='beer.php?id=$result[id]'><span class='card-title'>$result[name]</span></a>
									<p>Category: $result[cat_name]</p>
									<p>Style:  $result[style_name]</p>
									</div>
									</div>
									</div>";
								}
							}else{
								echo "<span style='text-align:center;font-size:22pt;color:white; margin:0 auto;'>No results found</span>";
							}
						}
						?>
					</div>
				</div>
			</div>
		</section>
		<?php include ("inc/footer.php"); ?>
