function validateForm()
{
    var fname = document.forms['user_details']['first_name'].value;
    var lname = document.forms['user_details']['last_name'].value;
    var city = document.forms['user_details']['city_name'].value;
    if (fname == null || lname == "" || city == "" )
    {
        alert('All the required details have not been supplied');
        return false;
    }
    return true;
}