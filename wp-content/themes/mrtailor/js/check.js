/**
***  Automated measurement checking 
***  Author: Saigon Technology Solution
***  Version: 1.0
**/
jQuery(document).ready(function(){
    var urBodyHeight = 0;
    var urBodyWeight = 0;
    var urBodyNeck = 0;
    var urBodyChest = 0;
    var urBodyWaist = 0;
    var urBodyHips = 0;
    var urBodyShirtLength = 0;
    var urBodyArmLength = 0;
    var urBodyShoulder = 0;
    var urBodyArmhole = 0;
    var urBodyBicep = 0;
    var urBodyWrist = 0;
    var sum = 0;
    var sumNeck = 0;
    var sumChest = 0;
    var sumWaist = 0;
    var sumHips = 0;
    var sumShirtLength = 0;
    var sumArmLength = 0;
    var sumShoulder = 0;
    var sumArmHole = 0;
    var sumBiCep = 0;
    var sumWrist = 0;
    var sumUrBodyNeck = 0;
    var sumUrBodyChest =0;
    var sumUrBodyWaist =0;
    var sumUrBodyHips =0;
    var sumUrBodyShirtLength =0;
    var sumUrBodyArmLength =0;
    var sumUrBodyShoulder =0;

    //Get and split value: Height 
    jQuery('select[name="sizing[measure-your-body][general][height]"]').on('change', function() {
        urBodyHeight = parseInt(this.value.substring(0,3));
    });
    
    //Get and split value: Weight 
    jQuery('select[name="sizing[measure-your-body][general][weight]"]').on('change', function() {
        urBodyWeight = parseInt(this.value.substring(0,3));
    });
    
    
    jQuery('select[name="sizing[measure-your-body][general][weight]"]').focusout(function(){
        sum = urBodyHeight - urBodyWeight;   
        //alert(sum);    
    });
    
    jQuery('select[name="sizing[measure-your-body][general][height]"]').focusout(function(){
        sum = urBodyHeight - urBodyWeight; 
       // alert(sum);   
    });

    jQuery('body').on('change', 'select[name="sizing[measure-your-body][general][weight]"], select[name="sizing[measure-your-body][general][height]"]', function(event) {
        event.preventDefault();
        if(jQuery('select[name="sizing[measure-your-body][general][height]"]').val() != 'selected' && jQuery('select[name="sizing[measure-your-body][general][weight]"]').val() != 'selected')
        {
            jQuery('.selected-values').removeAttr('disabled');
        }
        else
        {
            jQuery('.selected-values').attr('disabled', 'disabled');
        }
    });
    
    //if(sum==0 || sum==undefined)
    //{
        //jQuery('.selected-values').prop('disabled','disabled');
        jQuery('.selected-values').attr('disabled', 'disabled');
    //}
    //else
    //{
        //Get and split value: Neck 
        
        jQuery('.input-profile.left-col.container-neck').focusin(function(){
           jQuery('.profile-wrap-details').find('.checkWrapper.height').remove();
        });
        
        jQuery('select[name="sizing[measure-your-body][neck]"]').on('change', function() {
            urBodyNeck = parseInt(this.value.substring(0,3)); // Giá trị lựa chọn
            sumNeck = 31.781*(urBodyWeight/urBodyHeight)+27.46; // tính toán giá trị chuẩn 
            sumUrBodyNeck = urBodyNeck - Math.ceil(sumNeck);
            if(!isNaN(sumNeck)){
                if(sumUrBodyNeck==-3 || sumUrBodyNeck==-4 ){
                    jQuery('#neck-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#neck-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper neck"><p class="validCheck">Based on your height and weight, your neck size should be approximately: '+Math.ceil(sumNeck)+'</p></div>').fadeIn(500)); 
                }
                else if(sumUrBodyNeck==-2){
                    jQuery('#neck-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#neck-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper neck"><p class="validCheck">Based on your height and weight, your neck size should be approximately: '+Math.ceil(sumNeck)+'</p></div>').fadeIn(500)); 
                }
                else if(sumUrBodyNeck<=-5){
                    jQuery('#neck-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#neck-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper neck"><p class="validCheck">Based on your height and weight, your neck size should be approximately: '+Math.ceil(sumNeck)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyNeck==3 || sumUrBodyNeck==4){
                    jQuery('#neck-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#neck-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper neck"><p class="validCheck">Based on your height and weight, your neck size should be approximately: '+Math.ceil(sumNeck)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyNeck>=5){
                    jQuery('#neck-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#neck-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper neck"><p class="validCheck">Based on your height and weight, your neck size should be approximately: '+Math.ceil(sumNeck)+'</p></div>').fadeIn(500));
                }
                else{
                    jQuery('#neck-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                }
            }
            else{
               
                //jQuery('#neck-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                //jQuery('#neck-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper height"><p class="validCheck">You should input height and weight first</p></div>').fadeIn(500));
            }
            //alert( urBodyHeight );
        });
        
        //Get and split value: Chest
         
        jQuery('.input-profile.left-col.container-chest').focusin(function(){
           jQuery('.profile-wrap-details').find('.checkWrapper.height').remove();
        });
        
        jQuery('select[name="sizing[measure-your-body][chest]"]').on('change', function() {
            urBodyChest = parseInt(this.value.substring(0,3));
            sumChest = (urBodyWeight/urBodyHeight)*118.75+49.976;
            sumUrBodyChest = urBodyChest - Math.ceil(sumChest);
            
            if(!isNaN(sumChest)){
                if(sumUrBodyChest==-8 || sumUrBodyChest==-9){
                    jQuery('#chest-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#chest-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper chest"><p class="validCheck">Based on your height and weight, your chest size should be approximately: '+Math.ceil(sumChest)+'</p></div>').fadeIn(500)); 
                }
                else if(sumUrBodyChest==-10){
                    jQuery('#chest-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#chest-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper chest"><p class="validCheck">Based on your height and weight, your chest size should be approximately: '+Math.ceil(sumChest)+'</p></div>').fadeIn(500)); 
                }
                else if(sumUrBodyChest<=-11){
                    jQuery('#chest-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#chest-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper chest"><p class="validCheck">Based on your height and weight, your chest size should be approximately: '+Math.ceil(sumChest)+'</p></div>').fadeIn(500)); 
                }
                else if(sumUrBodyChest==7 || sumUrBodyChest==8 || sumUrBodyChest==9 || sumUrBodyChest==10){
                    jQuery('#chest-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#chest-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper chest"><p class="validCheck">Based on your height and weight, your chest size should be approximately: '+Math.ceil(sumChest)+'</p></div>').fadeIn(500)); 
                }
                else if(sumUrBodyChest>=11){
                    jQuery('#chest-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#chest-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your chest size should be approximately: '+Math.ceil(sumChest)+'</p></div>').fadeIn(500)); 
                }
                else{
                    jQuery('#chest-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                }
            }
            else{
                //jQuery('#chest-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                //jQuery('#chest-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper height"><p class="validCheck">You should input height and weight first</p></div>').fadeIn(500));
            }
            //alert( urBodyChest );
        });
        
        
        //Get and split value: Waist
        
        jQuery('.input-profile.left-col.container-waist').focusin(function(){
           jQuery('.profile-wrap-details').find('.checkWrapper.height').remove();
        });
       
        jQuery('select[name="sizing[measure-your-body][waist]"]').on('change', function() {
            urBodyWaist = parseInt(this.value.substring(0,3));
            sumWaist = 157.25*(urBodyWeight/urBodyHeight)+22.219;
            sumUrBodyWaist = urBodyWaist - Math.ceil(sumWaist);
            if(!isNaN(sumWaist)){
                if(sumUrBodyWaist==-8 || sumUrBodyWaist==-9){
                    //alert('ket qua phai la:'+sumWaist);
                    jQuery('#waist-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#waist-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your waist size should be approximately: '+Math.ceil(sumWaist)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyWaist==-10){
                    //alert('ket qua phai la:'+sumWaist);
                    jQuery('#waist-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#waist-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your waist size should be approximately: '+Math.ceil(sumWaist)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyWaist<=-11){
                    jQuery('#waist-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#waist-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your waist size should be approximately: '+Math.ceil(sumWaist)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyWaist==7 || sumUrBodyWaist==8 || sumUrBodyWaist==9 || sumUrBodyWaist==10){
                    jQuery('#waist-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#waist-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your waist size should be approximately: '+Math.ceil(sumWaist)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyWaist>=11){
                    jQuery('#waist-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#waist-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your waist size should be approximately: '+Math.ceil(sumWaist)+'</p></div>').fadeIn(500));
                }
                else{
                    jQuery('#waist-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                }
            }
            else{
                //jQuery('.profile-wrap-details').find('.checkWrapper').remove();
                //jQuery('.profile-wrap-details').append(jQuery('<div class="checkWrapper height"><p class="validCheck">You should input height and weight first</p></div>').fadeIn(500));
            }
            //alert( urBodyWaist );
        });
        
        //Get and split value: Hips 
        
        jQuery('.input-profile.left-col.container-hips').focusin(function(){
           jQuery('.profile-wrap-details').find('.checkWrapper.height').remove();
        });
      
        jQuery('select[name="sizing[measure-your-body][hips]"]').on('change', function() {
            urBodyHips = parseInt(this.value.substring(0,3));
            sumHips = 110.05*(urBodyWeight/urBodyHeight)+52.398;
            sumUrBodyHips = urBodyHips - Math.ceil(sumHips);
            if(!isNaN(sumHips)){
                if(sumUrBodyHips==-8 || sumUrBodyHips==-9){
                    //alert('ket qua phai la:'+sumHips);
                    jQuery('#hips-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#hips-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your hips size should be approximately: '+Math.ceil(sumHips)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyHips==-10){
                    //alert('ket qua phai la:'+sumHips);
                    jQuery('#hips-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#hips-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your hips size should be approximately: '+Math.ceil(sumHips)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyHips<=-11){
                    //alert('ket qua phai la:'+sumHips);
                    jQuery('#hips-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#hips-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your hips size should be approximately: '+Math.ceil(sumHips)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyHips==7 || sumUrBodyHips==8 || sumUrBodyHips==9 || sumUrBodyHips==10){
                    //alert('ket qua phai la:'+sumHips);
                    jQuery('#hips-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#hips-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your hips size should be approximately: '+Math.ceil(sumHips)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyHips>=11){
                    //alert('ket qua phai la:'+sumHips);
                    jQuery('#hips-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#hips-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your hips size should be approximately: '+Math.ceil(sumHips)+'</p></div>').fadeIn(500));
                }
                else{
                    jQuery('#hips-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                }
            }
            else{
                    //jQuery('.profile-wrap-details').find('.checkWrapper').remove();
                    //jQuery('.profile-wrap-details').append(jQuery('<div class="checkWrapper height"><p class="validCheck">You should input height and weight first</p></div>').fadeIn(500));
            }
            //alert( urBodyHips );
        });
        
        //Get and split value: Shirt Length
        
        jQuery('.input-profile.left-col.container-shirt-length').focusin(function(){
           jQuery('.profile-wrap-details').find('.checkWrapper.height').remove();
        });
        
        jQuery('select[name="sizing[measure-your-body][shirt-length]"]').on('change', function() {
            urBodyShirtLength = parseInt(this.value.substring(0,3));
            sumShirtLength = 0.348*urBodyHeight+13.6;
            sumUrBodyShirtLength = urBodyShirtLength - Math.ceil(sumShirtLength);
            if(sumShirtLength>=41){
                if(sumUrBodyShirtLength==-5 || sumUrBodyShirtLength==-6 || sumUrBodyShirtLength==-7 || sumUrBodyShirtLength==-8 || sumUrBodyShirtLength==-9){
                    //alert('ket qua phai la:'+sumShirtLength);
                    jQuery('#shirt-length-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#shirt-length-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your shirt size should be approximately: '+Math.ceil(sumShirtLength)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyShirtLength<=-10){
                    //alert('ket qua phai la:'+sumShirtLength);
                    jQuery('#shirt-length-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#shirt-length-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your shirt size should be approximately: '+Math.ceil(sumShirtLength)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyShirtLength==7 || sumUrBodyShirtLength==8 || sumUrBodyShirtLength==9){
                    //alert('ket qua phai la:'+sumShirtLength);
                    jQuery('#shirt-length-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#shirt-length-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your shirt size should be approximately: '+Math.ceil(sumShirtLength)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyShirtLength>=10){
                    //alert('ket qua phai la:'+sumShirtLength);
                    jQuery('#shirt-length-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#shirt-length-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your shirt size should be approximately: '+Math.ceil(sumShirtLength)+'</p></div>').fadeIn(500));
                }
                else{
                    jQuery('#shirt-length-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                }
            }
            else if(sumShirtLength<41){
                    //jQuery('.profile-wrap-details').find('.checkWrapper').remove();
                    //jQuery('.profile-wrap-details').append(jQuery('<div class="checkWrapper height"><p class="validCheck">You should input height and weight first</p></div>').fadeIn(500));
            }
           //alert( urBodyShirtLength );
        });
        
        //Get and split value: Arm Length 
        
        jQuery('.input-profile.left-col.container-arm-length').focusin(function(){
           jQuery('.profile-wrap-details').find('.checkWrapper.height').remove();
        });
        
        jQuery('select[name="sizing[measure-your-body][arm-length]"]').on('change', function() {
            urBodyArmLength = parseInt(this.value.substring(0,3));
            sumArmLength = urBodyHeight*0.3452 + 2.545;
            sumUrBodyArmLength = urBodyArmLength - Math.ceil(sumArmLength);
            if(sumArmLength>=50){
                if(sumUrBodyArmLength==-1 || sumUrBodyArmLength==-2 || sumUrBodyArmLength==-3){
                    //alert('ket qua phai la:'+sumArmLength);
                    jQuery('#arm-length-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#arm-length-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your arm length should be approximately: '+Math.ceil(sumArmLength)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyArmLength==-4){
                    //alert('ket qua phai la:'+sumArmLength);
                    jQuery('#arm-length-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#arm-length-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your arm length should be approximately: '+Math.ceil(sumArmLength)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyArmLength<=-5){
                    //alert('ket qua phai la:'+sumArmLength);
                    jQuery('#arm-length-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#arm-length-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your arm length should be approximately: '+Math.ceil(sumArmLength)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyArmLength==4 || sumUrBodyArmLength==5){
                    //alert('ket qua phai la:'+sumArmLength);
                    jQuery('#arm-length-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#arm-length-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your arm length should be approximately: '+Math.ceil(sumArmLength)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyArmLength>=6){
                    //alert('ket qua phai la:'+sumArmLength);
                    jQuery('#arm-length-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#arm-length-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your arm length should be approximately: '+Math.ceil(sumArmLength)+'</p></div>').fadeIn(500));
                }
                else{
                    jQuery('#arm-length-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                }
            }
            else if(sumArmLength<40){
                //jQuery('.profile-wrap-details').find('.checkWrapper').remove();
                //jQuery('.profile-wrap-details').append(jQuery('<div class="checkWrapper height"><p class="validCheck">You should input height and weight first</p></div>').fadeIn(500));
            }
           //alert( urBodyArmLength );
        });
        
        //Get and split value: Shoulders
        
        jQuery('.input-profile.left-col.container-shoulders').focusin(function(){
           jQuery('.profile-wrap-details').find('.checkWrapper.height').remove();
        });
     
        jQuery('select[name="sizing[measure-your-body][shoulders]"]').on('change', function() {
            urBodyShoulder = parseInt(this.value.substring(0,3));
            sumShoulder = (urBodyWeight/urBodyHeight)*33.714+33.05;
            sumUrBodyShoulder = urBodyShoulder - Math.ceil(sumShoulder);
            
            if(!isNaN(sumShoulder)){
                if(sumUrBodyShoulder==-3 || sumUrBodyShoulder==-4 || sumUrBodyShoulder==-5 || sumUrBodyShoulder==-6){
                    //alert('ket qua phai la:'+sumShoulder);
                    jQuery('#shoulders-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#shoulders-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your shoulder should be approximately: '+Math.ceil(sumShoulder)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyShoulder<-6){
                    //alert('ket qua phai la:'+sumShoulder);
                    jQuery('#shoulders-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#shoulders-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your shoulder should be approximately: '+Math.ceil(sumShoulder)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyShoulder==2 || sumUrBodyShoulder==3 || sumUrBodyShoulder==4 || sumUrBodyShoulder==5){
                    //alert('ket qua phai la:'+sumShoulder);
                    jQuery('#shoulders-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#shoulders-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your shoulder should be approximately: '+Math.ceil(sumShoulder)+'</p></div>').fadeIn(500));
                }
                else if(sumUrBodyShoulder>=6){
                    //alert('ket qua phai la:'+sumShoulder);
                    jQuery('#shoulders-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                    jQuery('#shoulders-measure-your-body .profile-wrap-details').append(jQuery('<div class="checkWrapper"><p class="validCheck">Based on your height and weight, your shoulder should be approximately: '+Math.ceil(sumShoulder)+'</p></div>').fadeIn(500));
                }
                else{
                    jQuery('#shoulders-measure-your-body .profile-wrap-details').find('.checkWrapper').remove();
                }
            }
            else{
                //jQuery('.profile-wrap-details').find('.checkWrapper').remove();
                //jQuery('.profile-wrap-details').append(jQuery('<div class="checkWrapper height"><p class="validCheck">You should input height and weight first</p></div>').fadeIn(500));
            }
            //alert( urBodyShoulder );
        });
        
        jQuery('select[name="sizing[measure-your-body][armhole]"]').on('change', function() {
            urBodyArmHole = parseInt(this.value.substring(0,3));
            sumArmHole = (urBodyWeight/urBodyHeight);
            jQuery('#armhole-measure-your-body').find('.checkWrapper').remove();
        });
        
        jQuery('select[name="sizing[measure-your-body][bicep]"]').on('change', function() {
            urBodyBicep = parseInt(this.value.substring(0,3));
            sumBicep = (urBodyWeight/urBodyHeight);
            jQuery('#bicep-measure-your-body').find('.checkWrapper').remove();
        });
        
        jQuery('select[name="sizing[measure-your-body][wrist]"]').on('change', function() {
            urBodyWrist = parseInt(this.value.substring(0,3));
            sumWrist = (urBodyWeight/urBodyHeight);
            jQuery('#wrist-measure-your-body').find('.checkWrapper').remove();
        });
    //}
  /**  //Get and split value: Armhole
    jQuery('select[name="sizing[measure-your-body][armhole]"]').on('change', function() {
        urBodyArmHole = parseInt(this.value.substring(0,3));
        sumArmHole = (urBodyWeight/urBodyHeight)
        if(Math.ceil(sumArmHole)< urBodyArmHole){
            //alert('ket qua phai la:'+sumShoulder);
            jQuery('#armhole-measure-your-body').find('.checkWrapper').remove();
            jQuery('#armhole-measure-your-body').append(jQuery('<p class="validCheck">Kich thuoc qua lon. ket qua phai la:'+Math.ceil(sumArmHole)+'</p>').fadeIn(500));
        }
        else if(Math.ceil(sumArmHole) > urBodyArmHole){
            //alert('ket qua phai la:'+sumShoulder);
            jQuery('#armhole-measure-your-body').find('.checkWrapper').remove();
            jQuery('#armhole-measure-your-body').append(jQuery('<p class="validCheck">Kich thuoc qua nho. ket qua phai la:'+Math.ceil(sumArmHole)+'</p>').fadeIn(500));
        }
        else{
            jQuery('#armhole-measure-your-body').find('.checkWrapper').remove();
        }
       // alert( urBodyArmHole );
    });
    
    //Get and split value: Bicep
    jQuery('select[name="sizing[measure-your-body][bicep]"]').on('change', function() {
        urBodyBicep = parseInt(this.value.substring(0,3));
        sumBicep = (urBodyWeight/urBodyHeight);
        if(Math.ceil(sumBicep)< urBodyBicep){
            //alert('ket qua phai la:'+sumBicep);
            jQuery('#bicep-measure-your-body').find('.checkWrapper').remove();
            jQuery('#bicep-measure-your-body').append(jQuery('<p class="validCheck">Kich thuoc qua lon. ket qua phai la:'+Math.ceil(sumBicep)+'</p>').fadeIn(500));
        }
        else if(Math.ceil(sumBicep) > urBodyBicep){
            //alert('ket qua phai la:'+sumBicep);
            jQuery('#bicep-measure-your-body').find('.checkWrapper').remove();
            jQuery('#bicep-measure-your-body').append(jQuery('<p class="validCheck">Kich thuoc qua nho. ket qua phai la:'+Math.ceil(sumBicep)+'</p>').fadeIn(500));
        }
        else{
            jQuery('#bicep-measure-your-body').find('.checkWrapper').remove();
        }
       // alert( urBodyBicep );
    });
    
    //Get and split value: Wrist
    jQuery('select[name="sizing[measure-your-body][wrist]"]').on('change', function() {
        urBodyWrist = parseInt(this.value.substring(0,3));
        sumWrist = (urBodyWeight/urBodyHeight);
        if(Math.ceil(sumWrist)< urBodyWrist){
            //alert('ket qua phai la:'+sumWrist);
            jQuery('#wrist-measure-your-body').find('.checkWrapper').remove();
            jQuery('#wrist-measure-your-body').append(jQuery('<p class="validCheck">Kich thuoc qua lon. ket qua phai la:'+Math.ceil(sumWrist)+'</p>').fadeIn(500));
        }
        else if(Math.ceil(sumWrist) > urBodyWrist){
            //alert('ket qua phai la:'+sumWrist);
            jQuery('#wrist-measure-your-body').find('.checkWrapper').remove();
            jQuery('#wrist-measure-your-body').append(jQuery('<p class="validCheck">Kich thuoc qua nho. ket qua phai la:'+Math.ceil(sumWrist)+'</p>').fadeIn(500));
        }
        else{
            jQuery('#wrist-measure-your-body').find('.checkWrapper').remove();
        }
       // alert( urBodyWrist );
    }); **/
    
});
