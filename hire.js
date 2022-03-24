function submitBtn(){
    var username = document.getElementById('fname').value;
    var lname=document.getElementById('lname').value;
    var prname=document.getElementById('prname').value;
    var prdetails=document.getElementById('projectdetails').value;
    var myselect=document.getElementById('payments').value;
    var transaction=document.getElementById('transaction').value;

    //function for radio value check;
    function check1()
        {
            var radio_check_val = "";
            for (i = 0; i < document.getElementsByName('packages').length; i++) {
                if (document.getElementsByName('packages')[i].checked) {
                    // alert("this radio button was clicked: " + document.getElementsByName('packages')[i].value);
                    radio_check_val = document.getElementsByName('packages')[i].value;        
                }        
            }
            return radio_check_val;        
        }
        radio_click=check1();
        // alert(radio_click);
        if (username == "")
        {
            alert("First Name Can't be empty!");
        }
        else if(lname=='')
        {
            alert("Last Name Can't be empty!");
        }
        else if(prname=='')
        {
            alert("Project Name Can't Be empty!");
        }
        else if(prdetails=='')
        {
            alert("Project Details Can't Be empty!");
        }
        if(transaction=="")
        {
            alert("Please enter your transection id!!");
        }
        if(radio_click=="")
        {
            alert("please select a package");
        }
        else
        {
            alert("Your Hire Request Send Successfully!!");
        }
        
}