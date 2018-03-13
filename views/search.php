<?php include ("views/inc/header.php"); ?>
	<title>Search</title>
	<?php include "inc/nav.php"; ?>
</head>
<body>
	<form>
		<input type="text" name="">
		<button id="searchFilters">Search Filters</button>
		<div id="filters">
			<div class="row">
                <div class="input-field col s12">
                  <label for="preferred_abv_range">Preferred ABV</label>
                  <br>
                  <div class="slidecontainer">
                    <input type="range" min="1" max="40" step="0.1" value="5" class="slider" id="abvRange">
                    <p>ABV: <span id="abvPrint"></span></p>
                  </div>
                </div>
                <div class="input-field col s12">
                  <select name="select1" id="selectedCategory">
                  <?php
                    foreach ($categories as $value) {
                      echo '<option value='.$value[id].'>'.$value[cat_name].'</option>';
                    }
                    ?>
                    </select>
                    <label for="preferred_category">Prefered Category</label>
                </div>
                <div class="input-field col s12">
                  <select name="select" id="stylesDropdown">
                  <?php
                    foreach ($styles as $value) {
                      echo '<option value='.$value[id].'>'.$value[style_name].'</option>';
                    }
                    ?>
                    </select>
                    <label for="preferred_style">Prefered Style</label>
                </div>
                <div class="input-field col s12">
                  <select name="select" id="countryDropdown">
                 <?php
                    foreach ($countries as $value) {
                      $count = 1;
                      echo '<option value='.$count.'>'.$value[country].'</option>';
                      $count++;
                    }
                    ?>
                    </select>
                    <label for="preferred_country">Preferred Country</label>
                </div>
              </div>
		</div>
		<button id="searchBtn">Search</button>
	</form>
<?php include ("views/inc/footer.php"); ?>