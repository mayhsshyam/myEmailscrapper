<?php
/**
 * Created By: Shyam
 * Date: 05-10-2022 11:35 PM
 */

$imapPath = '{imap.gmail.com:993/imap/ssl/novalidate-cert/norsh}kb/s';
$username = $_GET['mail'];
$password = $_GET['pass'];

//$mailboxes = imap_list($mail_con, $host, '*');

$mbox = imap_open($imapPath,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
$MC = imap_check($mbox);
$unseen = imap_search($mbox,'ALL',SE_UID);
echo "<pre>";
foreach ($unseen as $mailVal){
    $mesNo = imap_fetchbody($mbox,$mailVal,1,FT_UID );
    var_dump($mesNo);exit;

}
$result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
foreach ($result as $mailVal) {
    $mesNo = imap_msgno($mbox, $mailVal->uid);
    $message = imap_body($mbox, $mesNo);
    var_dump($message);
    exit;
}
