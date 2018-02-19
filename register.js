/*  register.js
    Pooja Sastry, CS545, Fall 2016
*/ 


//function to validate if a field is empty
function isEmpty(fieldValue) 
{
    return $.trim(fieldValue).length == 0;    
} 

//function to validate if radio button for gender has been selected
function isGenderSelected(gender) 
{
    if($("input[name='gender']:checked").length > 0)
        return true;
    return false;
}

//function to validate if DOB is valid (idea from stackoverflow.com)
function isValidDate(dob)
{
    var comp = dob.split('/');
    var m = parseInt(comp[0], 10);
    var d = parseInt(comp[1], 10);
    var y = parseInt(comp[2], 10);
    var date = new Date(y,m-1,d);
    if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) 
        return true;
    return false;
}

//function to check if age is above 16 years
function isDateInRangemax(dob)
{
    var dt = dob.split('/');
    var y = parseInt(dt[2], 10);
    if(y<='2000')
        return true;
    return false;
}

//function to check if age is below 80 years
function isDateInRangemin(dob)
{
    var dt = dob.split('/');
    var y = parseInt(dt[2], 10);
    if(y>='1926')
        return true;
    return false;
}

//function to validate state entered is correct
function isValidState(state) 
{                                
    var stateList = new Array("AK","AL","AR","AZ","CA","CO","CT","DC",
        "DE","FL","GA","GU","HI","IA","ID","IL","IN","KS","KY","LA","MA",
        "MD","ME","MH","MI","MN","MO","MS","MT","NC","ND","NE","NH","NJ",
        "NM","NV","NY","OH","OK","OR","PA","PR","RI","SC","SD","TN","TX",
        "UT","VA","VT","WA","WI","WV","WY");
    for(var i=0; i < stateList.length; i++) 
        if(stateList[i] == $.trim(state))
            return true;
        return false;
}  
   
function dup_handler(response) {
    if(response == "dup")
        $('#status').text("ERROR, duplicate");
    else if(response == "OK") {
        $('form').serialize();
        $('form').submit();
        }
    else
        alert(response);
    }  

//function to check if valid email address has been added(copied from stackoverflow.com)  
function isValidEmail(emailAddress) 
{
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}                
                   
$(document).ready( function() {
    var errorStatusHandle = $('#message_line');
    var elementHandle = new Array(13);
    elementHandle[0] = $('[name="firstname"]');
    elementHandle[1] = $('[name="lastname"]');
    elementHandle[2] = $('[name="address1"]');
    elementHandle[3] = $('[name="city"]');
    elementHandle[4] = $('[name="state"]');
    elementHandle[5] = $('[name="zip"]');
    elementHandle[6] = $('[name="gender"]');
    elementHandle[7] = $('[name="areaphone"]');
    elementHandle[8] = $('[name="prefixphone"]');
    elementHandle[9] = $('[name="phone"]');
    elementHandle[10] = $('[name="email"]');
    elementHandle[11] = $('[name="dob"]');
    elementHandle[12] = $('[name="experience"]');
	elementHandle[13] = $('[name="file"]');
	elementHandle[14] = $('[name="category"]');
    function isValidData() {
        if(isEmpty(elementHandle[0].val())) {
            elementHandle[0].addClass("error");
            errorStatusHandle.text("Please enter your first name");
            elementHandle[0].focus();
            return false;
            }
        if(isEmpty(elementHandle[1].val())) {
            elementHandle[1].addClass("error");
            errorStatusHandle.text("Please enter your last name");
            elementHandle[1].focus();            
            return false;
            }
        if(isEmpty(elementHandle[2].val())) {
            elementHandle[2].addClass("error");
            errorStatusHandle.text("Please enter your address");
            elementHandle[2].focus();            
            return false;
            }
        if(isEmpty(elementHandle[3].val())) {
            elementHandle[3].addClass("error");
            errorStatusHandle.text("Please enter your city");
            elementHandle[3].focus();            
            return false;
            }
        if(isEmpty(elementHandle[4].val())) {
            elementHandle[4].addClass("error");
            errorStatusHandle.text("Please enter your state");
            elementHandle[4].focus();            
            return false;
            }
        if(!isValidState(elementHandle[4].val())) {
            elementHandle[4].addClass("error");
            errorStatusHandle.text("The state appears to be invalid, "+
            "please use the two letter state abbreviation");
            elementHandle[4].focus();            
            return false;
            }
        if(isEmpty(elementHandle[5].val())) {
            elementHandle[5].addClass("error");
            errorStatusHandle.text("Please enter your zip code");
            elementHandle[5].focus();            
            return false;
            }
        if(!$.isNumeric(elementHandle[5].val())) {
            elementHandle[5].addClass("error");
            errorStatusHandle.text("The zip code appears to be invalid, "+
            "numbers only please. ");
            elementHandle[5].focus();            
            return false;
            }
        if(elementHandle[5].val().length != 5) {
            elementHandle[5].addClass("error");
            errorStatusHandle.text("The zip code must have exactly five digits")
            elementHandle[5].focus();            
            return false;
            }
        if(!isGenderSelected(elementHandle[6].val())) {
            elementHandle[6].addClass("error");
            errorStatusHandle.text("Please select your gender");
            elementHandle[6].focus();            
            return false;
            } 
        if(isEmpty(elementHandle[7].val())) {
            elementHandle[7].addClass("error");
            errorStatusHandle.text("Please enter your area code");
            elementHandle[7].focus();            
            return false;
            }            
        if(!$.isNumeric(elementHandle[7].val())) {
            elementHandle[7].addClass("error");
            errorStatusHandle.text("The area code appears to be invalid, "+
            "numbers only please. ");
            elementHandle[7].focus();            
            return false;
            }
        if(elementHandle[7].val().length != 3) {
            elementHandle[7].addClass("error");
            errorStatusHandle.text("The area code must have exactly three digits")
            elementHandle[7].focus();            
            return false;
            }   
        if(isEmpty(elementHandle[8].val())) {
            elementHandle[8].addClass("error");
            errorStatusHandle.text("Please enter your phone number prefix");
            elementHandle[8].focus();            
            return false;
            }           
        if(!$.isNumeric(elementHandle[8].val())) {
            elementHandle[8].addClass("error");
            errorStatusHandle.text("The phone number prefix appears to be invalid, "+
            "numbers only please. ");
            elementHandle[8].focus();            
            return false;
            }
        if(elementHandle[8].val().length != 3) {
            elementHandle[8].addClass("error");
            errorStatusHandle.text("The phone number prefix must have exactly three digits")
            elementHandle[8].focus();            
            return false;
            }
        if(isEmpty(elementHandle[9].val())) {
            elementHandle[9].addClass("error");
            errorStatusHandle.text("Please enter your phone number");
            elementHandle[9].focus();            
            return false;
            }            
        if(!$.isNumeric(elementHandle[9].val())) {
            elementHandle[9].addClass("error");
            errorStatusHandle.text("The phone number appears to be invalid, "+
            "numbers only please. ");
            elementHandle[9].focus();            
            return false;
            }
        if(elementHandle[9].val().length != 4) {
            elementHandle[9].addClass("error");
            errorStatusHandle.text("The phone number must have exactly four digits")
            elementHandle[9].focus();            
            return false;
            }  
        if(isEmpty(elementHandle[10].val())) {
            elementHandle[10].addClass("error");
            errorStatusHandle.text("Please enter your email address");
            elementHandle[10].focus();            
            return false;
            }            
        if(!isValidEmail(elementHandle[10].val())) {
            elementHandle[10].addClass("error");
            errorStatusHandle.text("The email address appears to be invalid, please provide in 'xyz@abc.com' pattern");
            elementHandle[10].focus();            
            return false;
            } 
         if((elementHandle[11].val())=='') {
            elementHandle[11].addClass("error");
            errorStatusHandle.text("Please enter your Date Of Birth");
            elementHandle[11].focus(); 
            return false;
            } 
            if(!isValidDate(elementHandle[11].val())) {
            elementHandle[11].addClass("error");
            errorStatusHandle.text("Please enter a valid Date Of Birth");
            elementHandle[11].focus(); 
            return false;
            } 
            if(!isDateInRangemin(elementHandle[11].val())) {
            elementHandle[11].addClass("error");
            errorStatusHandle.text("Sorry! Your age needs to be below 80 to participate in this marathon");
            elementHandle[11].focus(); 
            return false;
            } 
            if(!isDateInRangemax(elementHandle[11].val())) {
            elementHandle[11].addClass("error");
            errorStatusHandle.text("Sorry! Your age needs to be above 16 to participate in this marathon");
            elementHandle[11].focus(); 
            return false;
            } 
            if((elementHandle[12].val())=='') {
            elementHandle[12].addClass("error");
            errorStatusHandle.text("Please select your experience level");
            elementHandle[12].focus();            
            return false;
            }   
			if(isEmpty(elementHandle[13].val())) {
            elementHandle[13].addClass("error");
            errorStatusHandle.text("Please upload your photo");
            elementHandle[13].focus();            
            return false;
            }  
			if((elementHandle[14].val())=='') {
            elementHandle[14].addClass("error");
            errorStatusHandle.text("Please select your category");
            elementHandle[14].focus();            
            return false;
            }   
        return true;
        }       

   elementHandle[0].focus();
    
/////// HANDLERS
// on blur, if the user has entered valid data, the error message
// should no longer show.
    elementHandle[0].on('blur', function() {
        if(isEmpty(elementHandle[0].val()))
            return;
        $(this).removeClass("error");
        errorStatusHandle.text("");
        });
        
    elementHandle[10].on('blur', function() {
        if(isEmpty(elementHandle[10].val()))
            return;
        if(isValidEmail(elementHandle[10].val())) {
            $(this).removeClass("error");
            errorStatusHandle.text("");
            }
        });  

 
      
/////////////////////////////////////////////////////////////////        

    elementHandle[4].on('keyup', function() {
        elementHandle[4].val(elementHandle[4].val().toUpperCase());
        });
        
    elementHandle[7].on('keyup', function() {
        if(elementHandle[7].val().length == 3)
            elementHandle[8].focus();
            });
            
    elementHandle[8].on('keyup', function() {
        if(elementHandle[8].val().length == 3)
            elementHandle[9].focus();
            });            

   
    $(':submit').on('click', function() {		
		for(var i=0; i < 15; i++)
            elementHandle[i].removeClass("error");
        errorStatusHandle.text("");
        return isValidData();
        })
		
	;
	
        
    $(':reset').on('click', function() {
        for(var i=0; i < 15; i++)
            elementHandle[i].removeClass("error");
        errorStatusHandle.text("");
        });                                         
});


    
