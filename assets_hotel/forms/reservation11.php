<?php session_start();
// session_destroy();
include("~admin/class/connect_db.php");
include("assets/includes/include_function.php");

error_reporting(E_ALL & ~E_NOTICE);
error_reporting( error_reporting() & ~E_NOTICE );

if (!empty($_SESSION['roomtype_id'])) {
 unset($_SESSION['roomtype_id']);
 unset($_SESSION['roomamount']);
}

?>
<!DOCTYPE html>
<html>

<script type="text/javascript">
    function IsNumeric(sText,obj){
    var ValidChars = "0123456789";
    var IsNumber=true;
    var Char;
    for (i = 0; i < sText.length && IsNumber == true; i++) { 
    Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) {
      IsNumber = false;
      }
    }
      if(IsNumber==false){
      alert('กรุณากรอกเฉพาะ "ตัวเลข" เท่านั้น !! ');
      obj.value=sText.substr(0,sText.length-sText.length);
      }
    }
</script>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
     <link rel="shortcut icon" type="image/x-icon" href="images/logo.ico"/>
    <title>Burisiri Boutique Hotel,Boutique Hotel Chiangmai,Hotel Chiangmai</title>
<meta name="Keywords" content="Burisiri Boutique Hotel,Boutique Hotel Chiangmai,Hotel Chiangmai">
<meta name="Description" content="Burisiri Boutique Hotel,Boutique Hotel Chiangmai,Hotel Chiangmai">
<meta name="Author" content="chiangmaizone dot com partnership limited.">
    <?php fn_link(); ?>


</head>

<body>
    <?php fn_header(); ?>

    <?php fn_navbar(); ?>


<script src="jquery-1.11.1.min.js" type="text/javascript"></script>
 <script language="JavaScript">
                    function addCommas(nStr)
                    {
                        nStr += '';
                        x = nStr.split('.');
                        x1 = x[0];
                        x2 = x.length > 1 ? '.' + x[1] : '';
                        var rgx = /(\d+)(\d{3})/;
                        while (rgx.test(x1)) {
                            x1 = x1.replace(rgx, '$1' + ',' + '$2');
                        }
                        return x1 + x2;
                    }
                    /*----------------------------------------------*/
                    function textsum(){
                       function calA(i){
                        //alert("document.frmbegcomplete.txtprice[i].length");
                        var d = function (){
                         var k = document.frm['product_price[]'][i];
                         var p = document.frm['product_amount[]'][i];
                         var a = document.frm['total_price[]'][i];
                         var s = document.frm['total_price1[]'][i];

                         k.value = k.value.replace(/[^\d\.]/g,'');
                         p.value = p.value.replace(/[^\d\.]/g,'');
                         s.value = s.value.replace(/[^\d\.]/g,'');
                       
                         a.value = (k.value*1) * (p.value*1);
                         s.value = (k.value*1) * (p.value*1);
                                     
                        var num = parseFloat(a.value);
                        a.value = addCommas(num.toFixed(2));

                        s.value = parseFloat(s.value);
       
                        }
                        return d; 

                       }


                       for(var i=0;i<document.frm['product_price[]'].length;i++){
                        document.frm['product_price[]'][i].blur = calA(i);
                        document.frm['product_amount[]'][i].onkeyup = calA(i);
                       }

                       // check number
                        var ValidChars = "0123456789.,-";
                        var IsNumber=true;
                        var Char;
                        for (i = 0; i < sText.length && IsNumber == true; i++) { 
                        Char = sText.charAt(i); 
                          if (ValidChars.indexOf(Char) == -1) {
                          IsNumber = false;
                          }
                        }
                          if(IsNumber==false){
                          alert('กรุณากรอกเฉพาะ "ตัวเลข" เท่านั้น !! ');
                          obj.value=sText.substr(0,sText.length-1);
                          }
                        }  

</script>


<script type="text/javascript">
//for(var i=0;i<document.getElementById("num").value;i++){
  $(".roomamount").ready(function(){
    $(this).change(function(){
        findTotal();
    });
  });
//}
               
  function findTotal(){
    //for(var i=0;i<document.getElementById("num").value;i++){

    var arr = document.getElementsByClassName('roomamount');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
          tot += parseInt(arr[i].value);
      }
     // alert(tot);
      var num = parseFloat(tot);

      document.getElementById('adult_ebed').value = num;
  }


                    
</script>



    <div class="container">


        <div class="row">
          <div class="col-md-12">

                <address>
                <div class="col-md-4">
                    <h4>Contact  Information</h4>
                    No. 1 Sirimangkalajarn Rd.,<br>Soi 9, Tambol Suthep, Muang,<br>Chiang Mai 50200, Thailand.<br><br>
                </div>
                <div class="col-md-4">
                    <span class="color--mark">Tel.</span> +66 53 217832-3<br>
                    <span class="color--mark">Mobile.</span> 0640010069<br>
                    <span class="color--mark">Line ID.</span> 0640010069<br>

                    <span class="color--mark">Fax.</span> +66 53 217834 (Front Office), <br>+66 53 217835 (Accounting)<br><br>
                    </div>
                <div class="col-md-4">
                    <span class="color--mark">Hotel E-mail</span> : <a href="mailto:fo@burisirihotel.com">fo@burisirihotel.com</a>,<br>
                    <a href="mailto:reservation@burisirihotel.com">reservation@burisirihotel.com</a>
                </div>
                </address>

            </div>
        </div>
         
        
       <div class="row">
        
        <div class="col-md-12">
                <form method="get" action="">
                        <div class="col-md-3">
                        <div class="form-group">
                            <label>Check in*</label>
                            <div class="input-group date" id="datetimepicker6">
                               <input id="datetimepicker6" type="text" class="form-control" name="checkin" placeholder="Check in" required value="<?php if(!empty($_GET['checkin'])){ echo $_GET['checkin']; } ?> <?php if(!empty($_SESSION['checkin'])){ echo $_SESSION['checkin']; } ?>">
                              <span class="input-group-addon" id="pickup">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label>Check out*</label>
                             <div class="input-group date" id="datetimepicker7">
                                <input id="datetimepicker7" type="text" class="form-control" name="checkout" placeholder="Check out" required value="<?php if(!empty($_GET['checkout'])){ echo $_GET['checkout']; } ?> <?php if(!empty($_SESSION['checkout'])){ echo $_SESSION['checkout']; } ?>">
                              <span class="input-group-addon" id="pickup">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                           
                        </div>
                        
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label>Adults*</label>
                            <input type="text" class="form-control" id="fm_adults" name="adults" placeholder="Adults" required value="<?php if(!empty($_GET['adults'])){ echo $_GET['adults']; }else if(!empty($_SESSION['adults'])){ echo $_SESSION['adults']; } ?>" onKeyUp="IsNumeric(this.value,this)">
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label>Children*</label>
                            <input type="text" class="form-control" id="fm_children" name="children"  placeholder="Children" required value="<?php if(!empty($_GET['children'])){ echo $_GET['children']; }else if(!empty($_SESSION['children'])){ echo $_SESSION['children']; } ?>" onKeyUp="IsNumeric(this.value,this)">
                        </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary btn-md" style="float:none;width: 255px;">Check Rate</button>
                        </div>
                </form>
               <?php 
                if(!empty($_GET['checkin'])){
                    $checkin_day=substr($_GET['checkin'],0,2);
                    $checkin_mount=substr($_GET['checkin'],3,2);
                    $checkin_year=substr($_GET['checkin'],6,9); 
                    $checkin=$checkin_year."-".$checkin_mount."-".$checkin_day;
                } 
                if(!empty($_GET['checkout'])){
                    $checkout_day=substr($_GET['checkout'],0,2);
                    $checkout_mount=substr($_GET['checkout'],3,2);
                    $checkout_year=substr($_GET['checkout'],6,9); 
                    $checkout=$checkout_year."-".$checkout_mount."-".$checkout_day;
                } 
              ?>
                <form method="post" name="booking" action="add-data.php">
                    <input  type="hidden"  name="checkin" required value="<?php if(!empty($_GET['checkin'])){ echo $_GET['checkin']; } ?>">
                    <input type="hidden" name="checkout" required value="<?php if(!empty($_GET['checkout'])){ echo $_GET['checkout']; } ?>">
                    <input type="hidden" name="adults" required value="<?php if(!empty($_GET['adults'])){ echo $_GET['adults']; }else{ echo '1'; } ?>">
                    <input type="hidden" name="children" required value="<?php if(!empty($_GET['children'])){ echo $_GET['children']; }else{ echo '0'; } ?>">


                    <input  type="hidden"  name="adult_ebed" required value="<?php if(!empty($_GET['adult_ebed'])){ echo $_GET['adult_ebed']; } ?>">
                    <input type="hidden" name="children_ebed" required value="<?php if(!empty($_GET['children_ebed'])){ echo $_GET['children_ebed']; } ?>">

                        <div class="col-md-12">

                        <br>
                        <?php
                        $i=0;
                        $RESULT_ROOM=mysqli_query($link,"SELECT * FROM roomtype WHERE display!='1' ORDER BY sort ASC") or die(mysqli_error());
                        $NUM_ROOM = mysqli_num_rows($RESULT_ROOM);   
                        ?>
                        <input type="hidden" name="num" id="num" value="<?php echo $NUM_ROOM; ?>">  
                        <?php
                          while($ROW_ROOM = mysqli_fetch_array($RESULT_ROOM)){
                        ?>
                       
                      
                        <?php
                        $k = 0;
                        $query_price=mysqli_query($link,"SELECT * FROM rm_price WHERE rm_id='".$ROW_ROOM['id']."' AND DATE(start)>='".$checkin."' AND DATE(start)<='".$checkout."'") or die(mysqli_error());
                        $numrows = mysqli_num_rows($query_price);
                        while($result = mysqli_fetch_array($query_price)){
                          @$ar=array($result['room_num'][$k]);
                          $min_result=min($ar);

                        if (!empty($numrows)) {
                        ?>

                        <div class="row">
                              <?php
                              if(!empty($_SESSION["roomtype_id"])){
                                $j=0;
                                foreach ($_SESSION["roomtype_id"] as $key => $value) {
                                  if($value==$ROW_ROOM['id']){ 
                              ?> 
                                  <div class="col-md-3">
                                      <label>Room type*</label><br>
                                       <input type="checkbox" name="roomtype_id[]" value="<?php echo $ROW_ROOM['id']; ?>" class="roomtype_id" id="roomtype_id<?php echo $i; ?>" <?php echo $value==$ROW_ROOM['id'] ? 'checked="checked"' : ''?>>
                                       <label><?php if (!empty($_SESSION['lg'])) { echo $ROW_ROOM["title_th"]; }else{ echo $ROW_ROOM["title_en"]; } ?></label>
                                  </div>

                                  <div class="col-md-3">
                                  <label>Room Amount*</label><br>
                                  <select name="roomamount[<?php echo $ROW_ROOM['id']; ?>]" id="roomamount<?php echo $i; ?>" class="form-control roomamount">
                                  <option value="">Not selected</option> 
                                  <?php for($a=1; $a<=8; $a++){ ?>
                                    <?php if($a <= $min_result){ ?>
                                      <option value="<?php echo $a; ?>" <?php if(!empty($_SESSION['roomamount'][$j])){ if($_SESSION['roomamount'][$j]==$a){ echo 'selected'; } } ?>><?php echo $a; ?></option>
                                    <?php } ?>
                                  <?php } ?>
                                  </select>
                                </div> 

                                <div class="col-md-3">
                                  <label>Bed Type*</label><br>
                                  <select name="bedtype[<?php echo $ROW_ROOM['id']; ?>]" id="bedtype<?php echo $i; ?>" class="form-control">
                                      <option value="1" <?php if(!empty($_SESSION['bedtype'][$j])){ if($_SESSION['bedtype'][$j]=='1'){ echo 'selected'; }} ?>>Single(kingsize) Bed</option>
                                      <option value="2" <?php if(!empty($_SESSION['bedtype'][$j])){ if($_SESSION['bedtype'][$j]=='2'){ echo 'selected'; }} ?>>Twin Bed</option>
                                  </select>
                                </div> 

                                           
                              <?php 
                                  }else{
                                    if(!in_array($ROW_ROOM["id"],$_SESSION['roomtype_id'])){
                                      if($j==0){ 
                              ?>
                                    <div class="col-md-3">
                                      <label>Room type*</label><br>
                                      <input type="checkbox" name="roomtype_id[]" value="<?php echo $ROW_ROOM['id']; ?>" class="roomtype_id" id="roomtype_id<?php echo $i; ?>">
                                      <label><?php if (!empty($_SESSION['lg'])) { echo $ROW_ROOM["title_th"]; }else{ echo $ROW_ROOM["title_en"]; } ?></label>
                                    </div> 

                                  <div class="col-md-3">
                                  <label>Room Amount*</label><br>
                                  <select name="roomamount[<?php echo $ROW_ROOM['id']; ?>]" id="roomamount<?php echo $i; ?>" class="form-control roomamount">
                                  <option value="">Not selected</option> 
                                  <?php for($a=1; $a<=8; $a++){ ?>
                                    <?php if($a <= $min_result){ ?>
                                      <option value="<?php echo $a; ?>" <?php if(!empty($_SESSION['roomamount'][$i])){ if($_SESSION['roomamount'][$i]==$a){ echo 'selected'; } } ?>><?php echo $a; ?></option>
                                    <?php } ?>
                                  <?php } ?>
                                  </select>
                                </div> 

                                <div class="col-md-3">
                                  <label>Bed Type*</label><br>
                                  <select name="bedtype[<?php echo $ROW_ROOM['id']; ?>]" id="bedtype<?php echo $i; ?>" class="form-control">
                                      <option value="1" <?php if(!empty($_SESSION['bedtype'][$i])){ if($_SESSION['bedtype'][$i]=='1'){ echo 'selected'; }} ?>>Single(kingsize) Bed</option>
                                      <option value="2" <?php if(!empty($_SESSION['bedtype'][$i])){ if($_SESSION['bedtype'][$i]=='2'){ echo 'selected'; }} ?>>Twin Bed</option>
                                  </select>
                                </div>

                                 
                              <?php }}} ?>

                              <?php 
                              $j++; 
                              } 
                              ?>
                                   
                              <?php           
                                  }else{

                              ?>


                                   <div class="col-md-3">
                                      <label>Room type*</label><br>
                                      <input type="checkbox" name="roomtype_id[]" value="<?php echo $ROW_ROOM['id']; ?>" class="roomtype_id" id="roomtype_id<?php echo $i; ?>">
                                      <label><?php if (!empty($_SESSION['lg'])) { echo $ROW_ROOM["title_th"]; }else{ echo $ROW_ROOM["title_en"]; } ?></label>
                                    </div>


                                  <div class="col-md-3">
                                  <label>Room Amount*</label><br>
                                  <select name="roomamount[<?php echo $ROW_ROOM['id']; ?>]" id="roomamount<?php echo $i; ?>" class="form-control roomamount">
                                  <option value="">Not selected</option> 
                                  <?php for($a=1; $a<=8; $a++){ ?>
                                    <?php if($a <= $min_result){ ?>
                                      <option value="<?php echo $a; ?>" <?php if(!empty($_SESSION['roomamount'][$i])){ if($_SESSION['roomamount'][$i]==$a){ echo 'selected'; } } ?>><?php echo $a; ?></option>
                                    <?php } ?>
                                  <?php } ?>
                                  </select>
                                </div> 

                                <div class="col-md-3">
                                  <label>Bed Type*</label><br>
                                  <select name="bedtype[<?php echo $ROW_ROOM['id']; ?>]" id="bedtype<?php echo $i; ?>" class="form-control">
                                      <option value="1" <?php if(!empty($_SESSION['bedtype'][$i])){ if($_SESSION['bedtype'][$i]=='1'){ echo 'selected'; }} ?>>Single(kingsize) Bed</option>
                                      <option value="2" <?php if(!empty($_SESSION['bedtype'][$i])){ if($_SESSION['bedtype'][$i]=='2'){ echo 'selected'; }} ?>>Twin Bed</option>
                                  </select>
                                </div> 



                              <?php
                              }
                              $k++; }
                              ?>
                        </div><br>
                         


                        <!-- Price -->

                        <div class="row">
                            <div class="col-md-7 col-md-offset-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="background: #b39059;color: #FFF;">
                                            <th>Date</th>
                                            <th width="200">Price Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query_price=mysqli_query($link,"SELECT * FROM rm_price WHERE rm_id='".$ROW_ROOM['id']."' AND DATE(start)>='".$checkin."' AND DATE(start)<'".$checkout."'") or die(mysqli_error());
                                        $numrows = mysqli_num_rows($query_price);
                                        $m=1;
                                        while ($row_price = mysqli_fetch_array($query_price)) {

                                        if(!empty($row_price['start'])){
                                            $start_day=substr($row_price['start'],8,2);
                                            $start_mount=substr($row_price['start'],5,2);
                                            $start_year=substr($row_price['start'],0,4); 
                                            $start=$start_day."-".$start_mount."-".$start_year;
                                        } 
                                        
                                        ?>
                                        <?php if($row_price['room_num']>0){ ?>
                                            <tr>
                                                <td><?php echo $start; ?>
                                                <input type="hidden" name="count_day[<?php echo $numrows; ?>]" value="<?php echo $numrows; ?>" class="form-control" id="count_day">
                                                <input type="hidden" name="rm_id[<?php echo $ROW_ROOM['id']; ?>][]" value="<?php echo $row_price['id']; ?>" class="form-control" id="rm_id">
                                                </td>
                                                <td><?php echo number_format($row_price['price'], 2, '.', ','); ?></td>
                                            </tr>
                                        <?php }else{ ?>
                                          <?php if($m==1){ ?>
                                          <tr><td colspan="2" class="text-center">Unavailable</td></tr>
                                          <?php } ?>
                                        <?php } ?>
                                        <?php
                                        $m++;
                                        }
                                        ?>
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>



                        <!-- //Price -->
                        <?php } ?>


        
                
                   
                      <?php $i++; } ?>
                      </div>
 
                    
                    
                    <div class="row">
                      <label>Extra bed*</label><br>
                      <div class="col-md-3">
                        <label>Adult</label>
                        <select name="adult_ebed" id="adult_ebed" class="form-control">
                            <option value="">Not selected</option>
                        </select>
                        <?php
                        $adult_ebed = isset($_POST['adult_ebed']) ? $_POST['adult_ebed'] : "";
                        ?>
                      <div style="display: none;">
                        <select name="adult_ebed_value" id="adult_ebed_value" class="form-control">
                            <option value="">Not selected</option> 
                        </select>
                      </div>   
                      </div>


                       <div class="col-md-3">
                        <label>Children</label>
                              <select name="children_ebed" id="children_ebed" class="form-control">
                              <option value="">Not selected</option>
                          </select>
                       </div>
                    </div> 



                    <br>
                    <div class="row"><br>
                    </div>



                  <div class="row">
                     <br>
                     <label>Transfer Services*</label><br>
                     <div class="col-md-3">
                      <label>From or To Hotel</label>
                            <select name="transfer" id="transfer" class="form-control">
                            <option value="" <?php if(!empty($_SESSION['transfer'])){ if($_SESSION['transfer']==''){ echo 'selected'; }} ?>>Not selected</option>
                            <option value="1" <?php if(!empty($_SESSION['transfer'])){ if($_SESSION['transfer']=='1'){ echo 'selected'; }} ?>>Airport (0.00 - 5.00 Hrs. )</option>
                            <option value="2" <?php if(!empty($_SESSION['transfer'])){ if($_SESSION['transfer']=='2'){ echo 'selected'; }} ?>>Airport (5.00 - 7.00 Hrs. )</option>
                            <option value="3" <?php if(!empty($_SESSION['transfer'])){ if($_SESSION['transfer']=='3'){ echo 'selected'; }} ?>>Airport ( 7.00 - 23.00 Hrs. )</option>
                            <option value="4" <?php if(!empty($_SESSION['transfer'])){ if($_SESSION['transfer']=='4'){ echo 'selected'; }} ?>>Bus and Railway Station</option>
                        </select>
                     </div>


                       <?php
                        if(!empty($_SESSION['transfer'])){ 


                            if($_SESSION['transfer']=='1'){
                                if($_SESSION['price_transfer']=="350"){
                                    $se='selected';
                                }elseif($_SESSION['price_transfer']=="800"){
                                    $se='selected';
                                }else{
                                    $se='';
                                }
                            }elseif($_SESSION['transfer']=='2'){
                                if($_SESSION['price_transfer']=="300"){
                                    $se='selected';
                                }elseif($_SESSION['price_transfer']=="700"){
                                    $se='selected';
                                }else{
                                    $se='';
                                }
                            }elseif($_SESSION['transfer']=='3'){
                                if($_SESSION['price_transfer']=="250"){
                                    $se='selected';
                                }elseif($_SESSION['price_transfer']=="600"){
                                    $se='selected';
                                }else{
                                    $se='';
                                }
                            }elseif($_SESSION['transfer']=='4'){
                                if($_SESSION['price_transfer']=="300"){
                                    $se='selected';
                                }elseif($_SESSION['price_transfer']=="600"){
                                    $se='selected';
                                }else{
                                    $se='';
                                }
                            }


                        }else{
                            $se='';
                        }
                     ?>
                     <div class="col-md-3">
                     <label>Price</label>
                        <select name="price_transfer" id="price_transfer" class="form-control">
                            <option value="" <?php if(!empty($_SESSION['price_transfer'])){ echo $se; } ?>>Not selected</option>
                            <option value='350' <?php if(!empty($_SESSION['price_transfer'])){ echo $se; } ?>>Baht 350 per trip (1-3 Persons)</option>
                            <option value='800' <?php if(!empty($_SESSION['price_transfer'])){ echo $se; } ?>>Baht 800 per trip (4-6 Persons)</option>
                        </select>
                     </div>
                     


                     <div class="col-md-3">
                      <label>Flight Detail</label>
                            <input type="text" name="flight" id="flight" class="form-control" value="<?php if(!empty($_SESSION['flight'])){  echo $_SESSION['flight']; } ?>">
                     </div>

                     <div class="col-md-3">
                      <label>Pick up time</label>
                            <!-- <input  id="basicExample" type="text" class="form-control time"  placeholder="" required > -->
                            <div class="input-group date" id="datetimepicker1">
                              <input type="text" class="form-control" name="pickup" id="pickup" placeholder="" value="<?php if(!empty($_SESSION['pickup'])){  echo $_SESSION['pickup']; } ?>">
                              <span class="input-group-addon" id="pickup">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                     </div>
                     
                    </div>

                    
                     <br>
                     <br>
                    <div class="row">
                    <div class="col-md-12">
                    
                      ** Please note that the room you chose is up to availability. If your chosen room type is not available, our reservation team will provide you other best options for your choosing. The reservation team will send you the confirmation letter to your email no later than 3 hours after you submit your booking request. Thank you for choosing us as one of your accommodation in Chiang Mai. We are looking forward to seeing you very soon.<br>


                        
                        <div class="col-md-3">   
                        <div class="form-group">
                            <label>Name*</label>
                            <input type="text" class="form-control" id="fm_name" name="name" placeholder="Name" required value="<?php if(!empty($_SESSION['name'])){ echo $_SESSION['name']; } ?>">
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label>Email Address*</label>
                            <input type="email" class="form-control" id="fm_email" name="email" placeholder="Email Address" required value="<?php if(!empty($_SESSION['email'])){ echo $_SESSION['email']; } ?>">
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label>Phone Number*</label>
                            <input type="text" class="form-control" id="fm_phone" name="phone" placeholder="Phone Number" value="<?php if(!empty($_SESSION['phone'])){ echo $_SESSION['phone']; } ?>">
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label>Country</label>
                            <!--<input type="text" class="form-control" id="fm_country" name="country" placeholder="Country" required value="<?php if(!empty($_SESSION['country'])){ echo $_SESSION['country']; } ?>">
                            -->
                            <select name="country" class="form-control" id="fm_country" required>
                              <?php
                              $RESULT_COUNTRY=mysqli_query($link,"SELECT * FROM countries ORDER BY idCountry ASC") or die(mysqli_error());
                              while($ROW_COUNTRY = mysqli_fetch_array($RESULT_COUNTRY)) {
                              ?>
                              <?php if($ROW_COUNTRY['countryName']==$_SESSION['country']){ ?>
                                <option value="<?php echo $ROW_COUNTRY['countryName']; ?>" selected='selected'><?php echo $ROW_COUNTRY['countryName']; ?></option>
                              <?php }else{ ?>
                                <option value="<?php echo $ROW_COUNTRY['countryName']; ?>"><?php echo $ROW_COUNTRY['countryName']; ?></option>
                              <?php }?>
                              <?php }?>
                            </select>
                        </div>
                        </div>

                    </div>
                    </div>



                    <div class="row">
                    <div class="col-md-12">
                    
        
                        <div class="form-group">
                            <label>Booking Request</label>
                            <textarea rows="6" class="form-control" id="fm_bookingrequest" name="bookingrequest" placeholder="Booking Request"><?php if(!empty($_SESSION['bookingrequest'])){ echo $_SESSION['bookingrequest']; } ?></textarea>
                        </div>
                      
                    </div>
                    </div>

<!---->
                    <div class="row">
                    <div class="col-md-12">
                      
                        <div class="form-group">
                            <div class="captcha_example" >
                                <img src="captcha/captcha.php" class="form_captcha" />
                            </div>
                        </div>
                      
                    </div>
                    </div>


                    <div class="row">
                    <div class="col-md-12">
                      
                        <div class="form-group">
                            <input type="text" name="captcha" id="captcha" class="form-control" placeholder="security code" required>
                        </div>
                      
                    </div>
                    </div>


                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" value="submit" class="btn btn-default btn-promotion btn--fullwidth">
                        
                            <?php 
                            if (empty($_SESSION['lg'])) {
                                echo "Submit";
                            }else {
                                echo "Submit";
                            }
                            ?>
                        </button>   
                        </div>
                    </div>
                    </div>

 
          
            </form>



                     
    <div class="row">
        <div class="col-md-12">
        <br>
        <h4>Room Rate Details: </h4>
        <ol>
            <li> Room with the inclusive net rate with breakfast (2 pax/room)</li>
            <li> Additional Breakfast Baht 250 per person/night</li>
            <li> Extra Bed 600 Baht excluding breakfast/Additional breakfast 250/person</li>
            <li> All rates are net (inclusive of tax and service charge) </li>
        </ol>
        <br>

        <h4>Special Holiday Surcharges</h4>
        <p>Peak season surcharge is Baht 500 per room/night for the following events.; </p>
        <p>- New Year’s (December 28 to January 02), required minimum 2 night-stay during this period<br>
          <br>
          - Hotel Mobile Contact : +66 64 0010 069        </p>

        <p align="center"><strong> Transfer  Services</strong><strong>:</strong><strong> </strong></p>
        <table border="1" cellspacing="0" cellpadding="0" width="90%" align="center">
            <tr>
                <td width="290" valign="top">
                    <p align="center">From or To
                        <br>
                </td>
                <td width="290" valign="top">
                    <p align="center">Price</p>
                </td>
                <td width="290" valign="top">
                    <p align="center">Price</p>
                </td>
            </tr>
            <tr>
                <td width="290" valign="top">
                    <p>Airport ( 0.00 - 5.00 Hrs. ) </p>
                </td>
                <td width="290" valign="top">
                    <p>Baht 350 per trip (1-3 Persons) </p>
                </td>
                <td width="290" valign="top">
                    <p>Baht 800 per trip (4-6 Persons) </p>
                </td>
            </tr>
            <tr>
                <td width="290" valign="top">
                    <p>Airport ( 5.00 - 7.00 Hrs. ) </p>
                </td>
                <td width="290" valign="top">
                    <p>Baht 300 per trip (1-3 Persons) </p>
                </td>
                <td width="290" valign="top">
                    <p>Baht 700 per trip (4-6 Persons) </p>
                </td>
            </tr>
            <tr>
                <td width="290" valign="top">
                    <p>Airport ( 7.00 - 23.00 Hrs. ) </p>
                </td>
                <td width="290" valign="top">
                    <p>Baht 250 per trip (1-3 Persons) </p>
                </td>
                <td width="290" valign="top">
                    <p>Baht 600 per trip (4-6 Persons) </p>
                </td>
            </tr>
            <tr>
                <td width="290" valign="top">
                    <p>Bus and Railway Station</p>
                </td>
                <td width="290" valign="top">
                    <p>Baht 300 per trip (1-3 Persons) </p>
                </td>
                <td width="290" valign="top">
                    <p>Baht 600 per trip (4-6 Persons) </p>
                </td>
            </tr>
        </table>
        <br>

        <h4>Cancellation and No – Show Policy </h4>
        <p>(1) Peak Season (28 December - 2 January): Canceling the booking 30 days (or less) prior to arrival date or “No-Show” the entire booked period will be charged to the guest. </p>
        <p>(2) High Season (3 January - 28 February, 1 November - 27 December): Canceling the booking 15 days (or less) prior to arrival date 50% of booked period or a night charge will be applied. For a No-Show 100% of booked period will be charged.</p>
        <p>(3) Green Season (1 April - 31 October): Canceling the booking 7 days (or less) prior to arrival date a night charge will be applied. In case of a “No-Show” 100% charge will be applied.</p>
        <br>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15108.21119610423!2d98.9698154!3d18.7958002!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5824262c47af1a4!2sBuri+Siri+Boutique+Hotel!5e0!3m2!1sen!2sth!4v1472445492275" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
        
        </div>
    </div>

  </div>
    </div>

</div>



    <?php fn_footer(); ?>  

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="jquery-1.11.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    
      $(document).ready(function() {
    /*
        //$(".roomamount").attr("disabled","disabled");
        var numberOfChecked = $('input:checkbox:checked').length;
        var totalCheckboxes = $('input:checkbox').length;
        var numberNotChecked = totalCheckboxes - numberOfChecked;
        var arr = document.getElementsByClassName('roomamount');
        for(var i=0; i<=arr.length; i++){
        $("#roomtype_id"+i).click(function(){
        if($(this).is(":checked")) 
           $("#roomamount"+i).removeAttr("disabled");
        else
           $("#roomamount"+i).attr("disabled","disabled");
        });

        $("#roomtype_id"+i).click(function(){
        if($(this).is(":checked")) 
           $("#roomamount"+i).removeAttr("disabled");
        else
           $("#roomamount"+i).attr("disabled","disabled");
        });
        }
      */
      /*-----------------------------------------------*/  
      //var arr1 = document.getElementById('num');
       for(var j=0;j<8;j++){
        $("#bedtype"+j).change(function(){
         var bedtype=$('#bedtype'+j).val();
          $.ajax({
            type: 'POST',
            data: {bedtype: $(this).val()},
            url: 'get_edit.php?bedtype='+bedtype,
            success: function(data) {
            //$('#fm_phone').html(data);
            }
            });
            return false;
        });
        }
      /*-----------------------------------------------*/  
        $("#fm_name").change(function(){
         var fm_phone=$('#fm_name').val();
          $.ajax({
            type: 'POST',
            data: {fm_name: $(this).val()},
            url: 'get_edit.php?fm_name='+fm_name,
            success: function(data) {
            //$('#fm_phone').html(data);
            }
            });
            return false;
        });
      /*-----------------------------------------------*/  
        $("#flight").change(function(){
         var fm_phone=$('#flight').val();
          $.ajax({
            type: 'POST',
            data: {flight: $(this).val()},
            url: 'get_edit.php?flight='+flight,
            success: function(data) {
            //$('#fm_phone').html(data);
            }
            });
            return false;
        });
      /*-----------------------------------------------*/  
        $("#fm_phone").change(function(){
         var fm_phone=$('#fm_phone').val();
          $.ajax({
            type: 'POST',
            data: {fm_phone: $(this).val()},
            url: 'get_edit.php?fm_phone='+fm_phone,
            success: function(data) {
            //$('#fm_phone').html(data);
            }
            });
            return false;
        });

       /*-----------------------------------------------*/  
        $("#fm_bookingrequest").change(function(){
         var fm_bookingrequest=$('#fm_bookingrequest').val();
          $.ajax({
            type: 'POST',
            data: {fm_bookingrequest: $(this).val()},
            url: 'get_edit.php?fm_bookingrequest='+fm_bookingrequest,
            success: function(data) {
            //$('#fm_bookingrequest').html(data);
            }
            });
            return false;
        });
      /*-----------------------------------------------*/  
        $("#fm_country").change(function(){
         var fm_country=$('#fm_country').val();
          $.ajax({
            type: 'POST',
            data: {fm_country: $(this).val()},
            url: 'get_edit.php?fm_country='+fm_country,
            success: function(data) {
            //$('#country').html(data);
            }
            });
            return false;
        });
      /*-----------------------------------------------*/  
        $("#fm_email").change(function(){
         var fm_email=$('#fm_email').val();
          $.ajax({
            type: 'POST',
            data: {fm_email: $(this).val()},
            url: 'get_edit.php?fm_email='+fm_email,
            success: function(data) {
            //$('#fm_email').html(data);
            }
            });
            return false;
        });

      /*-----------------------------------------------*/  
      $("#captcha").change(function(){
         var captcha=$('#captcha').val();
          $.ajax({
            type: 'POST',
            data: {captcha: $(this).val()},
            url: 'get_edit.php?captcha='+captcha,
            success: function(data) {
            //$('#price_transfer').html(data);
            }
            });
            return false;
        });
      /*-----------------------------------------------*/ 
      $("#fm_adults").change(function(){
         var fm_adults=$('#fm_adults').val();
          $.ajax({
            type: 'POST',
            data: {pickup: $(this).val()},
            url: 'get_edit.php?fm_adults='+fm_adults,
            success: function(data) {
            //$('#price_transfer').html(data);
            }
            });
            return false;
        });
        
      /*-----------------------------------------------*/  
      $("#fm_children").change(function(){
         var fm_children=$('#fm_children').val();
          $.ajax({
            type: 'POST',
            data: {pickup: $(this).val()},
            url: 'get_edit.php?fm_children='+fm_children,
            success: function(data) {
            //$('#price_transfer').html(data);
            }
            });
            return false;
        });
        
      /*-----------------------------------------------*/  
        $("#pickup").change(function(){
         var bedtype=$('#pickup').val();
          $.ajax({
            type: 'POST',
            data: {pickup: $(this).val()},
            url: 'get_edit.php?pickup='+pickup,
            success: function(data) {
            //$('#price_transfer').html(data);
            }
            });
            return false;
        });
        
      /*-----------------------------------------------*/  

        $(".bedtype").change(function(){
         var bedtype=$('.bedtype').val();
          $.ajax({
            type: 'POST',
            data: {bedtype: $(this).val()},
            url: 'get_edit.php?bedtype='+bedtype,
            success: function(data) {
            //$('#price_transfer').html(data);
            }
            });
            return false;
        });
        
      /*-----------------------------------------------*/  

        $(".roomtype_id").change(function(){
         var roomtype_id=$('.roomtype_id').val();
          $.ajax({
            type: 'POST',
            data: {roomtype_id: $(this).val()},
            url: 'get_edit_room.php?roomtype_id='+roomtype_id,
            success: function(data) {
            //$('#adult_ebed').html(data);
            }
            });
            return false;
        });
        
      /*-----------------------------------------------*/   

        $('#transfer').change(function() {
          var transfer=$('#transfer').val();
          $.ajax({
            type: 'POST',
            data: {transfer: $(this).val()},
            url: 'get_edit.php?transfer='+transfer,
            success: function(data) {
            $('#price_transfer').html(data);
            }
            });
            return false;
                                
          });

        /*-----------------------------------------------*/

          $('#price_transfer').change(function() {
          var price_transfer=$('#price_transfer').val();
          $.ajax({
            type: 'POST',
            data: {transfer: $(this).val()},
            url: 'get_edit.php?transfer='+transfer,
            success: function(data) {
            //$('#price_transfer').html(data);
            }
            });
            return false;
                                
          });

        /*-----------------------------------------------*/

          //var count = document.getElementsById('num');
          //for(var i=0;i<count;i++){

          $('.roomamount').change(function() {

          var arr = document.getElementsByClassName('roomamount');
          var tot=0;
          for(var i=0;i<arr.length;i++){
              //if(parseInt(arr[i].value)!=1)
              if(i!=0 && i!=2)
              if($('#roomtype_id'+i).is(":checked"))
                tot += parseInt(arr[i].value);
              else
                if(i==0)
                alert('Please choice');
          }
            var num = parseFloat(tot);
          //}

           var roomamount=num;
            $.ajax({
              type: 'POST',
              data: {roomamount: $(this).val()},
              url: 'get_edit_room.php?roomamount='+roomamount,
              success: function(data) {
              $('#adult_ebed').html(data);
              $('#children_ebed').html(data);
            }
          });
          return false;

                         
          });
          //});//check 
           /*-----------------------------------------------*/

          $('#adult_ebed').change(function() {
          var arr = document.getElementsByClassName('roomamount');
          var tot=0;
          for(var i=0;i<arr.length;i++){
              //if(parseInt(arr[i].value)!=1)
              if(i!=0 && i!=2)
              if($('#roomtype_id'+i).is(":checked")) 
                tot += parseInt(arr[i].value);
              else
                if(i==0)
                alert('Please choice');
          }
            var num = parseFloat(tot);
            var roomamount=num;


              $.ajax({
              type: 'POST',
              data: {adult_ebed: $(this).val()},
              url: 'get_edit_room3.php',
              success: function(data) {
              $('#adult_ebed_value').html(data);
            }
          });
          return false;

                         
          });
          /*-----------------------------------------------*/

          $('#adult_ebed').change(function() {
          var children_ebed3= $('#children_ebed').val();
          var arr = document.getElementsByClassName('roomamount');
          var tot=0;
          for(var i=0;i<arr.length;i++){
              //if(parseInt(arr[i].value)!=1)
              if(i!=0 && i!=2)
              if($('#roomtype_id'+i).is(":checked")) 
                tot += parseInt(arr[i].value);
              else
                if(i==0)
                alert('Please choice');
          }
            var num = parseFloat(tot);
            var roomamount=num;


              $.ajax({
              type: 'POST',
              data: {adult_ebed: $(this).val()},
              url: 'get_edit_room1.php?roomamount='+roomamount+'&children_ebed3'+children_ebed3+'&adult_ebed_value'+adult_ebed_value,
              success: function(data) {
              $('#children_ebed').html(data);            }
          });
          return false;

                         
          });
          
          /*-----------------------------------------------*/

          $('#children_ebed').change(function() {
          var adult_ebed_value= $('#adult_ebed_value').val();
          //alert(adult_ebed_value);

          var arr = document.getElementsByClassName('roomamount');
          var tot=0;
          for(var i=0;i<arr.length;i++){
              //if(parseInt(arr[i].value)!=1)
              if(i!=0 && i!=2)
              if($('#roomtype_id'+i).is(":checked")) 
                tot += parseInt(arr[i].value);
              else
                if(i==0)
                alert('Please choice');
          }
            var num = parseFloat(tot);
            var roomamount=num;
            

              $.ajax({
              type: 'POST',
              data: {adult_ebed2: $(this).val()},
              url: 'get_edit_room1.php?roomamount2='+roomamount+'&adult_ebed_value'+adult_ebed_value,
              success: function(data) {
              //$('#adult_ebed').html(data);
              $('#adult_ebed_value').html(data);
            }
          });
          return false;

                         
          });

          /*-----------------------------------------------*/

      }); 
  

    </script>     
    <?php fn_script(); ?>

    <script>
      $(function() {
          //$('#basicExample').timepicker();

          $('#basicExample').timepicker({
              timeFormat: 'G:i',
              show2400: true
          });

      });


      $("#datetimepicker1").datetimepicker({
        format: 'HH:mm'
      });


    </script>

    <!--DateTime-->
    <script type="text/javascript" src="assets/time_picker/jquery.timepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/time_picker/jquery.timepicker.css" />
    <script type="text/javascript" src="assets/time_picker/lib/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/time_picker/lib/bootstrap-datepicker.css" />
    <script type="text/javascript" src="assets/time_picker/lib/site.js"></script>

              
                                                                                                
</body>

</html>
