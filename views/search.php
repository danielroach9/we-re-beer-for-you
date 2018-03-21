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
<style>

</style>

</head>
<body>
	<section>
		<div class="container" style="width:100%; margin:2em;">
			<div class="card hoverable col s12">
				<form id="searchForm">
					<div class="card-content">
						<div class="input-field col s12">
							<input class="validate" type="text" id="searchQuery" name="q" placeholder="Search for a Beer" value="<?php if(isset($_GET['q'])){ echo "{$qry}"; } ?>">
							<a onclick="showFilter();" id="searchFilters">Apply Filters</a>
						</div>
						<div class="row card-action hide" id="filters">
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
						<br />
					<button class="btn brown waves-effect waves-light" id="searchBtn">Search</button>
				</form>

				<div id=results>
					<div class="row">
						<?php
						if ((isset($_GET['q']) || isset($_GET['cat']) || isset($_GET['stl']))) {
							if(!empty($searchResults)){
								$size = count($searchResults);
								echo "<div class='col s12'>
								<div class='card small beer-card'>
								<div class='card-content center-align'>
								<p>Found $size Search Results.</p>
								</div>
								</div>
								</div>";
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
								<div class='card small beer-card'>
								<div class='card-content center-align'>
								<p>No search results found.</p>
								</div>
								</div>
								</div>";
							}
						}
						?>
					</div>
				</div>
			</div>
		</section>
		<script>
			function showFilter(){
				document.getElementById("filters").className = "row card-action";
			}
		</script>
		<?php include ("inc/footer.php"); ?>
