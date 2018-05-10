 <?php
error_reporting(E_ALL);
echo "<h2>TCP/IP Connection</h2>\n";
$service_port = '5060';
$address = gethostbyname('192.168.254.91');

/* Create a UDP/IP socket. */
$socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
if ($socket < 0) {
    echo "socket_create() failed: reason: " . socket_strerror($socket) . "\n";
} else {
    echo "OK.\n";
}

echo "Attempting to connect to '$address' on port '$service_port'...";
$result = socket_connect($socket, $address, $service_port);
if ($result < 0) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
} else {
    echo "OK.\n";
}

$method  = 'OPTIONS sip:210@192.168.254.7 SIP/2.0';
$via  = 'Via: SIP/2.0/UDP 192.168.254.177:5060;branch=z9hG4bK584583368';
$from  = 'From: "192.168.254.177" <sip:210@192.168.254.7>;tag=847215909';
$in4  = 'To: <sip:210@192.168.254.7>';
$in5  = 'Call-ID: 368681527@192.168.254.177';
$in6  = 'CSeq: 1 OPTIONS';
$in7  = 'Contact: <ssip:210@192.168.254.7:5060>';
$in8  = 'Max-Forwards: 70';
$in9  = 'User-Agent: Yealink SIP-T38G 38.70.14.5';
$in10  = 'Content-Length: 0';

$simv = "\r\n";

$in =  $method.$simv.
$via.$simv.
$from.$simv.
$in4.$simv.
$in5.$simv.
$in6.$simv.
$in7.$simv.
$in8.$simv.
$in9.$simv.
$in10.$simv;

$out = '';

echo "Sending HTTP HEAD request...";
echo("===============================/r/n");
echo($in);
echo("===============================/r/n");
socket_write($socket, $in, strlen($in));
echo "OK.\n";

echo "Reading response:\n\n";
while ($out = socket_read($socket, 2048)) {
//    echo $out;
$outarray = $out;

echo $out;
}

echo "Closing socket...";
socket_close($socket);
echo "OK.\n\n";
?> 
