function validateMessage() {
      var receiver = document.getElementById("receiver").value;
      var body = document.getElementById("body").value;
      
      var alertMessage = "";

      if (receiver == ""){
        alertMessage += "Please specify the recipient\n";
      }
      
      if (body == ""){
        alertMessage += "Please include a message\n";
      } 
      
      return execute(alertMessage);
         
}




function execute(alertMessage) {
  if (alertMessage != ""){
    alert(alertMessage);
    return false;
  } else if (window.confirm("Do you want to send the message?")){
      return true;
  } else return false; 
}
