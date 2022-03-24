<?php
include_once('config.php');
echo !empty($status)?''.$statusMsg['status'].'>'.$statusMsg['msg'].'':'';

$db = new DB();
$statusMsg = $recipient_no = '';
$otpDisplay = $verified = 0;

if (isset($_POST['submit_mobile'])) {
    if (!empty($_POST['mobile_no'])) {
        $recipient_no = $_POST['mobile_no'];

        $rand_no = rand(10000, 99999);

        $conditions = array(
            'mobile_number' => $recipient_no,
        );
        $checkPrev = $db->checkRow($conditions);

        if ($checkPrev) {
            $otpData = array(
                'verification_code' => $rand_no
            );
            $insert = $db->update($otpData, $conditions);
        }
        else{
            $otpData = array(
                'mobile_number' => $recipient_no,
                'verification_code' =>$rand_no,
                'verified' => 0
            );
            $insert = $db->insert($otpData);
        }
        if ($insert) {
            // send otp to user
            $message = "Dear user, Otp for mobile number verification  is".$rand."Thanks send me colonWorld";
            $send = sendSMS('SEMICOLONWORLD',$recipient_no,$message);
            if ($send) {
                $otpDisplay = 1;
            }
            else{
                $statusMsg = array(
                    'status' => 'error',
                    'msg' => "We're facing some issue on sending SMS, Please try again"
                );
            }
           } else{
                $statusMsg = array(
                    'status' => 'error',
                    'msg' => 'Some problem occured, please try again'
                );
            }
        }else{
            $statusMsg = array(
                'status' => 'error',
                'msg' => 'Please enter your mobile number'
            );
        }
}
elseif (isset($_POST['submit_otp']) && !empty($_POST['otp_code'])) {
    $otpDisplay = 1;
    $recipient_no = $_POST['mobile_no'];
    if (!empty($_POST['otp_code'])) {
        $otp_code = $_POST['otp_code'];

        //verify otp code

        $conditions = array(
            'mobile_number' =>$recipient_no,
            'verification_code' => $otp_code
        );
        $check = $db->checkRow($conditions);
        if ($check) {
            $otpData = array(
                'verified' => 1
            );
            $update = $db->update($otpData, $conditions);

            $statusMsg = array(
                'status' => 'success',
                'msg' => 'Thanks you! your phone number has been verified'
            );
            $verified = 1;
        }
        else{
            $statusMsg = array(
                'status' =>'error',
                'msg' => 'Verification incorrect Please try again'
            );
        }
    }
    else{
        $statusMsg = array(
            'status' => 'error',
            'msg' =>  'Please enter the verification code'

        );
    }
}

?>




<?php
echo !empty($statusMsg)?''.$statusMsg['status'].'':'';

 if($verified == 1){ ?>
    <p>Mobile No: <?= $recipient_no ?></p>
    <p>Verification  Status: <b>Verified</b></p>
<?php } ?>
 <form method="post">

<label>Enter Mobile No</label>

<input type="text" name="mobile_no" value="<?php echo !empty($recipient_no)?$recipient_no:'';?>"<?php echo ($otpDisplay == 1)?'readonly':'';?>>
        
    <?php  if($otpDisplay == 1){ ?>
        <label>Enter OPT</label>
        <input type="text" name="opt_code">
        <a href="javascript:void(0);" class="resend">Resend Otp </a>
    <?php } ?>
        <input type="submit" name="echo ($otpDisplay == 1)?'submit_otp':'submit_mobile';?>" value="VERIFY"/>
        </form>
