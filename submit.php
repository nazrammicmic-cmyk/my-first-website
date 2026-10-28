<?php
require "config.php"; $page_title="Submit Concern | SFHS"; $errors=[]; $code="";
$cats=["Facilities","Bullying or Safety","Teaching and Learning","School Services","Suggestion","Other"];
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $cat=trim($_POST["category"]??""); $subject=trim($_POST["subject"]??""); $details=trim($_POST["details"]??"");
 $anon=isset($_POST["anonymous"])?1:0; $name=$anon?null:trim($_POST["reporter_name"]??""); $contact=$anon?null:trim($_POST["reporter_contact"]??"");
 if(!in_array($cat,$cats,true))$errors[]="Choose a valid category.";
 if($subject===""||mb_strlen($subject)>180)$errors[]="Subject is required (maximum 180 characters).";
 if($details==="")$errors[]="Details are required.";
 if(!$anon&&$name==="")$errors[]="Enter your name or choose anonymous reporting.";
 if(!$errors){$code="SFHS-".strtoupper(bin2hex(random_bytes(5)));$s=$conn->prepare("INSERT INTO complaints(tracking_code,category,subject,details,is_anonymous,reporter_name,reporter_contact) VALUES(?,?,?,?,?,?,?)");$s->bind_param("ssssiss",$code,$cat,$subject,$details,$anon,$name,$contact);if(!$s->execute()){$errors[]="Could not save the report. Try again.";$code="";}$s->close();}
}
require "includes/header.php"; ?>
<h1>Submit a complaint or feedback</h1><p class="muted">Fields marked * are required. Do not use this system for emergencies.</p>
<?php if($errors): ?><div class="alert"><?php foreach($errors as $x): ?><p><?=e($x)?></p><?php endforeach; ?></div><?php endif; ?>
<?php if($code): ?><div class="panel success"><h2>Submission received</h2><p>Your tracking code is:</p><div class="code"><?=e($code)?></div><p><b>Save this code</b> to check the status later.</p><a class="btn" href="track.php">Track status</a></div>
<?php else: ?><form class="form" method="post"><label>Category *</label><select name="category" required><option value="">Choose category</option><?php foreach($cats as $c): ?><option><?=e($c)?></option><?php endforeach; ?></select><label>Subject *</label><input name="subject" maxlength="180" required><label>Details *</label><textarea name="details" rows="6" required></textarea><label class="check"><input type="checkbox" name="anonymous" id="anon" checked> Submit anonymously</label><div id="contact" hidden><label>Your name *</label><input name="reporter_name"><label>Contact details (optional)</label><input name="reporter_contact"></div><p class="muted small">Anonymous reporting means your name/contact details are not requested by this form. Server infrastructure may still keep technical logs.</p><button class="btn">Submit concern</button></form><script>const a=document.getElementById('anon'),c=document.getElementById('contact');function toggle(){c.hidden=a.checked}a.addEventListener('change',toggle);toggle();</script><?php endif; ?>
<?php require "includes/footer.php"; ?>