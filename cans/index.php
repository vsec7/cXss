<?php
session_start();
error_reporting(0);
include("../inc/conf.php");

if(!empty($pass)) {
    if(isset($_POST['pass']) && (md5($_POST['pass']) == $pass))
        $_SESSION['auth'] = md5($_POST['pass']);
    if (!isset($_SESSION['auth']) || ($_SESSION['auth'] != $pass))
        login();
}
if(isset($_GET['logout'])){
	session_destroy();
	header("location: ?");
}

if(isset($_GET['del'])){
	delete($db, $_GET['del']);
	header('location: ?');
}

if (isset($_GET['p'])) {
   	$p = $_GET['p']; }else $p = 1;
  	$f = json_decode(getAll($db))->result;
	$pg = getPage($f, 4, $p);
	$t = count(array_filter($f));
	$totalPages = ceil($t / 4);
	$showPage = $p;
	include("header.php");
?>

    <!-- Page Content -->
    <div class="container">
    	<div class="jumbotron">
    		<div class="row">

    		<?php
    		foreach ($pg as $d) {
    		?>
        		<div class="col-md-3"> 
					<div class="card">
						<div class="card-header">
							<a href="<?=$d->origin;?>" class="text-mono text-<?=$warna;?>">
					  			<span class="fa fa-globe"></span> <?=htmlentities($d->origin);?>
					  		</a>
						</div>
						<div class="card-body">
						  	<img class="card-img-top" src="<?=$d->screenshot;?>" width="200" height="200" style="background-color:white;">
						  	<div class="card-body">
						  		<center>
						    		<a href="view.php?v=<?=$d->id;?>" class="btn btn-shadow btn-sm btn-outline-<?=$warna;?>">
									  	<span class="fa fa-eye"></span>
									  	view
									</a>
									<a href="?del=<?=$d->id;?>" class="btn btn-shadow btn-sm btn-outline-danger">
									  	<span class="fa fa-trash"></span>
									  	delete
									</a>
						    	</center>
						  </div>
						</div>
						<div class="card-footer text-muted">
						    <div class="text-mono text-<?=$warna;?>">
					  			<span class="fa fa-clock-o"></span> <?=$d->datetime;?>
					  		</div>
						</div>
					</div>
					<hr>
				</div>

			<?php } ?>
				
			</div>

			<center>
           <!-- Pagination -->
			    <div class="pagination">			    	
			    	<div class="text-mono text-<?=$warna;?>">
					  	<span class="fa fa-book"></span> <?=$p;?>/<?=$totalPages;?>
					</div>
				<?php
				    if ($p > 1)
				      	echo "<a class='btn btn-shadow btn-sm btn-outline-".$warna."' href='" . $_SERVER['PHP_SELF'] . "?p=" . ($p - 1) . "'><span class='fa fa-arrow-left'></span> Prev</a>";
				    if ($p < $totalPages)
				        echo "<a class='btn btn-shadow btn-sm btn-outline-".$warna."' href='" . $_SERVER['PHP_SELF'] . "?p=" . ($p + 1) . "'>Next <span class='fa fa-arrow-right'></span></a>";
				    ?>
			    </div>
		    </center>


        </div>
    </div>

<?php
include("footer.php");