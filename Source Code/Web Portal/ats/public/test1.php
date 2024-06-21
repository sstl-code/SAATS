<html>
<body>
<script>
var winGoogle = window.open("http://www.google.com","google","status,heigh​t=200,width=200");
CheckWinStatus();
  function CheckWinStatus(){
        try{
         asdf = winGoogle.document.body;
        //winGoogle.location.href="http://yahoo.com";
        }
        catch(e){
          setTimeout("CheckWinStatus()",1000);
        }
      }
 setTimeout("newsite()",5000); 
 function newsite()
{
winGoogle.location.href="http://yahoo.com";
}
</script>
</body>
</html>
