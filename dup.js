$(document).ready(function() 
{       	
    $(':submit').on('click', function(e) 
	{
        e.preventDefault();
        var params = "email="+$('#email').val();
        var url = "check_dup.php?"+params;
        $.get(url, dup_handler);
    });
});
//function to check duplicate entries
function dup_handler(response) 
{
    if(response == "dup")
	{
        $('#message_line').text("ERROR, duplicate");
	}
    else if(response == "OK") 
		{
			$('form').serialize();
			$('form').submit();
        }
    else
	{
        alert(response);
    }
}