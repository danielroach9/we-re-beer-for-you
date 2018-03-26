</head>
<body>
  <nav>
  <div class="nav-wrapper brown">
    <a href="#!" class="brand-logo">We're beer for you!</a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">&#9776;</i></a>
    <ul class="right hide-on-med-and-down">
      <li><a href="search.php">Search for beers</a></li>
      <li><a href="breweries.php">Breweries</a></li>
      <li><a href="beer-rating.php">Beer Ratings</a></li>
      <li><a href="beer-rating.php">Submit Beer Review</a></li>
      <li><a href="account.php"><?php echo $_SESSION['accountFirstName']." ".$_SESSION['accountLastName'];?></a></li>
      <li><a id="signOut" href="#">Sign Out</a></li>
    </ul>
    <ul class="side-nav" id="mobile-demo">
      <li><a href="beers.php">Beers</a></li>
      <li><a href="breweries.php">Breweries</a></li>
      <li><a href="beer-rating.php">Beer Ratings</a></li>
      <li><a href="beer-rating.php">Submit Beer Review</a></li>
      <li><a href="account.php"><?php echo $_SESSION['accountFirstName']." ".$_SESSION['accountLastName'];?></a></li>
      <li><a id="signOut" href="#">Sign Out</a></li>
    </ul>
  </div>
</nav>