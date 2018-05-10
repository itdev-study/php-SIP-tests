 <?php
error_reporting(E_ALL);

echo "<h2>TCP/IP Connection</h2>\n";

/* Get the port for the WWW service. */
//$service_port = getservbyname('www', 'tcp');

$service_port = '5060';

/* Get the IP address for the target host. */
//$address = gethostbyname('www.example.com');
$address = gethostbyname('192.168.254.166');


/* Create a TCP/IP socket. */
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

//$in = "HEAD / HTTP/1.1\r\n";
//$in .= "Host: www.example.com\r\n";
//$in .= "Connection: Close\r\n\r\n";

$invite  = 'INVITE sip:192.168.254.166 SIP/2.0';
$via  = 'Via: SIP/2.0/UDP 192.168.254.101:5060;branch=z9hG4bK584583368';
$from  = 'From: "192.168.254.101" <sip:192.168.254.101@192.168.254.101>;tag=847215909';
$in4  = 'To: <sip:192.168.254.166@192.168.254.166:5060>';
$in5  = 'Call-ID: 368681527@192.168.254.101';
$in6  = 'CSeq: 1 INVITE';
$in7  = 'Contact: <sip:192.168.254.101@192.168.254.101:5060>';
$in8  = 'Content-Type: application/sdp';
$in9  = 'Allow: INVITE, INFO, PRACK, ACK, BYE, CANCEL, OPTIONS, NOTIFY, REGISTER, SUBSCRIBE, REFER, PUBLISH, UPDATE, MESSAGE';
$in10  = 'Max-Forwards: 70';
$in11  = 'User-Agent: Yealink SIP-T38G 38.70.14.5';
$in12  = 'Supported: replaces';
$in13  = 'Allow-Events: talk,hold,conference,refer,check-sync';
$in14  = 'Content-Length: 300';

$in15  = 'v=0';
$in16  = 'o=- 20022 20022 IN IP4 192.168.254.101';
$in17  = 's=SDP data';
$in18  = 'c=IN IP4 192.168.254.101';
$in19  = 't=0 0';
$in20  = 'm=audio 11782 RTP/AVP 0 8 18 9 101';
$in21  = 'a=rtpmap:0 PCMU/8000';
$in22  = 'a=rtpmap:8 PCMA/8000';
$in23  = 'a=rtpmap:18 G729/8000';
$in24  = 'a=fmtp:18 annexb=no';
$in25  = 'a=rtpmap:9 G722/8000';
$in26  = 'a=fmtp:101 0-15';
$in27  = 'a=rtpmap:101 telephone-event/8000';
$in28  = 'a=sendrecv';

$simv = "\r\n";

$in =  $invite.$simv.
$via.$simv.
$from.$simv.
$in4.$simv.
$in5.$simv.
$in6.$simv.
$in7.$simv.
$in8.$simv.
$in9.$simv.
$in10.$simv.
$in11.$simv.
$in12.$simv.
$in13.$simv.
$in14.$simv.$simv.
$in15.$simv.
$in16.$simv.
$in17.$simv.
$in18.$simv.
$in19.$simv.
$in20.$simv.
$in21.$simv.
$in22.$simv.
$in23.$simv.
$in24.$simv.
$in25.$simv.
$in26.$simv.
$in27.$simv.
$in28.$simv;

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
